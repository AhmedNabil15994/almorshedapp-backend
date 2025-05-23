<?php

namespace App\Modules\Pages\ViewComposers;

use App\Modules\Pages\Repository\PageRepository;
use Illuminate\View\View;
use Cache;

class PagesComposer
{
    public $pages = [];

    public function __construct(PageRepository $page)
    {
        $this->pages =  $page->getAll();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pages' , $this->pages);
    }
}
