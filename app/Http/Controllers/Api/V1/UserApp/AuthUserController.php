<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Services\Cometchat\User as UserCometchat;
use App\Modules\Users\Repository\UserRepository as User;
use App\Modules\Users\Requests\UpdateProfileUserRequest;
use App\Modules\Users\Requests\RegisterUserRequest;
use App\Modules\Users\Requests\LoginUserRequest;
use App\Modules\Users\Requests\ResetPasswordRequest;
use App\Modules\Users\Resources\UserResource;
use App\Modules\Doctors\Resources\DoctorResource;
use App\Modules\Users\Services\UserService;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Notification;
use App\Mail\WelcomeUserRegister;

class AuthUserController extends ApiController
{
    use SendsPasswordResetEmails;

    protected $userCometchat;

    /**
     * Create a new controller instance.
     */
    public function __construct(UserService $userService, User $user, UserCometchat $userCometchat)
    {
        $this->user = $user;
        $this->userService = $userService;
        $this->userCometchat = $userCometchat;
    }

    /**
     * SignUp user (Email , Name , Mobile , Password & Confirmed Password)
     */
    public function signup(RegisterUserRequest $request)
    {

        $user = $this->user->create($request);

        if (!$user) {
            return $this->sendError(__('api.general.error_happended'), [], 400);
        }

        $cometChat = $this->createCometChatUser($user);
        // $user->comet_chat_uid = $cometChat->data->uid; // old way
        $user->comet_chat_uid = $cometChat['data']['uid'] ?? null;
        $user->save();

        $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');
        \Mail::to($user->email)
            ->cc([$ccDoctorEmail])
            ->send(new WelcomeUserRegister($user));

        return $this->tokenResponse($user);
    }

    /**
     * SignUp user (Email , Name , Mobile , Password & Confirmed Password)
     */
    public function update(UpdateProfileUserRequest $request)
    {
        $user = $this->user->update($request, auth()->user()->id);

        if (!$user) {
            return $this->sendError(__('api.general.error_happended'), [], 400);
        }

        return $this->sendResponse($user);
    }

    /**
     * Login user (Email & Password)
     */
    public function login(LoginUserRequest $request)
    {

        $auth = $this->user->loginUser($request);

        if (!$auth) {
            return $this->sendError(__('api.auth.failed'), [], 401);
        }

        if ($auth->comet_chat_uid == null) {
            $cometChat = $this->createCometChatUser($auth);
        } else {
            $cometChatUser = $this->checkIfCometChatUserExists($auth->comet_chat_uid);

            if (!$cometChatUser) {
                $cometChat = $this->createCometChatUser($auth);

                // $auth->comet_chat_uid = $cometChat->data->uid; // old way;
                $auth->comet_chat_uid = $cometChat['data']['uid'];
                $auth->save();
            }
        }

        return $this->tokenResponse();
    }

    /**
     * Get the authenticated User
     */
    public function user(Request $request)
    {
        $user = $this->user->findById(auth()->user()->id);

        if (!$user) {
            return $this->sendError(__('api.users.user_not_found'), [], 404);
        }

        $userCollection = new UserResource($user);

        return $this->sendResponse($userCollection);
    }

    /**
     * Get user token
     */
    public function tokenResponse($user = null)
    {
        $token = $this->userService->generateToken($user);

        $userProfile = $user ? $user : auth()->user();

        return $this->sendResponse([
            'access_token' => $token->accessToken,
            'user' => new UserResource($userProfile),
            'doctor' => $userProfile->doctor ? new DoctorResource($userProfile->doctor) : null,
            'token_type' => 'Bearer',
            'expires_at' => $this->userService->tokenExpiresAt($token)
        ]);
    }

    /**
     * Reset password
     * @param ResetPasswordRequest $request
     * @return mixed
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        if (\Hash::check($request->password, auth()->user()->password)) {
            auth()->user()->update(['password' => bcrypt($request->new_password)]);

            return $this->sendResponse([], __('api.auth.reset_password'));
        } else {
            return $this->sendError(__('api.auth.wrong_password'), [], 400);
        }
    }

    /**
     * Forget Password
     */
    public function forgetPassword(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        $findUser = $this->user->findByEmail($request['email']);

        if (!$findUser) {
            return $this->sendError('Sorry this email not found', [], 404);
        }

        if ($findUser) {

            return $response = Password::RESET_LINK_SENT
                ? $this->sendResponse([], 'Reset Password Link Sent')
                : $this->sendError('Reset Link Could Not Be Sent', [], 404);
        }

        return $this->sendError('Reset Link Could Not Be Sent', [], 404);
    }


    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $user = auth()->user()->token()->revoke();

        if (!$user)
            return $this->sendError(__('api.auth.unautenticated'), [], 401);

        return $this->sendResponse([], __('api.auth.logout_success'));
    }

    protected function checkIfCometChatUserExists($uid)
    {
        $cometChat = $this->userCometchat->get($uid);

        $cometChat = json_decode($cometChat);

        if (isset($cometChat->error)) {
            return false;
        }

        return true;
    }

    protected function createCometChatUser($user)
    {
        $doctor = $user->hasRole('consulers');

        if ($doctor) {
            $cometChat = $this->userCometchat->create([
                'uid' => 'doctor_' . $user->id,
                'name' => $user->name,
                'avatar' => url($user->avatar)
            ]);

            $user->comet_chat_uid = 'doctor_' . $user->id;
            $user->save();
        } else {
            $cometChat = $this->userCometchat->create([
                'uid' => 'user_' . $user->id,
                'name' => $user->name,
                'avatar' => url($user->avatar)
            ]);

            $user->comet_chat_uid = 'user_' . $user->id;
            $user->save();
        }

        // $cometChat = json_decode($cometChat); // old way
        $cometChat = json_decode($cometChat, true);

        return $cometChat;
    }
}
