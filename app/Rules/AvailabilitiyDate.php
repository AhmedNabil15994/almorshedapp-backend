<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AvailabilitiyDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($date)
    {
        //
        $this->date = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $todayDate = now();

       
        if($todayDate->format("Y-m-d") != $this->date) return true;
        $availability = \App\Modules\Availabilities\Models\Availability::find($value);
        if(!$availability) return false;
        if($availability->available_from == 0) return true;

        // $todayDate->setTimeFromTimeString($availability->available_from.":00:00");
        $todayDate->setHour($availability->available_from);

        $todayDate;
        $now = now()->setSeconds(0);

        if($todayDate->gt($now) &&  $now->diffInHours($todayDate) > config("app.allow_reservation_befor_hour")) return true;

        return false;



        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("api.reservations.choose_another_date_befor_2_h", ["hour"=>config("app.allow_reservation_befor_hour")]);
    }
}
