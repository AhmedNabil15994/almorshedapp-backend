<?php

namespace App\Modules\Answers\Models;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Answer extends Model
{
	use Translatable;

	protected $fillable = ['question_id', 'status', 'value'];
	
	public $translationModel = 'App\Modules\Answers\Models\AnswerTranslation';
	
	public $translatedAttributes 	= ['answer'];

}
