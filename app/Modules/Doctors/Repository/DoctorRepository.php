<?php

namespace App\Modules\Doctors\Repository;

use App\Modules\Roles\Models\Role;
use App\Modules\Users\Models\User;
use App\Modules\Doctors\Models\Doctor;
use App\Modules\Services\Models\Service;
use App\Modules\Availabilities\Models\Availability;
use Auth;
use Carbon\Carbon;
use DB;
use function foo\func;

class DoctorRepository
{
    function __construct(Doctor $doctor, Availability $availability)
    {
        $this->doctor = $doctor;
        $this->availability = $availability;
    }

    public function doctorCreatedStatistics()
    {
        $data["doctorDate"] = $this->doctor
            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
            ->groupBy('date')
            ->pluck('date');

        $doctorCounter = $this->doctor
            ->select(\DB::raw("count(id) as countDate"))
            ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $data["countDate"] = json_encode(array_pluck($doctorCounter, 'countDate'));

        return $data;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $doctors = $this->doctor->orderBy('doctors.' . $order, $sort)->get();
        return $doctors;
    }

    /*
    * Get All Doctors
    */
    public function getAllDoctors($order = 'id', $sort = 'desc')
    {
        $doctors = $this->doctor->with(['user' => function ($q) {
            $q->active()->isDoctor()->select('id', DB::raw("CONCAT(id, ' - ', name) AS display_name"));
        }])->orderBy('doctors.' . $order, $sort)->get();
        return $doctors;
    }

    public function getAllStatus($order = 'id', $sort = 'asc')
    {
        $doctors = $this->doctor->orderBy('id', 'asc')->whereHas('user', function ($query) {
            $query->where('status', 1);
        })->get();
        return $doctors;
    }


    /*
    * Find Object By ID
    */
    public function findById($id)
    {
        $doctor = $this->doctor->find($id);
        return $doctor;
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

            $avatar = 'uploads/users/user.png';

            if ($request->hasFile('avatar')) {
                $avatar = $uploadPath . $request->file('avatar')->store('avatars', 'public');
            } elseif (isset($request['image'][0]) && !empty($request['image'][0])) {
                $avatar = get_path($request['image'][0]);
            }

            $user_id = DB::table('users')->insertGetId([
                'name' => $request['name']['ar'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'status' => 0,
                'password' => bcrypt($request['password']),
                'avatar' => $avatar,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $user = User::find($user_id);

            $this->translateUsersTable($user, $request);

            $doctor_id = DB::table('doctors')->insertGetId([
                'user_id' => $user->id,
                'account_name' => $request['account_name'] ? $request['account_name']['ar'] : null,
                'iban' => $request['iban'],
                'academic_degree' => $request['academic_degree']['ar'],
                'current_workplaces' => $request['current_workplaces']['ar'],
                'previous_experience' => $request['previous_experience']['ar'],
                'specialization' => $request['specialization']['ar'],

                'bank_name' => $request['bank_name'] ?? $request['bank_name'],
                'card_name' => $request['card_name'] ?? $request['card_name'],

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $doctor = Doctor::find($doctor_id);

            $this->translateTable($doctor, $request);

            if ($request['roles'] != null) {
                $user->roles()->sync($request['roles']);
            } else {
                $role = Role::where('name', '=', 'consulers')->first();
                $user->attachRole($role);
            }

            if ($request['categories'] != null) {
                $doctor->categories()->sync($request['categories']);
            }

            if ($request['languages'] != null) {
                $doctor->languages()->sync($request['languages']);
            }

            $this->createAvailability($request, $doctor);

            $this->addServicesPrices($doctor);

            DB::commit();
            return $doctor;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Register new doctor
    */
    public function register($request)
    {
        DB::beginTransaction();

        try {

            $uploadPath = 'storage/';

            if (\App::environment('production')) {
                $uploadPath = 'public/storage/';
            }

            $avatar = 'uploads/users/user.png';

            if ($request->hasFile('avatar')) {
                $avatar = $uploadPath . $request->file('avatar')->store('avatars', 'public');
            } elseif (isset($request['image'][0]) && !empty($request['image'][0])) {
                $avatar = get_path($request['image'][0]);
            }

            $user_id = DB::table('users')->insertGetId([
                'name' => $request['name'],
                'email' => $request['email'],
                'calling_code' => $request['calling_code'] ?? $request['calling_code'],
                'mobile' => $request['mobile'],
                'status' => 0,
                'password' => bcrypt($request['password']),
                'avatar' => $avatar,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $user = User::find($user_id);

            $doctor_id = DB::table('doctors')->insertGetId([
                'user_id' => $user->id,
                'account_name' => $request['account_name'] ?? $request['account_name'],
                'iban' => $request['iban'],
                'academic_degree' => $request['academic_degree'],
                'current_workplaces' => $request['current_workplaces'],
                'previous_experience' => $request['previous_experience'],
                'specialization' => $request['specialization'],

                'bank_name' => $request['bank_name'] ?? $request['bank_name'],
                'card_name' => $request['card_name'] ?? $request['card_name'],

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            $doctor = Doctor::find($doctor_id);

            if ($request['categories'] != null) {
                $doctor->categories()->sync($request['categories']);
            }

            if ($request['languages'] != null) {
                $doctor->languages()->sync($request['languages']);
            }

            $this->addServicesPrices($doctor);

            DB::commit();
            return $doctor;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Create working days for doctor
     * @param Request $request
     * @param Model $doctor
     * @return mixed
     */
    protected function createAvailability($request, $doctor)
    {
        //availability times
        $S_available_from = $request->S_available_to;
        $S_available_to = $request->S_available_from;

        if (!is_null($S_available_from)) :
            for ($s = 0; $s < count(array_filter($request->S_available_to)); $s++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->S_day,
                    'status' => 1,
                    'available_to' => $S_available_from[$s],
                    'available_from' => $S_available_to[$s],
                ]);
            }
        endif;

        //
        $U_available_from = $request->U_available_to;
        $U_available_to = $request->U_available_from;

        if (!is_null($U_available_from)) :
            for ($u = 0; $u < count(array_filter($request->U_available_to)); $u++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->U_day,
                    'status' => 1,
                    'available_to' => $U_available_from[$u],
                    'available_from' => $U_available_to[$u],
                ]);
            }
        endif;

        //
        $M_available_from = $request->M_available_to;
        $M_available_to = $request->M_available_from;

        if (!is_null($M_available_from)) :
            for ($m = 0; $m < count(array_filter($request->M_available_to)); $m++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->M_day,
                    'status' => 1,
                    'available_to' => $M_available_from[$m],
                    'available_from' => $M_available_to[$m],
                ]);
            }
        endif;

        //
        $T_available_from = $request->T_available_to;
        $T_available_to = $request->T_available_from;

        if (!is_null($T_available_from)) :
            for ($t = 0; $t < count(array_filter($request->T_available_to)); $t++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->T_day,
                    'status' => 1,
                    'available_to' => $T_available_from[$t],
                    'available_from' => $T_available_to[$t],
                ]);
            }
        endif;

        //
        $W_available_from = $request->W_available_to;
        $W_available_to = $request->W_available_from;

        if (!is_null($W_available_from)) :
            for ($w = 0; $w < count(array_filter($request->W_available_to)); $w++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->W_day,
                    'status' => 1,
                    'available_to' => $W_available_from[$w],
                    'available_from' => $W_available_to[$w],
                ]);
            }
        endif;

        //
        $R_available_from = $request->R_available_to;
        $R_available_to = $request->R_available_from;

        if (!is_null($R_available_from)) :
            for ($r = 0; $r < count(array_filter($request->R_available_to)); $r++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->R_day,
                    'status' => 1,
                    'available_to' => $R_available_from[$r],
                    'available_from' => $R_available_to[$r],
                ]);
            }
        endif;

        //
        $F_available_from = $request->F_available_to;
        $F_available_to = $request->F_available_from;

        if (!is_null($F_available_from)) :
            for ($f = 0; $f < count(array_filter($request->F_available_to)); $f++) {
                $this->availability->create([
                    'doctor_id' => $doctor->id,
                    'day_id' => $request->F_day,
                    'status' => 1,
                    'available_to' => $F_available_from[$f],
                    'available_from' => $F_available_to[$f],
                ]);
            }
        endif;
    }

    /**
     * Update or create availability times
     * @param Request $request
     * @param Doctor $doctor
     * @return mixed
     */
    protected function updateOCreateAvailability($request, $doctor)
    {
        //availability times
        $S_available_from = $request->S_available_to;
        $S_available_to = $request->S_available_from;
        $S_availability_id = $request->S_availability_id;
        // \Debugbar::info($request->S_available_from);


        if (is_null($S_availability_id)) {
            $this->availability->where([
                ['day_id', $request->S_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $S_availability_id)
                ->where([
                    ['day_id', $request->S_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($S_available_from)) :
            for ($s = 0; $s < count(array_filter($request->S_available_to)); $s++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $S_availability_id[$s] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->S_day,
                        'status' => 1,
                        'available_to' => $S_available_from[$s],
                        'available_from' => $S_available_to[$s],
                    ]
                );
            }
        endif;

        //
        $U_available_from = $request->U_available_to;
        $U_available_to = $request->U_available_from;
        $U_availability_id = $request->U_availability_id;

        if (is_null($U_availability_id)) {
            $this->availability->where([
                ['day_id', $request->U_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $U_availability_id)
                ->where([
                    ['day_id', $request->U_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($U_available_from)) :
            for ($u = 0; $u < count(array_filter($request->U_available_to)); $u++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $U_availability_id[$u] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->U_day,
                        'status' => 1,
                        'available_to' => $U_available_from[$u],
                        'available_from' => $U_available_to[$u],
                    ]
                );
            }
        endif;

        //
        $M_available_from = $request->M_available_to;
        $M_available_to = $request->M_available_from;
        $M_availability_id = $request->M_availability_id;

        if (is_null($M_availability_id)) {
            $this->availability->where([
                ['day_id', $request->M_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $M_availability_id)
                ->where([
                    ['day_id', $request->M_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($M_available_from)) :
            for ($m = 0; $m < count(array_filter($request->M_available_to)); $m++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $M_availability_id[$m] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->M_day,
                        'status' => 1,
                        'available_to' => $M_available_from[$m],
                        'available_from' => $M_available_to[$m],
                    ]
                );
            }
        endif;

        //
        $T_available_from = $request->T_available_to;
        $T_available_to = $request->T_available_from;
        $T_availability_id = $request->T_availability_id;

        if (is_null($T_availability_id)) {
            $this->availability->where([
                ['day_id', $request->T_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $T_availability_id)
                ->where([
                    ['day_id', $request->T_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($T_available_from)) :
            for ($t = 0; $t < count(array_filter($request->T_available_to)); $t++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $T_availability_id[$t] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->T_day,
                        'status' => 1,
                        'available_to' => $T_available_from[$t],
                        'available_from' => $T_available_to[$t],
                    ]
                );
            }
        endif;

        //
        $W_available_from = $request->W_available_to;
        $W_available_to = $request->W_available_from;
        $W_availability_id = $request->W_availability_id;

        if (is_null($W_availability_id)) {
            $this->availability->where([
                ['day_id', $request->W_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $W_availability_id)
                ->where([
                    ['day_id', $request->W_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($W_available_from)) :
            for ($w = 0; $w < count(array_filter($request->W_available_to)); $w++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $W_availability_id[$w] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->W_day,
                        'status' => 1,
                        'available_to' => $W_available_from[$w],
                        'available_from' => $W_available_to[$w],
                    ]
                );
            }
        endif;

        //
        $R_available_from = $request->R_available_to;
        $R_available_to = $request->R_available_from;
        $R_availability_id = $request->R_availability_id;

        if (is_null($R_availability_id)) {
            $this->availability->where([
                ['day_id', $request->R_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $R_availability_id)
                ->where([
                    ['day_id', $request->R_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($R_available_from)) :
            for ($r = 0; $r < count(array_filter($request->R_available_to)); $r++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $R_availability_id[$r] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->R_day,
                        'status' => 1,
                        'available_to' => $R_available_from[$r],
                        'available_from' => $R_available_to[$r],
                    ]
                );
            }
        endif;

        //
        $F_available_from = $request->F_available_to;
        $F_available_to = $request->F_available_from;
        $F_availability_id = $request->F_availability_id;

        if (is_null($F_availability_id)) {
            $this->availability->where([
                ['day_id', $request->F_day],
                ['doctor_id', $doctor->id]
            ])
                ->delete();
        } else {
            $this->availability->whereNotIn('id', $F_availability_id)
                ->where([
                    ['day_id', $request->F_day],
                    ['doctor_id', $doctor->id]
                ])
                ->delete();
        }

        if (!is_null($F_available_from)) :
            for ($f = 0; $f < count(array_filter($request->F_available_to)); $f++) {
                $this->availability->updateOrCreate(
                    [
                        'id' => $F_availability_id[$f] ?? null
                    ],
                    [
                        'doctor_id' => $doctor->id,
                        'day_id' => $request->F_day,
                        'status' => 1,
                        'available_to' => $F_available_from[$f],
                        'available_from' => $F_available_to[$f],
                    ]
                );
            }
        endif;
    }

    /**
     * Create availability exception dates for doctor
     * @param Request $request
     * @param Model $doctor
     * @return mixed
     */
    public function createAvailabilityException($request, $doctor)
    {
        DB::beginTransaction();

        try {
            $off_from = $request->off_from;
            $off_to = $request->off_to;
            $off_date = $request->off_date;

            if (!is_null($off_from)) :
                if (is_array($request->off_from)) {
                    for ($h = 0; $h < count(array_filter($request->off_from)); $h++) {
                        $doctor->availabilityException()->create([
                            'off_from' => $off_from[$h],
                            'off_to' => $off_to[$h],
                            'off_date' => $off_date[$h],
                        ]);
                    }
                } else {
                    $doctor->availabilityException()->create([
                        'off_from' => $request->off_from,
                        'off_to' => $request->off_to,
                        'off_date' => $request->off_date,
                    ]);
                }

            endif;

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    protected function updateOrcreateAvailabilityException($request, $doctor)
    {
        $off_from = $request->off_from;
        $off_to = $request->off_to;
        $off_date = $request->off_date;
        $off_id = $request->off_id;

        if (is_null($off_id)) {
            $doctor->availabilityException()->delete();
        } else {
            $doctor->availabilityException()
                ->whereNotIn('id', [$off_id])
                ->delete();
        }

        if (!is_null($off_from)) :
            for ($h = 0; $h < count(array_filter($request->off_from)); $h++) {
                $doctor->availabilityException()->updateOrCreate(
                    [
                        'id' => $off_id[$h] ?? null
                    ],
                    [
                        'off_from' => $off_from[$h],
                        'off_to' => $off_to[$h],
                        'off_date' => $off_date[$h],
                    ]
                );
            }
        endif;
    }

    /**
     * add services prices for doctor
     * @param Model $doctor
     */
    public function addServicesPrices($doctor)
    {
        $services = Service::all();

        foreach ($services as $service) {
            $doctor->services()->attach($service->id, ['price' => 1]);
        }
    }

    /**
     * edit services prices for doctor
     * @param Model $doctor
     * @param Request $request
     * @return mixed
     */
    protected function editServicesPrices($doctor, $request)
    {
        foreach ($doctor->services as $service) {

            $price = "price_{$service->id}";
            $status = "status_{$service->id}";

            // this is a dirty fix
            // @TODO: update request validation rules
            if (!$request->has($price)) {
                continue;
            }

            $doctor->services()->updateExistingPivot($service->id, [
                'price' => $request->{$price},
                'status' => ($request->{$status}) ? 1 : 0
            ]);
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

        $doctor = $this->findById($id);

        try {

            $uploadPath = 'storage/';

            if (\App::environment('production')) {
                $uploadPath = 'public/storage/';
            }

            $password = $doctor->user->password;

            if (!empty($request['password'])) {
                $password = bcrypt($request['password']);
            }

            DB::table('doctors')
                ->where('id', $id)
                ->update([
                    'account_name' => $request['account_name'] ?? $request['account_name'],
                    'iban' => $request['iban'],
                    'academic_degree' => $request['academic_degree']['ar'],
                    'current_workplaces' => $request['current_workplaces']['ar'],
                    'previous_experience' => $request['previous_experience']['ar'],
                    'specialization' => $request['specialization']['ar'],

                    'bank_name' => $request['bank_name'] ?? $request['bank_name'],
                    'card_name' => $request['card_name'] ?? $request['card_name'],

                    'updated_at' => Carbon::now(),
                ]);

            $avatar = $doctor->user->avatar;

            if ($request->hasFile('avatar')) {
                $avatar = $uploadPath . $request->file('avatar')->store('avatars', 'public');
            } elseif (isset($request['image'][0]) && !empty($request['image'][0])) {
                $avatar = get_path($request['image'][0]);
            }

            DB::table('users')
                ->where('id', $doctor->user_id)
                ->update([
                    'name' => $request['name']['ar'],
                    'email' => $request['email'],
                    'calling_code' => $request['calling_code'] ?? $request['calling_code'],
                    'mobile' => $request['mobile'],
                    'password' => $password,
                    'avatar' => $avatar,
                    'status' => $request['status'] ? 1 : 0,
                    'updated_at' => Carbon::now(),
                ]);

            $this->translateTable($doctor, $request);
            $this->translateUsersTable($doctor->user, $request);

            if ($request['roles'] != null) {
                $doctor->user->roles()->sync($request['roles']);
            }

            if ($request['categories'] != null) {
                $doctor->categories()->sync($request['categories']);
            }

            if ($request['languages'] != null) {
                $doctor->languages()->sync($request['languages']);
            }
            $this->updateOCreateAvailability($request, $doctor);

            $this->updateOrcreateAvailabilityException($request, $doctor);

            //
            $this->editServicesPrices($doctor, $request);

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
    public function translateTable($doctor, $request)
    {
        //academic_degree, current_workplaces, previous_experience, specialization
        foreach ($request['academic_degree'] as $locale => $value) {
            $doctor->translateOrNew($locale)->academic_degree = $value;
            $doctor->translateOrNew($locale)->current_workplaces = $request['current_workplaces'][$locale];
            $doctor->translateOrNew($locale)->previous_experience = $request['previous_experience'][$locale];
            $doctor->translateOrNew($locale)->specialization = $request['specialization'][$locale];
        }

        $doctor->save();
    }

    /*
    * Translate all fields with multi languages
    */
    public function translateUsersTable($user, $request)
    {
        foreach ($request['name'] as $locale => $value) {
            $user->translateOrNew($locale)->name = $value;
        }

        $user->save();
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
        return $doctors = $this->doctor->destroy($request['ids']);
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

            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'calling_code' => $request['calling_code'] ?? $request['calling_code'],
                'mobile' => $request['phone'],
                'iban' => $request['iban'],
                'account_name' => $request['account_name'] ?? $request['account_name'],

                'bank_name' => $request['bank_name'] ?? $request['bank_name'],
                'card_name' => $request['card_name'] ?? $request['card_name'],

                'password' => $password,
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
        $query = $this->doctor
            //->with('roles')
            ->whereHas('user', function ($q) {
                $q->isDoctor();
            })
            ->join('users', 'users.id', '=', 'doctors.user_id')
            ->select(
                'doctors.*',
                'users.name',
                'users.email',
                'users.mobile',
                'users.avatar',
                DB::raw('DATE_FORMAT(doctors.created_at, "%Y-%m-%d") as createdAt'),
                DB::raw('(CASE
                    WHEN users.status = "0" THEN "' . $notActiveStatus . '"
                     WHEN users.status = "1" THEN "' . $activeStatus . '" END) AS "status"')
            )
            ->where(function ($query) use ($request) {
                $query
                    ->where('doctors.id', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('users.name', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('users.email', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('users.mobile', 'like', '%' . $request->input('search.value') . '%');
            });

        $query = self::filterDataTable($query, $request);

        return $query;
    }

    /*
    * Filteration for Datatable
    */
    public static function filterDataTable($query, $request)
    {
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('doctors.created_at', '>=', $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('doctors.created_at', '<=', $request['req']['to']);

        return $query;
    }
}
