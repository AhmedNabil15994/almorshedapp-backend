<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    protected $request;

    public function __construct($request)
    {
        $this->request  = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->request;

        $address = 'support@almorshedapp.com';
        $subject = 'contact us e-mail';
        $name    = $data['name'];

        return $this->markdown('emails.contact_us')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->subject($subject)
                    ->with(['data' => $data]);
    }
}
