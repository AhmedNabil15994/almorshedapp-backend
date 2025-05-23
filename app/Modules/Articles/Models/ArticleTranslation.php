<?php

namespace App\Modules\Articles\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{
		protected $fillable = ['name'  , 'content'];
}
