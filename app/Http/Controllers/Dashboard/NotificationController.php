<?php

namespace App\Http\Controllers\Dashboard;

use App\Jobs\GeneralNotificationJob;
use Illuminate\Http\Request;
use App\Modules\Users\Repository\UserRepository as User;
use App\Services\Firebase\Notification;
use App\Services\Firebase\SendNotification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class NotificationController extends DashboardController
{
    use SendNotification;

    public function __construct(User $user)
    {
        $this->userModel = $user;
    }

    public function notifyForm()
    {
        return view('dashboard.notifications.create');
    }

    public function push_notification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

//        $tokens = $this->userModel->getAllTokens();
        $data = [
            'title' => $request['title'],
            'body' => $request['body'],
            'type' => 'general',
            'id' => null,
        ];

        dispatch(new GeneralNotificationJob($data));
//        $this->send($data, $tokens);

        return back()->with(['msg' => 'Notification Send Successfully', 'alert' => 'success']);
    }
}
