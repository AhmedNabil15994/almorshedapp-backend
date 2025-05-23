<?php

namespace App\Modules\Users\Repository;

use App\Modules\Users\Models\UserFireBaseToken;
use App\Modules\Roles\Models\Role;
use App\Modules\Users\Models\User;
use Auth;
use Carbon\Carbon;
use DB;

class UserRepository
{
    function __construct(User $user, UserFireBaseToken $token)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function userCreatedStatistics()
    {
        $data["userDate"] = $this->user
            ->doesnthave('roles.perms')
            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
            ->groupBy('date')
            ->pluck('date');

        $userCounter = $this->user
            ->doesnthave('roles.perms')
            ->select(\DB::raw("count(id) as countDate"))
            ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $data["countDate"] = json_encode(array_pluck($userCounter, 'countDate'));

        return $data;
    }

    public function findByEmail($email)
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }

    public function getAllTokens()
    {
        return $this->token->pluck('device_token')->toArray();
    }

    /*
    * Auth Login
    */
    public function loginUser($data)
    {
        $auth = Auth::attempt([
            'email' => $data->email,
            'password' => $data->password,

        ]);

        return auth()->user();
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $users = $this->user->orderBy($order, $sort)->get();
        return $users;
    }

    /*
    * Get All Users
    */
    public function getAllUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->active()->isUser()->orderBy($order, $sort)->select('id', DB::raw("CONCAT(id, ' - ', name) AS display_name"))->get();
        return $users;
    }

    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {

        DB::beginTransaction();

        try {

            $uploadPath = 'storage/';

            if (\App::environment('production')) {
                $uploadPath = 'public/storage/';
            }

            $user_id = DB::table('users')->insertGetId([
                'name' => $request['name'],
                'email' => $request['email'],
                'calling_code' => $request['calling_code'] ?? $request['calling_code'],
                'mobile' => $request['mobile'],
                'status' => 1,
                'password' => bcrypt($request['password']),
                'avatar' => $request->hasFile('avatar') ? $uploadPath . $request->file('avatar')->store('avatars', 'public') : 'uploads/users/user.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $user = User::find($user_id);

            if ($request['roles'] != null) {
                $this->saveRoles($user, $request);
            } else {
                $role = Role::where('name', '=', 'users')->first();
                $user->attachRole($role);
            }

            DB::commit();
            return $user;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function saveRoles($user, $request)
    {
        foreach ($request['roles'] as $key => $value) {
            $user->attachRole($value);
        }

        return true;
    }

    /*
    * Find Object By ID & Update to DB
    */
    public function update($request, $id)
    {
        DB::beginTransaction();

        $user = $this->findById($id);

        try {

            $uploadPath = 'storage/';

            if (\App::environment('production')) {
                $uploadPath = 'public/storage/';
            }

            if ($request['password'] == null)
                $password = $user['password'];
            else
                $password = bcrypt($request['password']);

            DB::table('users')
                ->where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'calling_code' => $request['calling_code'] ?? $request['calling_code'],
                    'mobile' => $request['mobile'],
                    'password' => $password,
                    'status' => $request['status'] ? 1 : 0,
                    'avatar' => $request->hasFile('avatar') ? $uploadPath . $request->file('avatar')->store('avatars', 'public') : $user->avatar,
                    'updated_at' => Carbon::now(),
                ]);

            DB::table('doctors')
                ->where('user_id', $id)
                ->update([
                    'account_name' => $request['account_name'],
                    'iban' => $request['iban'],
                ]);

            if ($request['roles'] != null) {
                DB::table('role_user')->where('user_id', $id)->delete();

                foreach ($request['roles'] as $key => $value) {
                    $user->attachRole($value);
                }
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Translate all fields with multi languages
    */
    public function translateTable($model, $request)
    {
        foreach ($request['description'] as $locale => $value) {
            $model->translateOrNew($locale)->description = $value;
            $model->translateOrNew($locale)->display_name = $request['display_name'][$locale];
        }

        $model->save();
    }

    /*
    * Find Object By ID & Delete it from DB
    */
    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            $model->delete();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Find all Objects By IDs & Delete it from DB
    */
    public function deleteAll($request)
    {
        return $users = $this->user->destroy($request['ids']);
    }


    /*
    * Find User By ID & Update his profile
    */
    public function updateProfile($request)
    {
        DB::beginTransaction();

        $user = $this->findById(Auth::id());

        try {

            if ($request['password'] == null)
                $password = $user['password'];
            else
                $password = bcrypt($request['password']);

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'calling_code' => $request['calling_code'] ?? $request['calling_code'],
                    'mobile' => $request['mobile'],
                    'password' => $password,
                    'updated_at' => Carbon::now(),
                ]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $activeStatus = __('dashboard.datatable.active');
        $notActiveStatus = __('dashboard.datatable.not_active');
        $query = $this->user
            ->isUser()
//            ->translated()
            ->with('roles')
            ->select('*', DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as createdAt'), DB::raw('(CASE
                    WHEN status = "0" THEN "' . $notActiveStatus .
                '" WHEN status = "1" THEN "' . $activeStatus . '" END) AS "status"'))
            ->where(function ($query) use ($request) {
                $query
                    ->where('id', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('name', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('email', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('mobile', 'like', '%' . $request->input('search.value') . '%');
            });

        $query = self::filterDataTable($query, $request);
        config(['translatable.to_array_always_loads_translations' => false]);
        return $query;
    }

    /*
    * Filteration for Datatable
    */
    public static function filterDataTable($query, $request)
    {
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at', '>=', $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at', '<=', $request['req']['to']);

        return $query;
    }
}
