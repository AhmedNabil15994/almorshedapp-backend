<?php

namespace App\Modules\Users\Services;

use App\Modules\Users\Repository\UserRepository;
use Carbon\Carbon;
use Auth;

class UserService
{
    protected $userRepo;

    /**
     * Create a new controller instance.
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo    = $userRepo;
    }

    public function generateToken($user = null)
    {
        $user = $user ? $user : auth()->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;

        $token->save();

        return $tokenResult;
    }

    public function tokenExpiresAt($token)
    {
        return Carbon::parse($token->token->expires_at)->toDateTimeString();
    }
}
