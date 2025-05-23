<?php

namespace App\Http\Controllers\Api\V1\UserApp;

require __DIR__ .'/../../../../../Services/Agora/src/RtcTokenBuilder.php';
require __DIR__ .'/../../../../../Services/Agora/src/RtmTokenBuilder.php';

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class AgoraController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * 
     */
    public function index(Request $request)
    {
        $appID = $request->app_id;
        $appCertificate = "d9853ff90fa34fc9bbc1ba110be8afe8";
        $user = $request->user_id;
        $role = \RtmTokenBuilder::RoleRtmUser;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new \DateTime("now", new \DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
        $token = \RtmTokenBuilder::buildToken($appID, $appCertificate, $user, $role, $privilegeExpiredTs);

        return $this->sendResponse(['token' => $token]);
    }


}
