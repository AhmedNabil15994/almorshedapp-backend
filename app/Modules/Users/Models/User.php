<?php

namespace App\Modules\Users\Models;

use App\Modules\Ratings\Traits\Rateable;
use App\Modules\Doctors\Models\Doctor;
use App\Modules\Reservations\Models\Reservation;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Dimsav\Translatable\Translatable;

class User extends Authenticatable implements \Tocaan\FcmFirebase\Contracts\IFcmFirebaseDevice
{
    use EntrustUserTrait, Notifiable, HasApiTokens, Rateable, Translatable;
    use \Tocaan\FcmFirebase\Traits\FcmDeviceTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'calling_code', 'mobile', 'comet_chat_uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $translationModel = 'App\Modules\Users\Models\UserTranslation';

    public $translatedAttributes = [
        'name',
    ];

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function userAddress()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function assessmentOrders()
    {
        return $this->hasMany(AssessmentOrder::class);
    }

    public function firebase_tokens()
    {
        return $this->hasMany(UserFireBaseToken::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeNotActive($query)
    {
        return $query->where('status', 0);
    }

    public function scopeIsUser($query)
    {
        return $query->has('doctor', '=', 0);
    }

    public function scopeIsDoctor($query)
    {
        return $query->has('doctor', '>', 0);
    }

}
