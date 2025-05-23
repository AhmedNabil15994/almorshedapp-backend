<?php

namespace App\Modules\Languages\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Language extends Model
{
	use Translatable;

	protected $fillable = ['language', 'status'];
	
	public $translationModel = 'App\Modules\Languages\Models\LanguageTranslation';
	
	public $translatedAttributes 	= ['name'];
}
