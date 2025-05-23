<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Pages\Repository\PageRepository as Page;
use App\Modules\Pages\Resources\PageResource;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class PageController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * Get all active pages
     */
    public function pages()
    {
        $pages = $this->page->getAllActive();

        return $this->sendResponse(PageResource::collection($pages));
    }

    /**
     * Get Page by id
     */
    public function page(Request $request , $id)
    {
        $page = $this->page->findById($id);

        if(!$page)
            return $this->sendError(__('api.pages.page_not_found'), [], 404);

        return $this->sendResponse(new PageResource($page));
    }

}
