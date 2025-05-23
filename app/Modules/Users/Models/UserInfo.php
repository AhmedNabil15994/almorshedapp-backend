<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
		protected $fillable = [
				'code', 'phone', 'country','user_id'
		];

		public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
