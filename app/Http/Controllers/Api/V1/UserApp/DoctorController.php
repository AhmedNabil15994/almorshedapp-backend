<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Mail\NewDoctorRegister;
use App\Mail\WelcomeDoctorRegister;
use App\Services\Cometchat\User as UserCometchat;
use App\Modules\Doctors\Repository\DoctorRepository as Doctor;
use App\Modules\AvailabilityExceptions\Repository\AvailabilityExceptionRepository;
use App\Modules\Doctors\Requests\RegisterDoctorRequest;
use App\Modules\Doctors\Requests\LoginDoctorRequest;
use App\Modules\Doctors\Requests\UpdateDoctorRequest;
use App\Modules\Doctors\Requests\AddExceptionDateRequest;
use App\Modules\Doctors\Resources\DoctorResource;
use App\Modules\Users\Services\UserService;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
//use PragmaRX\Countries\Update\Countries;

class DoctorController extends ApiController
{
    protected $userCometchat;
    protected $userService;
    protected $doctor;
    protected $vailabilityExceptionRepo;

    /**
     * Create a new controller instance.
     */
    public function __construct(UserService $userService, Doctor $doctor, UserCometchat $userCometchat, AvailabilityExceptionRepository $vailabilityExceptionRepo)
    {
        $this->doctor = $doctor;
        $this->userService = $userService;
        $this->userCometchat = $userCometchat;
        $this->vailabilityExceptionRepo = $vailabilityExceptionRepo;
    }

    /**
     * SignUp doctor (Email , Name , Mobile , Password & Confirmed Password)
     */
    public function signup(RegisterDoctorRequest $request)
    {
        $doctor = $this->doctor->register($request);

        if (!$doctor) {
            return $this->sendError(__('api.general.error_happended'), [], 400);
        }

        $cometChat = $this->userCometchat->create([
            'uid' => 'doctor_' . $doctor->user->id,
            'name' => $doctor->user->name,
            'avatar' => url($doctor->user->avatar)
        ]);

        $cometChat = json_decode($cometChat);

        $user = $doctor->user;
        $user->comet_chat_uid = $cometChat->data->uid;
        $user->save();

        //send mail to admin
        \Mail::to(env('ADMIN_EMAIL'))
//            ->cc([env('ADMIN_EMAIL')])
            ->send(new NewDoctorRegister($doctor));

        $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');
        \Mail::to($doctor->user->email)
            ->cc([$ccDoctorEmail])
            ->send(new WelcomeDoctorRegister($doctor));

        return $this->tokenResponse($doctor);
    }

    /**
     * SignUp doctor (Email , Name , Mobile , Password & Confirmed Password)
     */
    public function update(UpdateDoctorRequest $request)
    {
        $doctor = $this->doctor->update($request, auth()->user()->doctor->id);

        if (!$doctor) {
            return $this->sendError(__('api.general.error_happended'), [], 400);
        }

        return $this->sendResponse($doctor);
    }

    /**
     * Get the authenticated User
     */
    public function doctor(Request $request)
    {
        $doctor = $this->doctor->findById(auth()->user()->doctor->id);

        if (!$doctor) {
            return $this->sendError(__('api.doctors.doctor_not_found'), [], 404);
        }

        $doctorCollection = new DoctorResource($doctor);

        return $this->sendResponse($doctorCollection);
    }

    /**
     * get the doctor profile
     */
    public function show($id)
    {
        $doctor = $this->doctor->findById($id);

        if (!$doctor) {
            return $this->sendError(__('api.doctors.doctor_not_found'), [], 404);
        }

        return $this->sendResponse(new DoctorResource($doctor));
    }

    /**
     * Add exception date for doctor
     * @param AddExceptionDateRequest $request
     */
    public function addExceptionDate(AddExceptionDateRequest $request)
    {
        $availabilityException = $this->doctor->createAvailabilityException($request, auth()->user()->doctor);

        if (!$availabilityException) {
            return $this->sendError(__('api.general.error_happended'), [], 400);
        }

        return $this->sendResponse([]);
    }

    /**
     * Update existing exception date
     * @param AddExceptionDateRequest $request
     * @param var $id
     * @return mixed
     */
    public function updateExceptionDate(AddExceptionDateRequest $request, $id)
    {
        $availabilityException = $this->vailabilityExceptionRepo->findById($id);

        if (!$availabilityException) {
            return $this->sendError(__('api.availability-exceptions.availability_exception_not_found'), [], 400);
        }

        $availabilityException->update($request->validated());

        return $this->sendResponse([]);
    }

    /**
     * Delete existing exception date
     * @param AddExceptionDateRequest $request
     * @param var $id
     * @return mixed
     */
    public function deleteExceptionDate(Request $request, $id)
    {
        $todayDate = date('Y-m-d');

        $availabilityException = $this->vailabilityExceptionRepo->findById($id);

        if (!$availabilityException) {
            return $this->sendError(__('api.availability-exceptions.availability_exception_not_found'), [], 400);
        }

        if ($todayDate > $availabilityException->off_date) {
            return $this->sendError(__('api.availability-exceptions.validation.after_or_equal'), [], 400);
        }

        $availabilityException->delete();

        return $this->sendResponse([]);
    }

    /**
     * Get doctor token
     */
    public function tokenResponse($doctor = null)
    {
        $token = $this->userService->generateToken($doctor->user);

        $doctorProfile = $doctor ? $doctor : auth()->user()->doctor;

        return $this->sendResponse([
            'access_token' => $token->accessToken,
            'user' => new DoctorResource($doctorProfile),
            'token_type' => 'Bearer',
            'expires_at' => $this->userService->tokenExpiresAt($token)
        ]);
    }
}
