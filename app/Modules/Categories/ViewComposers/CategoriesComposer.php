<?php

namespace App\Modules\Categories\ViewComposers;

use App\Modules\Categories\Repository\CategoryRepository;
use Illuminate\View\View;

class CategoriesComposer
{
    public $categories = [];

    /**
     * Create a Home composer.
     *
     *  @param HomeRepository $Home
     *
     * @return void
     */
    public function __construct(CategoryRepository $category)
    {
        $this->categories =  $category->allMainCats();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('main_categories' , $this->categories);
    }
}
