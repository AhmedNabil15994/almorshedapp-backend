<?php

namespace App\Modules\Services\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Service extends Model
{
	use Translatable;

	protected $fillable = ['status', 'image'];
	
	public $translationModel = 'App\Modules\Services\Models\ServiceTranslation';
	
	public $translatedAttributes 	= ['name', 'description'];
}
