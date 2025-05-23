<?php

namespace App\Modules\Provinces\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Province extends Model
{
		use Translatable;

    protected $fillable 					= [ 'status' , 'governorate_id'];
		public $translationModel 			= 'App\Modules\Provinces\Models\ProvinceTranslation';
		public $translatedAttributes 	= [ 'title' ];

}
