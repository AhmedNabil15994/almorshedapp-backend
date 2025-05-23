<?php

namespace App\Modules\Governorates\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Governorate extends Model
{
		use Translatable;

    protected $fillable 					= [ 'status' ];
		public $translationModel 			= 'App\Modules\Governorates\Models\GovernorateTranslation';
		public $translatedAttributes 	= [ 'title' ];

}
