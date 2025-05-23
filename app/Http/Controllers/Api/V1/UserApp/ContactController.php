<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Contact\Repository\ContactRepository as Contact;
use App\Modules\Contact\Requests\SendMailRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Mail\ContactUs;
use Mail;

class ContactController extends ApiController
{
    protected $contact;

    /**
     * Create a new controller instance.
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Send email
     */
    public function send(SendMailRequest $request)
    {
        $create = $this->contact->create($request);
        $mail = Mail::to(env('ADMIN_EMAIL'))->send(new ContactUs($request));

        if ($create) {
            return $this->sendResponse([], __('api.contact.msg_sent_success'));
        }

        return $this->sendError(__('api.general.error_happended'), [], 400);
    }

}
