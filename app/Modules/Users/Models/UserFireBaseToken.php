<?php

namespace App\Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class UserFireBaseToken extends Model
{
    protected $table = 'user_firebase_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'device_token', 'platform'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
