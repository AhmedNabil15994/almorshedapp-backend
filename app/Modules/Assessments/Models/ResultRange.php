<?php

namespace App\Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class ResultRange extends Model
{
	use Translatable;

	protected $fillable = ['assessment_id', 'score_from', 'score_to'];
	
	public $translationModel = 'App\Modules\Assessments\Models\ResultRangeTranslation';
	
	public $translatedAttributes 	= ['rank', 'message'];

}
