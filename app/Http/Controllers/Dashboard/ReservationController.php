<?php

namespace App\Http\Controllers\Dashboard;

use App\Modules\Services\Repository\ServiceRepository;
use App\Modules\Doctors\Repository\DoctorRepository;
use App\Modules\Users\Repository\UserRepository;
use App\Modules\OrderStatuses\Repository\OrderStatusRepository as OrderStatus;
use App\Modules\Reservations\Repository\ReservationRepository as ReservationRepo;
use App\Modules\Availabilities\Models\Availability;
use App\Modules\Reservations\Models\Reservation;
use App\Modules\Doctors\Models\Doctor;
use App\Modules\Reservations\Requests\ReservationRequest;
use App\Modules\Reservations\Requests\UpdateReservationRequest;
use Illuminate\Http\Request;
use DataTable;
use App\Modules\Reservations\Resources\DataTableResource;

class ReservationController extends DashboardController
{
    protected $reservation;
    protected $orderStatus;

    public function __construct(ReservationRepo $reservation, OrderStatus $orderStatus , DoctorRepository $doctorRepository , UserRepository $user , ServiceRepository $service)
    {
        $this->service     = $service;
        $this->user        = $user;
        $this->reservation = $reservation;
        $this->orderStatus = $orderStatus;
        $this->doctor      = $doctorRepository;
    }

    public function index()
    {
        $doctors = $this->doctor->getAll();

        return view('dashboard.reservations.home' , compact('doctors'));
    }

    public function dataTable(Request $request)
    {
        return DataTable::GenerateTable2($request, $this->reservation->QueryTable($request));
    }

    public function create()
    {
        $services       = $this->service->getAll();
        $users          = $this->user->getAllUsers();
        $doctors        = $this->doctor->getAllDoctors();
        $orderStatuses  = $this->orderStatus->getAll('id', 'asc');

        return view('dashboard.reservations.create' , compact('orderStatuses','doctors','users','services'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $reservation  = $this->reservation->findById($id);
        $doctors = $this->doctor->getAllDoctors();
//        $doctors = $this->doctor->getAll();

        $orderStatuses = $this->orderStatus->getAll('id', 'asc');

        if (!$reservation)
            return abort(404);

        return view('dashboard.reservations.edit' , compact('reservation', 'orderStatuses','doctors'));
    }

    public function store(Request $request)
    {
        $create = $this->reservation->create($request);

        if ($create) {
            return Response()->json([true , __('dashboard.general.create_success_alert')]);
        }

        return Response()->json([false  , __('dashboard.general.ops_alert')]);
    }

    public function update(UpdateReservationRequest $request, $id)
    {
        if ($request->ajax()){

            $update = $this->reservation->update($request , $id);

            if($update){
                return Response()->json([true , __('dashboard.general.update_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->reservation->delete($id);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }
            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $repose = $this->reservation->deleteAll($request);

            if ($repose) {
                return Response()->json([true, __('dashboard.general.delete_success_alert')]);
            }

            return Response()->json([false  , __('dashboard.general.ops_alert')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function getAvailableTimes(Doctor $doctor, $date)
    {
        $days = [0 => 2, 1 => 3, 2 => 4, 3 => 5, 4 => 6, 5 => 7, 6 => 1];
        $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek;
        $day_id = $days[$dayOfWeek];

        //get reserved time for date
        $availabilityIds = Reservation::where([
            ['date', $date],
            ['doctor_id', $doctor->id]
        ])
        ->whereNotNull('availability_id')
        ->pluck('availability_id');

        //get available time for date
        $availableTimes = Availability::where([
            ['doctor_id', $doctor->id],
            ['day_id', $day_id]
        ])
        ->whereNotIn('id', $availabilityIds)
        ->pluck('available_from', 'id');

        return json_encode($availableTimes);
    }
}
