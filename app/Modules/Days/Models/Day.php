<?php

namespace App\Modules\Days\Models;

use App\Modules\Availabilities\Models\Availability;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Day extends Model
{
	use Translatable;

	protected $guarderd = [];
	
	public $translationModel = 'App\Modules\Days\Models\DayTranslation';
	
	public $translatedAttributes 	= ['day'];

	public function availability()
    {
        return $this->hasMany(Availability::class, 'day_id');
    }

}
