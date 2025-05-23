<?php

namespace App\Modules\Ads\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Ad extends Model
{
	use Translatable;

	protected $fillable = ['status' , 'link', 'image', 'start_date', 'end_date'];

	protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];
	
	public $translationModel = 'App\Modules\Ads\Models\AdTranslation';
	
	public $translatedAttributes 	= ['name'];

	public function setStartDateAttribute($value)
	{
		$this->attributes['start_date'] = Carbon::parse($value);
	}

	public function setEndDateAttribute($value)
	{
		$this->attributes['end_date'] = Carbon::parse($value);
	}
}
