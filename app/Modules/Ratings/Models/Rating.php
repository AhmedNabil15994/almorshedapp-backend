<?php

namespace App\Modules\Ratings\Models;

use App\Modules\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	protected $guarded = [];

    public function rateable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
