<?php

namespace App\Modules\Ratings\Traits;

use App\Modules\Ratings\Models\Rating;
use Illuminate\Database\Eloquent\Model;

trait Rateable
{
    protected static function bootRateable()
    {
        static::deleting(function ($model) {
            $model->ratings->each->delete();
        });
    }

    /**
     * This model has many ratings.
     *
     * @return Rating
     */
    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function sumRating()
    {
        return $this->ratings()->sum('rating');
    }

    public function userAverageRating()
    {
        return $this->ratings()->where('user_id', auth()->id())->avg('rating');
    }

    public function userSumRating()
    {
        return $this->ratings()->where('user_id', auth()->id())->sum('rating');
    }

    public function ratingPercent($max = 5)
    {
        $quantity = $this->ratings()->count();
        $total = $this->sumRating();

        return ($quantity * $max) > 0 ? $total / (($quantity * $max) / 100) : 0;
    }

    public function getAverageRatingAttribute()
    {
        return $this->averageRating();
    }

    public function getSumRatingAttribute()
    {
        return $this->sumRating();
    }

    public function getUserAverageRatingAttribute()
    {
        return $this->userAverageRating();
    }

    public function getUserSumRatingAttribute()
    {
        return $this->userSumRating();
    }
}