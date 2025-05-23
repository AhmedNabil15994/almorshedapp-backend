<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Days\Models\Day;
use App\Mail\NewDoctorAccountActivate;
use App\Services\Firebase\Notification;

use App\Services\Cometchat\User as UserCometchat;
use App\Modules\Languages\Repository\LanguageRepository as Language;
use App\Modules\Categories\Repository\CategoryRepository as Category;
use App\Modules\Roles\Repository\RoleRepository as Role;
use App\Modules\Doctors\Repository\DoctorRepository as Doctor;
use App\Modules\Services\Repository\ServiceRepository as Service;
use App\Modules\Doctors\Requests\DoctorRequest;
use Illuminate\Http\Request;
use DataTable;

class DoctorController extends DashboardController
{
    protected $userCometchat;

    public function __construct(Doctor $doctor, Role $role, Language $language, UserCometchat $userCometchat, Category $category, Service $service, Notification $notification)
    {
        $this->doctor = $doctor;
        $this->role = $role;
        $this->language = $language;
        $this->category = $category;
        $this->service = $service;
        $this->userCometchat = $userCometchat;
        $this->notification = $notification;

    }

    public function index()
    {
        // $doctors = $this->doctor->getAll();
        // foreach ($doctors as $key => $doctor) {
        //   if (empty($doctor->user)) {
        //     $doctor->delete();
        //   }
        // }
        return view('dashboard.doctors.home');
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable($request, $this->doctor->QueryTable($request));
    }

    public function create()
    {
        $categories = $this->category->allMainCats();
        $roles = $this->role->getAll('id', 'asc');
        $languages = $this->language->getAllActive('id', 'asc');
        $days = Day::all();
        return view('dashboard.doctors.create', compact('categories', 'roles', 'languages', 'days'));
    }

    public function store(DoctorRequest $request)
    {
        $doctor = $this->doctor->create($request);

        if ($doctor) {

            $cometChat = $this->userCometchat->create([
                'uid' => 'doctor_' . $doctor->user->id,
                'name' => $doctor->user->name,
                'avatar' => url($doctor->user->avatar)
            ]);

            $cometChat = json_decode($cometChat);

            $user = $doctor->user;
            $user->comet_chat_uid = $cometChat->data->uid;
            $user->save();

            return Response()->json([true, __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false, __('dashboard.general.ops_alert')]);
    }

    //get availabilities times
    public function show($id)
    {
        $doctor_id = $id;

        return view('dashboard.availabilities.home', compact('doctor_id'));
    }

    //show exception times
    public function showAvailabilityExceptions($id)
    {
        $doctor_id = $id;

        return view('dashboard.availability-exceptions.home', compact('doctor_id'));
    }

    public function edit($id)
    {
        $doctor = $this->doctor->findById($id);
        if (!$doctor)
            return abort(404);

        if (count($doctor->services) <= 0) {
            $this->doctor->addServicesPrices($doctor);
            return redirect()->route('doctors.edit', $doctor['id']);
        }

        $categories = $this->category->allMainCats();
        $roles = $this->role->getAll();
        $languages = $this->language->getAllActive('id', 'asc');
        $days = Day::with(['availability' => function ($q) use ($doctor) {
            return $q->where('doctor_id', $doctor->id);
        }])->get();

        return view('dashboard.doctors.edit', compact('doctor', 'categories', 'roles', 'languages', 'days'));
    }

    public function update(DoctorRequest $request, $id)
    {
        if ($request->ajax()) {

            $update = $this->doctor->update($request, $id);


            $doctor = $this->doctor->findById($id);

            if ($request['send_email']) {

                if ($doctor->user->status == 1) {

                    $doctorTokens = $doctor->user->firebase_tokens()->pluck('device_token')->all();

                    $title = 'تفعيل الحساب';
                    $message = "لقد تم تفعيل حسابك بنجاح";

                    $data = [
                        'type' => 'account',
                        'doctor_id' => $doctor->id,
                        'title' => $title,
                        'body' => $message
                    ];

                    foreach ($doctorTokens as $doctorToken) {
                        $this->notification->send($doctorToken, $message, $title, $data);
                    }

                    $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');
                    \Mail::to($doctor->user->email)
                        ->cc([$ccDoctorEmail])
                        ->send(new NewDoctorAccountActivate($doctor));
                }

            }


            if ($update) {
                return Response()->json([true, __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false, __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {

            $repose = $this->doctor->delete($id);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }
            return Response()->json([false, __('dashboard.general.ops_alert')]);

        } catch (\PDOException $e) {

            return Response()->json([false, $e->errorInfo[2]]);

        }
    }

    public function deletes(Request $request)
    {
        try {

            $repose = $this->doctor->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false, __('dashboard.general.ops_alert')]);

        } catch (\PDOException $e) {

            return Response()->json([false, $e->errorInfo[2]]);

        }
    }
}
