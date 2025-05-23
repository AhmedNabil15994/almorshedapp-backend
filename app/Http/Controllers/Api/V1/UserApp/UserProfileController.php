<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Users\Requests\UpdateProfileUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Modules\Doctors\Resources\DoctorResource;
use App\Modules\Users\Repository\UserRepository as User;


class UserProfileController extends ApiController
{
    /**
     * Update user profile
     *
     * @param UpdateProfileUserRequest $request
     * @return void
     */

     public function __construct(User $user)
     {
         $this->user = $user;
     }

    public function update(UpdateProfileUserRequest $request)
    {
        $user = auth()->user();

        $uploadPath = 'storage/';

        if (\App::environment('production')) {
            $uploadPath = 'public/storage/';
        }

        if ($request['password'] == null) {
            $password = $user['password'];
        } else {
            $password  = bcrypt($request['password']);
        }

        \DB::table('users')
           ->where('id', $user->id)
           ->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'calling_code'  => $request['calling_code'] ?? $request['calling_code'],
                'mobile'        => $request['mobile'],
                'password'      => $password,
                'avatar'        => $request->hasFile('avatar') ? $uploadPath . $request->file('avatar')->store('avatars', 'public') : $user->avatar,
            ]);


        \DB::table('doctors')
            ->where('user_id', $user->id)
            ->update([
                'account_name'          =>$request['account_name'] ?? $request['account_name'],

                'bank_name'             => $request['bank_name'] ?? $request['bank_name'],
                'card_name'             => $request['card_name'] ?? $request['card_name'],

                'iban'                  => $request['iban'],
            ]);

        $user2 = $this->user->findById(auth()->id());

        return $this->sendResponse(
            [
                'user' => $user2,
                'iban' =>$user2->doctor ? $user2->doctor->iban : null,
                'account_name' => $user2->doctor ? $user2->doctor->account_name : null,
            ] );
    }
}


//
// <?php
//
// namespace App\Http\Controllers\Api\V1\UserApp;
//
// use App\Modules\Users\Requests\UpdateProfileUserRequest;
// use Illuminate\Http\Request;
// use App\Http\Controllers\Api\ApiController;
// use App\Modules\Doctors\Resources\DoctorResource;
//
//
// class UserProfileController extends ApiController
// {
//     /**
//      * Update user profile
//      *
//      * @param UpdateProfileUserRequest $request
//      * @return void
//      */
//     public function update(UpdateProfileUserRequest $request)
//     {
//         $user = auth()->user();
//
//         $uploadPath = 'storage/';
//
//         if (\App::environment('production')) {
//             $uploadPath = 'public/storage/';
//         }
//
//         if ($request['password'] == null) {
//             $password = $user['password'];
//         } else {
//             $password  = bcrypt($request['password']);
//         }
//
//
//         \DB::table('users')
//            ->where('id', $user->id)
//            ->update([
//                 'name'          => $request['name'],
//                 'email'         => $request['email'],
//                 'calling_code'  => $request['calling_code'] ?? $request['calling_code'],
//                 'mobile'        => $request['mobile'],
//                 'password'      => $password,
//                 'avatar'        => $request->hasFile('avatar') ? $uploadPath . $request->file('avatar')->store('avatars', 'public') : $user->avatar,
//             ]);
//
//         $doctor = \DB::table('doctors')->where('user_id',$user->id)->first();
//
//         if ($doctor) {
//             \DB::table('doctors')
//               ->where('user_id', $user->id)
//               ->update([
//                   'account_name'        => $request['account_name'],
//                   'iban'                => $request['iban'],
//             ]);
//         }
//
//         $data = [
//             'user'         => $user,
//             'iban'         => $user->doctor ? $user->doctor->iban : null,
//             'account_name' => $user->doctor ? $user->doctor->account_name : null,
//         ];
//         return $this->sendResponse($data);
//     }
// }
//
