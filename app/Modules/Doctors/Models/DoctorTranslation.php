<?php

namespace App\Modules\Doctors\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorTranslation extends Model
{
	protected $fillable = [
		'academic_degree', 'current_workplaces', 'previous_experience', 'specialization',
	];
}
