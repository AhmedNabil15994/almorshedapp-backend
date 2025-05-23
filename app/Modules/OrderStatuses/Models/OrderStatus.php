<?php

namespace App\Modules\OrderStatuses\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class OrderStatus extends Model
{
	use Translatable;

	protected $fillable = ['code'];
	
	public $translationModel = 'App\Modules\OrderStatuses\Models\OrderStatusTranslation';
	
	public $translatedAttributes = ['title'];

}
