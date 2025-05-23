<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
		protected $fillable = [
				'user_id','username','email','phone','city','country','state','zip','address','address_2','additional'
		];

		public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
