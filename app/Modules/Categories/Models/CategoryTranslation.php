<?php

namespace App\Modules\Categories\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
		protected $fillable = [ 'title'  , 'slug' , 'seo_keywords' , 'seo_description' ];
}
