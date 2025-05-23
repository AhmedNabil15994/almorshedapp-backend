<?php

namespace App\Modules\Articles\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Article extends Model
{
	use Translatable;

	protected $fillable = ['status' , 'image'];
	
	public $translationModel = 'App\Modules\Articles\Models\ArticleTranslation';
	
	public $translatedAttributes 	= ['name' , 'content'];

}
