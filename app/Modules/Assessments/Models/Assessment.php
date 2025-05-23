<?php

namespace App\Modules\Assessments\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Assessment extends Model
{
	use Translatable;

	protected $fillable = ['doctor_id', 'status', 'image', 'price'];

	protected $with = ['questions'];
	
	public $translationModel = 'App\Modules\Assessments\Models\AssessmentTranslation';
	
	public $translatedAttributes 	= ['name', 'description'];

	public function questions()
	{
		return $this->hasMany('App\Modules\Questions\Models\Question', 'assessment_id');
	}

	public function result_ranges()
	{
		return $this->hasMany('App\Modules\Assessments\Models\ResultRange', 'assessment_id');
	}
}
