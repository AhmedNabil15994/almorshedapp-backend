<?php

namespace App\Modules\Reservations\Repository;

use App\Mail\CancelReservationMail;
use App\Mail\CancelReservationUserMail;
use App\Mail\ChangeReservationMail;
use App\Mail\ChangeReservationUserMail;
use App\Mail\NewReservationMail;
use App\Mail\NewUserReservationMail;
use App\Services\Firebase\Notification;
use Carbon\Carbon;
use App\Modules\Reservations\Models\Reservation;
use App\Modules\Availabilities\Models\Availability;
use DB;

class ReservationRepository
{
    protected $reservation;
    protected $notification;

    public function __construct(Reservation $reservation, Notification $notification)
    {
        $this->reservation = $reservation;
        $this->notification = $notification;
    }

    public function monthlyReservations()
    {
        $data["reservation_dates"] = $this->reservation
            ->withoutGlobalScope('sort')
            ->where('is_paid', 1)
            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as created_date"))
            ->groupBy('created_date')
            ->pluck('created_date');

        $reservationIncome = $this->reservation
            ->withoutGlobalScope('sort')
            ->where('is_paid', 1)
            ->select(\DB::raw("sum(price) as profit"))
            ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->get();

        $data["profits"] = json_encode(array_pluck($reservationIncome, 'profit'));

        return $data;
    }

    /*
    * Get All Objects
    */
    public function getAll($order = 'id', $sort = 'desc')
    {
        $reservations = $this->reservation->orderBy('reservations.' . $order, $sort)->get();
        return $reservations;
    }

    /**
     * find reservation based on conditions
     * @param array $conditions
     * @return object
     */
    public function findWhere($conditions)
    {
        $reservation = $this->reservation->where($conditions)->first();
        return $reservation;
    }

    /*
     * Find Object By ID
     */
    public function findById($id)
    {
        $reservation = $this->reservation->find($id);
        return $reservation;
    }

    /*
     * Find Object By transaction ID
     */
    public function findByTransactionId($id)
    {
        $reservation = $this->reservation->where('transaction_id', $id);
        return $reservation;
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {
            $reservation = $this->reservation->create([
                'doctor_id' => $request['doctor_id'],
                'user_id' => $request['user_id'],
                'service_id' => $request['service_id'],
//                'availability_id'   => $request['availability_id'],
                'date' => $request['date'],
                'start_time' => $request['start_time'],
                'end_time' => $request['end_time'],
                'price' => $request['price'],
                'order_status_id' => 1,
                'is_paid' => 1,
                // 'order_status_id' => $request['order_status_id'] ?? 1,
                // 'is_paid' => $request['is_paid'] ?? 1,

                'transaction_id' => $request['transaction_id'] ?? null,
                'extra_attributes' => $request['extra_attributes'] ?? null,
            ]);

            ########################## START SEND NOTIFICATIONS & EMAILS TO USERS AND DOCTORS ####################

            $doctorTokens = $reservation->doctor->user->firebase_tokens()->pluck('device_token')->all();
            $userTokens = $reservation->user->firebase_tokens()->pluck('device_token')->all();


            $title = "حجز جديد مع {$reservation->user->name}";
            $titleToUser = "حجز جديد مع {$reservation->doctor->user->name}";
            $message = "لديك حجز جديد بتاريخ {$reservation->date} - " . date('h a', strtotime($reservation->start_time . ':00'));

            $data = [
                'type' => 'reservation',
                'reservation_id' => $reservation->id,
                'body' => $message
            ];

            if (count($doctorTokens) > 0) {
                $data['title'] = $title;
                foreach ($doctorTokens as $doctorToken) {
                    $this->notification->send($doctorToken, $message, $title, $data);
                }
            }

            if (count($userTokens) > 0) {
                $data['title'] = $titleToUser;
                foreach ($userTokens as $userToken) {
                    $this->notification->send($userToken, $message, $titleToUser, $data);
                }
            }

            $ccUserEmail = $reservation->user->email;
            $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');

            if (config("services.send_mail_alert")) {
                \Mail::to($reservation->user->email)
//                ->cc([$ccUserEmail])
                ->send(new NewUserReservationMail($reservation));

                \Mail::to($reservation->doctor->user->email)
                ->cc([$ccDoctorEmail])
                ->send(new NewReservationMail($reservation));


                ########################## END SEND NOTIFICATIONS & EMAILS TO USERS AND DOCTORS ######################
            }
            DB::commit();
            return $reservation;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Find Object By ID & Update to DB
    */
    public function update($request, $id)
    {
        DB::beginTransaction();

        try {
            $reservation = $this->findById($id);
            $oldReservation = $this->findById($id);

            $status = $reservation->order_status_id;
            $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');

            if ($request->order_status_id == 2 and $status != 2) {
                $reservation->reason = $request->reason ?? $request->reason;

                if (config("services.send_mail_alert")) {
                    \Mail::to($reservation->user->email)
//                    ->cc([$reservation->user->email])
                    ->send(new CancelReservationUserMail($reservation));

                    \Mail::to($reservation->doctor->user->email)
                    ->cc([$ccDoctorEmail])
                    ->send(new CancelReservationMail($reservation));
                }
            }

            $attributes['reason'] = $request->reason ?? $request->reason;
            $attributes['order_status_id'] = $request->order_status_id;
            $attributes['doctor_id'] = $request->doctor_id;

            if ($request->has('required_at') and isset($request->required_at)) {
                $availability = Availability::find($request->availability_id);
                $attributes['date'] = date('Y-m-d', strtotime($request->required_at));
                $attributes['availability_id'] = $request->availability_id;
                $attributes['start_time'] = $availability->available_from;
                $attributes['end_time'] = $availability->available_to;
            }

            $reservation->update($attributes);

            if ($request->has('required_at') and isset($request->required_at)) {
                if (config("services.send_mail_alert")) {
                    //send change
                    \Mail::to($reservation->user->email)
//                    ->cc([$reservation->user->email])
                    ->send(new ChangeReservationUserMail($reservation, $oldReservation));

                    // send email to doctor
                    \Mail::to($reservation->doctor->user->email)
                    ->cc([$ccDoctorEmail])
                    ->send(new ChangeReservationMail($reservation, $oldReservation));
                }

                $userTokens = $reservation->user->firebase_tokens()->pluck('device_token')->all();

                $title = 'تغيير موعد الحجز';
                $message = "لقد تم تغيير موعد الحجز لتاريخ {$reservation->date} من {$reservation->start_time} الى {$reservation->end_time}";

                $data = [
                    'type' => 'reservation',
                    'reservation_id' => $reservation->id,
                    'title' => $title,
                    'body' => $message
                ];

                $this->notification->send($userTokens, $message, $title, $data);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Update reservation
     * @param Reservation $reservation
     * @return mixed
     */
    public function updateReservation($reservation)
    {
        $reservationId = explode('=', $reservation['ApiCustomFileds']);
        $id = $reservationId[sizeof($reservationId) - 1];

        $reservation = $this->findById($id);

        $reservation->update([
            'is_paid' => 1,
        ]);

        return true;
    }

    /*
    * Find Object By ID & Delete it from DB
    */
    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $model = $this->findById($id);

            if ($model) {
                $model->delete();
            } else {
                return false;
            }

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
        return $reservations = $this->reservation->destroy($request['ids']);
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->reservation
            ->leftJoin('users as u', 'u.id', '=', 'reservations.user_id')
//            ->leftJoin('users as d', 'd.id', '=', 'reservations.doctor_id')
            ->select('reservations.*', 'u.name as username'/*, 'd.id as doctor_id', 'd.name as doctor_name'*/, 'u.id as user_id', 'u.email as user_email', 'u.mobile as user_mobile', DB::raw('DATE_FORMAT(reservations.created_at, "%Y-%m-%d") as createdAt'))
            ->where(function ($query) use ($request) {
                $query
                    ->where('reservations.id', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('reservations.date', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('reservations.doctor_id', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('u.id', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('u.name', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('u.email', 'like', '%' . $request->input('search.value') . '%')
                    ->orWhere('u.mobile', 'like', '%' . $request->input('search.value') . '%');

                /*->orWhere('d.name', 'like', '%' . $request->input('search.value') . '%')
                ->orWhere('u.doctor.user.email', 'like', '%' . $request->input('search.value') . '%');*/
            });

        $query = self::filterDataTable($query, $request);
        return $query;
    }


    /*
    * Filteration for Datatable
    */
    public static function filterDataTable($query, $request)
    {
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('reservations.date', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('reservations.date', '<=', $request['req']['to']);
        }


        if (isset($request['req']['doctor_name'])) {
            $query->where('reservations.doctor_id', '=', $request['req']['doctor_name']);
        }

        if (isset($request['req']['canceled_order'])) {
            $query->where('reservations.order_status_id', '=', $request['req']['canceled_order']);
        }

        if (isset($request['req']['complete_order'])) {
            $query->where('reservations.order_status_id', '=', $request['req']['complete_order']);
        }

        return $query;
    }
}
