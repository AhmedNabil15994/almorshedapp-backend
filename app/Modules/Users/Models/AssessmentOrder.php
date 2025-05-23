<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentOrder extends Model
{
	protected $fillable = [
		'assessment_id', 'user_id', 'status', 'price', 'score'
	];
}
