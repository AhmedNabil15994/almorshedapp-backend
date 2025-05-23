<?php

namespace App\Modules\Reservations\Models;

use App\Modules\Availabilities\Models\Availability;
use App\Modules\Doctors\Models\Doctor;
use App\Modules\OrderStatuses\Models\OrderStatus;
use App\Modules\Services\Models\Service;
use App\Modules\Users\Models\User;
use App\Modules\Users\Models\UserAddress;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'doctor_id', 'user_id', 'service_id', 'date', 'start_time', 'end_time', 'price', 'order_status_id', 'is_paid', 'availability_id',
        'transaction_id', 'extra_attributes', 'reason',
    ];

    protected $appends = [
        'payment_type'
    ];

    protected $casts = [
        'is_paid' => 'boolean',
        'extra_attributes' => 'array',
    ];

    protected $with = [
        'service', 'doctor', 'user', 'orderStatus',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'start_datetime',
        'end_datetime',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sort', function (Builder $builder) {
            $now = now()->format('Y-m-d H:i:s');

            $builder
                ->selectRaw("
                    reservations.*,
                    (CASE
                        WHEN
                            ? > end_datetime THEN 2
                        WHEN
                            ? < start_datetime THEN 1
                        ELSE 0
                    END) as sort", [$now, $now]);
        });
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->with('userAddress');
    }

    /**
     * Scope a query to include only paid items.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePaid($query)
    {
        return $query->whereHas('OrderStatus', function ($query) {
            return $query->where('code', 'paid');
        });
    }

    /**
     * Scope a query to sort reservations by datetime.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query)
    {
        // $now = now()->format('Y-m-d H:i:s');

        return $query
            // ->selectRaw("
            // 	reservations.*,
            // 	(CASE
            // 		WHEN
            // 			? > end_datetime THEN 2
            // 		WHEN
            // 			? < start_datetime THEN 1
            // 		ELSE 0
            // 	END) as sort", [$now, $now])
            ->orderByRaw('
				sort,
				CASE WHEN sort = 2 THEN start_datetime END DESC,
				CASE WHEN sort < 2 THEN start_datetime END ASC
			');
    }

    public function getPaymentTypeAttribute()
    {
        return __('dashboard.reservations.datatable.cash_visa');
    }
}
