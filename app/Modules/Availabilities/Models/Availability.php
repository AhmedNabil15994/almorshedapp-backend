<?php

namespace App\Modules\Availabilities\Models;

use App\Modules\Days\Models\Day;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
	protected $fillable = ['doctor_id', 'day_id', 'available_from', 'available_to', 'status'];

	protected $with = ['day'];

	public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
