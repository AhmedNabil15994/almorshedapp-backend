<?php

namespace App\Console;

use App\Mail\UpComingReservation5MinMail;
use App\Mail\UserUpComingReservation5MinMail;
use App\Services\Firebase\Notification;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\UpComingReservationMail;
use App\Mail\UserUpComingReservationMail;
use App\Modules\Reservations\Models\Reservation;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $ccDoctorEmail = isset(config('setting.env')['MAIL_CC']) ? config('setting.env')['MAIL_CC'] : env('MAIL_CC');

        $schedule->command('debugbar:clear')->daily()->at('04:00');
        // $schedule->command('telescope:clear')->daily()->at('04:00');

        $schedule->command('backup:clean')->daily()->at('04:00');
        $schedule->command('backup:run')->daily()->at('05:00');

        $schedule->call(function () use ($ccDoctorEmail) {
            $notification = new Notification;

            $reservations = Reservation::with('service')->where('date', '=', date('Y-m-d'))
                ->where('order_status_id', 1)
                ->where('send_notification', null)
                ->get();

            if ($reservations) {
                foreach ($reservations as $reservation) {
                    $today = date('Y-m-d');
                    $now = (date('H') == 0) ? 24 : date('H');
                    $start = ($reservation->start_time == 0) ? 24 : $reservation->start_time;
                    $end = ($reservation->end_time == 0) ? 24 : $reservation->end_time;
                    $reservationDate = $reservation->date;

                    // $currentTime = Carbon::now('Asia/Kuwait');
                    // $reservationTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservationDate.' '.$reservation->end_time.':00:00');
                    // $startTime = Carbon::createFromFormat('Y-m-d H:i:s', $reservationDate.' '.$reservation->start_time.':00:00');
                    //
                    // return $remainingInSeconds = $startTime->diffInSeconds($currentTime);

                    $userTokens = $reservation->user->firebase_tokens()->pluck('device_token')->all();
                    $doctorTokens = $reservation->doctor->user->firebase_tokens()->pluck('device_token')->all();


                    if (($start - 2) == $now) {
                        $title = 'موعد حجز';
                        $message = "سوف تبدا الجلسة في  -  " . date('h a', strtotime($start . ':00'));

                        $data = [
                            'type' => 'reservation',
                            'reservation_id' => $reservation->id,
                            'title' => $title,
                            'body' => $message
                        ];

                        foreach ($userTokens as $userToken) {
                            $notification->send($userToken, $message, $title, $data);
                        }

                        foreach ($doctorTokens as $doctorToken) {
                            $notification->send($doctorToken, $message, $title, $data);
                        }

                        \Mail::to($reservation->user->email)
//                        ->cc([$reservation->user->email])
                            ->send(new UserUpComingReservationMail($reservation));

                        \Mail::to($reservation->doctor->user->email)
                            ->cc([$ccDoctorEmail])
                            ->send(new UpComingReservationMail($reservation));

                        DB::table('reservations')->where('id', $reservation->id)->update([
                            'send_notification' => true
                        ]);
                    }
                }
            }

            $upComingReservations = Reservation::with('service')->where('date', '=', date('Y-m-d'))
                ->where('order_status_id', 1)
                ->where('send_notification', 1)
                ->get();

            if ($upComingReservations) {
                foreach ($upComingReservations as $upComingReservation) {
                    $h = date('H:i:s', strtotime($upComingReservation->start_time . ':00'));
                    $oldDate = date("Y-m-d H:i:s", strtotime($upComingReservation->date . ' ' . $h));
                    $time = strtotime($oldDate);

                    $time = $time - (5 * 60);

                    $date = date("Y-m-d H:i:s", $time);
                    $now = date("Y-m-d H:i:s");

                    if ($date <= $now) {
                        $userTokens = $upComingReservation->user->firebase_tokens()->pluck('device_token')->all();
                        $doctorTokens = $upComingReservation->doctor->user->firebase_tokens()->pluck('device_token')->all();

                        $title = 'موعد حجز';
                        $message = "سوف تبدا الجلسه بعد ٥ دقائق";

                        $data = [
                            'type' => 'reservation',
                            'reservation_id' => $upComingReservation->id,
                            'title' => $title,
                            'body' => $message
                        ];

                        foreach ($userTokens as $userToken) {
                            $notification->send($userToken, $message, $title, $data);
                        }

                        foreach ($doctorTokens as $doctorToken) {
                            $notification->send($doctorToken, $message, $title, $data);
                        }

                        DB::table('reservations')->where('id', $upComingReservation->id)->update([
                            'send_notification' => 2
                        ]);

                        \Mail::to($upComingReservation->user->email)
//                        ->cc([$reservation->user->email])
                            ->send(new UserUpComingReservation5MinMail($upComingReservation));

                        \Mail::to($upComingReservation->doctor->user->email)
                            ->cc([$ccDoctorEmail])
                            ->send(new UpComingReservation5MinMail($upComingReservation));

                        /*\Mail::to($upComingReservation->user->email)
//                        ->cc([$reservation->user->email])
                            ->send(new UserUpComingReservation5MinMail($upComingReservations));

                        \Mail::to($upComingReservation->doctor->user->email)
                            ->cc([$ccDoctorEmail])
                            ->send(new UpComingReservation5MinMail($upComingReservations));*/
                    }
                }
            }

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Asia/Kuwait';
    }
}
