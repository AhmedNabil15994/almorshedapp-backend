<?php

namespace App\Modules\Pages\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
		protected $fillable = [ 'title' , 'description' , 'slug' , 'seo_keywords' , 'seo_description'];
}
