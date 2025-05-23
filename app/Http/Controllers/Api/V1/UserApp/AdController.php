<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Ads\Repository\AdRepository as Ad;
use App\Modules\Ads\Resources\AdResource;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class AdController extends ApiController
{
    protected $ad;

    /**
     * Create a new controller instance.
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    /**
     * Get all active ads
     */
    public function ads()
    {
        $ads = $this->ad->getAllActive();

        return $this->sendResponse(AdResource::collection($ads));
    }

    /**
     * Get Ad by id
     */
    public function ad(Request $request , $id)
    {
        $ad = $this->ad->findById($id);

        if(!$ad)
            return $this->sendError(__('api.ads.ad_not_found'), [], 404);

        return $this->sendResponse(new AdResource($ad));
    }

}
