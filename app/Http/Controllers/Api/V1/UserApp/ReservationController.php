<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Mail\NewReservationMail;
use App\Mail\NewUserReservationMail;
use App\Services\Firebase\Notification;
use App\Modules\Reservations\Models\Reservation;
use App\Modules\Reservations\Requests\ReservationRequest;
use App\Modules\Reservations\Repository\ReservationRepository;
use App\Modules\Availabilities\Repository\AvailabilityRepository;
// use App\Modules\Payment\Services\PaymentAPIService;
use App\Modules\Payment\Services\UPaymentAPIService as PaymentAPIService;
use App\Modules\Reservations\Resources\ReservationResource;
use App\Modules\Reservations\Resources\ReservationCollection;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class ReservationController extends ApiController
{
    protected $reservationRepo;
    protected $availabilityRepo;
    protected $paymentApiService;
    protected $notification;

    /**
     * Create a new controller instance.
     */
    public function __construct(ReservationRepository $reservationRepo, AvailabilityRepository $availabilityRepo, PaymentAPIService $paymentApiService, Notification $notification)
    {
        $this->reservationRepo = $reservationRepo;
        $this->availabilityRepo = $availabilityRepo;
        $this->paymentApiService = $paymentApiService;
        $this->notification = $notification;
    }

    /**
     * Show reservation
     * @param var $id
     * @return mixed
     */
    public function show($id)
    {
        $reservation = $this->reservationRepo->findById($id);

        if (!$reservation) {
            return $this->sendError(__('api.reservations.reservation_not_found'), [], 404);
        }

        return $this->sendResponse(new ReservationResource($reservation));
    }

    /**
     * Store reservation
     * @param ReservationRequest $request
     * @return mixed
     */
    public function store(ReservationRequest $request)
    {
        //
    }

    /**
     * Update reservation
     * @param ReservationRequest $request
     * @param  $id
     * @return mixed
     */
    public function update(ReservationRequest $request, $id)
    {
        $reservation = $this->reservationRepo->findById($id);

        if (!$reservation) {
            return $this->sendError(__('api.reservations.reservation_not_found'), [], 404);
        }

        $reservation->notes = $request->notes;
        $reservation->save();

        return $this->sendResponse(new ReservationResource($reservation));
    }

    /**
     * Execute payment
     * @param ReservationRequest $request
     * @return mixed
     */
    public function executePayment(ReservationRequest $request)
    {
        $today = date('Y-m-d');
        $now = (date('H') == 0) ? 24 : date('H');

        $availability = $this->availabilityRepo->findById($request->availability_id);

        $price = \DB::table('doctor_service')
            ->where([
                ['doctor_id', $request->doctor_id],
                ['service_id', $request->service_id]
            ])->value('price');

        $start = ($availability->available_from == 0) ? 24 : $availability->available_from;
        $end = ($availability->available_to == 0) ? 24 : $availability->available_to;
        $reservationDate = $request->date;

        $conditions = [
            'doctor_id' => $request->doctor_id, 'availability_id' => $request->availability_id, 'date' => $request->date
        ];

        $reservation = $this->reservationRepo->findWhere($conditions);

        if (empty($reservation)) {
            if ($start <= $now and $request->date == $today) {
                return $this->sendError(__('api.reservations.choose_another_date'), [], 400);
            }

            $request->merge([
                'price' => $price,
                'user_id' => auth()->user()->id,
                'start_time' => $availability->available_from,
                'end_time' => $availability->available_to,

                // 'order_status_id' => 5, // pending
                // 'is_paid' => 0,
                'transaction_id' => str_replace('-', '', \Str::uuid()),
            ]);

            // Make sure the new reservation is created
            // if (! $this->reservationRepo->create($request->all())) {
            //     return $this->sendError(__('api.general.error_happended'), [], 500);
            // }

            logger('new reservation');
            logger($request->all());

            // Cache the new reservation data for an hour
            \Cache::store('file')->put('order-' . $request->transaction_id, $request->all(), now()->addDays(3));

            $payment = $this->paymentApiService->send($request);

            logger($payment);

            return $this->sendResponse([
                'paymentUrl' => $payment['paymentURL'],
            ]);
        } else {
            if ($reservation->user_id != auth()->user()->id) {
                return $this->sendError(__('api.reservations.time_not_available'), [], 400);
            } elseif ($reservation->user_id == auth()->user()->id and $now > $end and $reservation->is_paid and $request->date <= $today) {
                return $this->sendError(__('api.reservations.missed_reservation'), [], 400);
            } elseif ($reservation->user_id == auth()->user()->id and $now < $start and $reservation->is_paid and $request->date = $today) {
                return $this->sendError(__('api.reservations.already_reserved'), [], 400);
            } elseif ($reservation->user_id == auth()->user()->id and $reservation->is_paid and $request->date > $today) {
                return $this->sendError(__('api.reservations.already_reserved'), [], 400);
            }
        }
    }

    /**
     * Handle UPayments notification/webhook.
     *
     * @param Request $request
     * @return void
     */
    public function uPaymentsWebhook(Request $request)
    {
        logger('webhook');
        logger($request->all());

        if (
            $request->has('OrderID') && $request->has('Result')
            && \Cache::store('file')->has('order-' . $request->input('OrderID'))
        ) {
            $result = strtoupper($request->get('Result'));

            // Handle CAPTURED response
            if ($result === 'CAPTURED') {
                // TODO: Create a new reservation for the user.
                // TODO: Send FCM and email notifications.

                // Handle NOT CAPTURED or CANCELED response
            } else {
                // Remove the cached reservation if payment not captured
                \Cache::store('file')->forget('order-' . $request->input('OrderID'));
            }
        }

        $reservation = $this->reservationRepo
            ->findByTransactionId($request->input('OrderID'));

        if ($reservation) {
            $reservation->update([
                'order_status_id' => ($request->Result === 'CAPTURED') ? 1 : 2,
                'is_paid' => ($request->Result === 'CAPTURED') ? 1 : 0,
                'extra_attributes' => \GuzzleHttp\json_encode($request->all()),
            ]);
        }
    }

    /**
     * success reservation payment.
     */
    public function successPayment(Request $request)
    {
        // $payment = $this->paymentApiService->success($request);

        // $fields = explode(',', $payment['ApiCustomFileds']);

        // $data = array();

        // foreach ($fields as $field) {
        //     list($key, $value) = explode('=', $field);
        //     $data[$key] = $value;
        // }

        logger('success page');
        logger($request->all());

        // Make sure the new reservation is cached
        if (!$request->has('OrderID') || !\Cache::store('file')->has('order-' . $request->input('OrderID'))) {
            logger('error on success page');

            return $this->sendError(__('api.general.error_happended'), [], 400);
        }

        // Create a new reservation
        $reservation = $this->reservationRepo->create(array_merge(
            \Cache::store('file')->get('order-' . $request->input('OrderID')),
            [
                'extra_attributes' => ['upayments_response' => $request->all()],
            ]
        ));

        \Cache::store('file')->forget('order-' . $request->input('OrderID'));

        // $reservation = $this->reservationRepo
        //     ->findByTransactionId($request->input('OrderID'));
        // $reservation = $this->reservationRepo->create($data);

        if ($reservation) {
            // TODO: change payment status to (paid)
            // TODO: Insert $request->all() into extra_attributes
            // $reservation->update([
            //   'order_status_id' => ($request->Result === 'CAPTURED') ? 1 : 2,
            //   'is_paid' => ($request->Result === 'CAPTURED') ? 1 : 0,
            //   'extra_attributes' => $request->all(),
            // ]);

            $doctorTokens = $reservation->doctor->user->firebase_tokens()->pluck('device_token')->all();

            // $time = $reservation->start_time / 12 ;

            $title = "حجز جديد مع {$reservation->user->name}";
            $message = "لديك حجز جديد بتاريخ {$reservation->date} - " . date('h a', strtotime($reservation->start_time . ':00'));

            $data = [
                'type' => 'reservation',
                'reservation_id' => $reservation->id,
                'title' => $title,
                'body' => $message
            ];

            foreach ($doctorTokens as $doctorToken) {
                $this->notification->send($doctorToken, $message, $title, $data);
            }

            $ccUserEmail = $reservation->user->email;
            $ccDoctorEmail = $reservation->doctor->user->email;
            if (config("services.send_mail_alert")) {
                \Mail::to($reservation->user->email)
                //                ->cc([$ccUserEmail])
                                ->send(new NewUserReservationMail($reservation));

                $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');
                \Mail::to($reservation->doctor->user->email)
                                ->cc([$ccDoctorEmail])
                                ->send(new NewReservationMail($reservation));
            }


            return $this->sendResponse('Reservation Created Successfuly');
        }
    }

    /**
     * failed reservation payment.
     */
    public function failedPayment(Request $request)
    {
        logger('forget: order-' . $request->input('OrderID'));
        \Cache::store('file')->forget('order-' . $request->input('OrderID'));
        // logger($request->all());

        // $reservation = $this->reservationRepo
        //     ->findByTransactionId($request->input('OrderID'));

        // if ($reservation) {
        //     $reservation->update([
        //         'order_status_id' => ($request->Result === 'CAPTURED') ? 1 : 2,
        //         'is_paid' => ($request->Result === 'CAPTURED') ? 1 : 0,
        //         'extra_attributes' => $request->all(),
        //     ]);
        // }

        return $this->sendError(__('api.general.error_happended'), [], 400);
        // return $this->paymentApiService->error($request);
    }

    /**
     * Get list of user reservations
     * @return mixed
     */
    public function getUserReservations()
    {
        if (auth()->user()) {
            $reservations = Reservation::where('user_id', auth()->user()->id)
                ->sorted()
                ->paid()
                ->paginate(10);

            return new ReservationCollection($reservations);
        } else {
            return $this->sendError(__('api.doctors.user_not_found'), [], 404);
        }
    }

    /**
     * get list of doctor reservations
     * @return mixed
     */
    public function getDoctorReservations()
    {
        if (auth()->user()->doctor) {
            $reservations = Reservation::where('doctor_id', auth()->user()->doctor->id)
                ->sorted()
                ->paid()
                ->paginate(10);

            return new ReservationCollection($reservations);
        } else {
            return $this->sendError(__('api.doctors.doctor_not_found'), [], 404);
        }
    }
}
