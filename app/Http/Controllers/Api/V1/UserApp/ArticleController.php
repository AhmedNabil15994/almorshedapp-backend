<?php

namespace App\Http\Controllers\Api\V1\UserApp;

use App\Modules\Articles\Repository\ArticleRepository as Article;
use App\Modules\Articles\Resources\ArticleResource;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;

class ArticleController extends ApiController
{
    /**
     * Create a new controller instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get all active articles
     */
    public function articles()
    {
        $articles = $this->article->getAllActive();

        return $this->sendResponse(ArticleResource::collection($articles));
    }

    /**
     * Get Ad by id
     */
    public function article(Request $request , $id)
    {
        $article = $this->article->findById($id);

        if(!$article)
            return $this->sendError(__('api.articles.article_not_found'), [], 404);

        return $this->sendResponse(new ArticleResource($article));
    }

}
