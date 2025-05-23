<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Users\Models\UserFireBaseToken;
use App\Modules\Users\Requests\UserFirebaseTokenRequest;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserFirebaseTokenController extends ApiController
{
    /*protected $token;

    function __construct(UserFireBaseToken $token)
    {
        $this->token = $token;
    }*/

    /**
     * store or update user firebase token
     * @param Request $request
     * @return mixed
     */
    public function store(UserFirebaseTokenRequest $request)
    {
        $request['platform'] = $request->device_type == 1 ? 'ANDROID' : ($request->device_type == 2 ? 'IOS' : "WEB");
        UserFireBaseToken::updateOrCreate([
            'device_token' => $request->firebase_token,
        ], [
            'device_token' => $request->firebase_token,
            'user_id' => $request->user_id ?? null,
            'platform' => $request->platform,
        ]);
        return $this->sendResponse([], 'Firebase token saved successfully');

        /*auth()->user()->firebase_tokens()->updateOrCreate(
            ['device_type' => $request->device_type],
            ['firebase_token' => $request->firebase_token, 'device_type' => $request->device_type]
        );*/

        /*DB::beginTransaction();

        try {
            $this->updateUserTokens($request);

            UserFireBaseToken::updateOrCreate([
                'firebase_token' => $request->firebase_token,
            ], [
                'firebase_token' => $request->firebase_token,
                'user_id' => $request->user_id,
                'device_type' => $request->device_type,
            ]);

            DB::commit();
            return $this->sendResponse([], 'Firebase token saved successfully');

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }*/
    }

    public function updateUserTokens($request)
    {
        $tokens = $this->token->where('user_id', '=', $request['user_id'])->get();

        if (count($tokens) > 0) {
            foreach ($tokens as $token) {
                $token->update([
                    'user_id' => null
                ]);
            }
        }

    }

}
