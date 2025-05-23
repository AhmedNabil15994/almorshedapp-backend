<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Categories\Repository\CategoryRepository as Category;
use App\Modules\Categories\Resources\CategoryResource;
use App\Modules\Doctors\Repository\DoctorRepository as Doctor;
use App\Modules\Doctors\Resources\DoctorResource;
use App\Http\Controllers\Api\ApiController;
use App\Modules\Doctors\Resources\DoctorsListResource;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(Category $category, Doctor $doctor)
    {
        $this->category = $category;
        $this->doctor = $doctor;
    }

    /**
     * Get all active categories
     */
    public function categories()
    {
        $categories = $this->category->allMainCats();

        return $this->sendResponse(CategoryResource::collection($categories));
    }

    /**
     * Get category by id
     */
    public function category(Request $request, $id)
    {
        $category = $this->category->findById($id);

        if (!$category)
            return $this->sendError(__('api.categories.category_not_found'), [], 404);

        return $this->sendResponse(new CategoryResource($category));
    }

    /**
     * get list of doctors by category
     * @param Request $request
     * @return mixed
     */
    public function doctors(Request $request)
    {
        $doctors = $this->category->getAllDoctors();

        if ($request->has('category_id')) {
            $category = $this->category->findById($request->category_id);

            if (!$category)
                return $this->sendError(__('api.categories.category_not_found'), [], 404);

            $doctors = $this->category->getAllDoctors($request->category_id);
        }

//        return $this->sendResponse(DoctorResource::collection($doctors));
        return $this->sendResponse(DoctorsListResource::collection($doctors));

    }

}
