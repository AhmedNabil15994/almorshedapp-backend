<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Ratings\Requests\RatingRequest;
use App\Modules\Users\Repository\UserRepository as User;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends ApiController
{
    protected $user;

    /**
     * Create a new controller instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * update or create rating for doctor
     * @param  RatingRequest $request
     * @return mixed
     */
    public function updateOrCreateRating(RatingRequest $request)
    {
        $user = $this->user->findById($request->doctor_id);

        if (!$user)
            return $this->sendError(__('api.doctors.doctor_not_found'), [], 404);

        $rating = $user->ratings()->updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'user_id' => auth()->user()->id,
                'rating'  => $request->rating,
            ]
        );

        return $this->sendResponse([], __('api.ratings.add_rating_success'));
    }

    public function deleteUserAccount(Request $request)
    {
        $user = $this->user->findById(auth()->id());
        $prefix = 'toc_' . $user->id . '_';

        if (Str::startsWith($user->email, $prefix) || Str::startsWith($user->mobile, $prefix))
            return $this->sendError(__('api.users.user_deleted_before'), [], 401);

        $email = $prefix . $user->email;
        $mobile = $prefix . $user->mobile;

        $user->update([
            'email' => $email,
            'mobile' => $mobile,
        ]);
        // $user->fresh();
        return $this->sendResponse([], __('api.users.user_deleted_successfully'));
    }
}
