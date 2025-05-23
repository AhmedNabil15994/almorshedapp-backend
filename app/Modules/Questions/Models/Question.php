<?php

namespace App\Modules\Questions\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Question extends Model
{
	use Translatable;

	protected $fillable = ['assessment_id', 'status'];

	protected $with = ['answers'];
	
	public $translationModel = 'App\Modules\Questions\Models\QuestionTranslation';
	
	public $translatedAttributes 	= ['question'];

	public function answers()
	{
		return $this->hasMany('App\Modules\Answers\Models\Answer', 'question_id');
	}
}
