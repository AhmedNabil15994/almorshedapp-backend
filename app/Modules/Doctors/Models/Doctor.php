<?php

namespace App\Modules\Doctors\Models;

use App\Modules\Availabilities\Models\Availability;
use App\Modules\AvailabilityExceptions\Models\AvailabilityException;
use App\Modules\Categories\Models\Category;
use App\Modules\Languages\Models\Language;
use App\Modules\Services\Models\Service;
use App\Modules\Users\Models\User;
use App\Modules\Reservations\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Doctor extends Model
{
    use Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iban', 'account_name', 'academic_degree', 'current_workplaces', 'previous_experience', 'specialization', 'bank_name', 'card_name', 'language_id'
    ];

    protected $with = ['user', 'vailability', 'availabilityException'];

    public $translationModel = 'App\Modules\Doctors\Models\DoctorTranslation';

    public $translatedAttributes = [
        'academic_degree', 'current_workplaces', 'previous_experience', 'specialization',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vailability()
    {
        return $this->hasMany(Availability::class, 'doctor_id');
    }

    public function availabilityException()
    {
        return $this->hasMany(AvailabilityException::class, 'doctor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('price', 'status');
    }

    public function activeServices()
    {
        return $this->services()->where('doctor_service.status', 1)->get();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
