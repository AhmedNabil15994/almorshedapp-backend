<?php

namespace App\Modules\AvailabilityExceptions\Models;

use Illuminate\Database\Eloquent\Model;

class AvailabilityException extends Model
{
	protected $fillable = ['doctor_id', 'off_from', 'off_to', 'off_date'];
}
