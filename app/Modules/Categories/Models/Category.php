<?php

namespace App\Modules\Categories\Models;

use App\Modules\Doctors\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Category extends Model
{
		use Translatable;

    protected $fillable 					= [ 'status' , 'category_id' , 'image'];
		public $translationModel 			= 'App\Modules\Categories\Models\CategoryTranslation';
		public $translatedAttributes 	= [ 'title' , 'slug' , 'seo_keywords' , 'seo_description' ];

		public function parent()
    {
        return $this->belongsTo('App\Modules\Categories\Models\Category', 'category_id');
    }

    public function children()
    {
        return $this->hasMany('App\Modules\Categories\Models\Category', 'category_id');
    }


	public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'category_doctor');
    }
}
