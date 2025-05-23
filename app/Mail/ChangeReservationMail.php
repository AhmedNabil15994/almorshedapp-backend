<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $oldReservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $oldReservation)
    {
        $this->reservation = $reservation;
        $this->oldReservation = $oldReservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.change-reservation');
    }
}
