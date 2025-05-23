<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Modules\Doctors\Models\Doctor;

use App\Modules\Reservations\Models\Reservation;
use App\Modules\Users\Models\User as UserModel;
use App\Modules\Users\Repository\UserRepository as User;
use App\Modules\Doctors\Repository\DoctorRepository as DoctorRepo;

use Illuminate\Http\Request;
use App\Modules\Reservations\Repository\ReservationRepository;

class ReportController extends Controller
{

        function __construct(ReservationRepository $reservationRepo, UserModel $user, Doctor $doctor, Reservation $reservation,User $userRepo,DoctorRepo $doctorRepo)
        {
            $this->reservationRepo  = $reservationRepo;
            $this->doctorRepo       = $doctorRepo;
            $this->userRepo         = $userRepo;
            $this->user             = $user;
            $this->doctor           = $doctor;
            $this->reservation      = $reservation;
        }


      public  function index()
        {
            $monthlyReservations    = $this->reservationRepo->monthlyReservations();
            $doctorCreated          = $this->doctorRepo->doctorCreatedStatistics();
            $userCreated            = $this->userRepo->userCreatedStatistics();
            $data['allUsers']       = $this->user->count();
            $data['alldoctors']     =   $this->doctor->count();
            $data['allreservation'] = $this->reservation->count();

            return view('dashboard.reports.home' , $data , compact('userCreated','doctorCreated','monthlyReservations'));
        }

}
