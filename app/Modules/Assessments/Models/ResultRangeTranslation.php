<?php

namespace App\Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Model;

class ResultRangeTranslation extends Model
{
	protected $fillable = ['rank', 'message'];
}
