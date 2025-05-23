<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Languages\Repository\LanguageRepository as Language;
use App\Modules\Languages\Resources\LanguageResource;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class LanguageController extends ApiController
{
    protected $language;

    /**
     * Create a new controller instance.
     */
    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * Get all active languages
     */
    public function index()
    {
        $languages = $this->language->getAllActive();

        return $this->sendResponse(LanguageResource::collection($languages));
    }

}
