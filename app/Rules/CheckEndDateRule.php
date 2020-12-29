<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class CheckEndDateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $start_date;
    public function __construct($start_date)
    {
        $this->start_date = $start_date;
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
        $start_date =  Carbon::createFromFormat('Y-m-d', $this->start_date);
        $end_date =  Carbon::createFromFormat('Y-m-d', $value);
        if(0 < $start_date->diffInMonths($end_date) && $start_date->diffInMonths($end_date) <= 2){
            return true;
        }
        return false;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Hãy nhập thời gian kết thúc năm học theo đúng quy định.';
    }
}
