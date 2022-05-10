<?php

namespace App\Rules;

use App\Models\Notification;
use Illuminate\Contracts\Validation\Rule;

class NotificationExist implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return !Notification::where('data',request('data'))->where('type',request('type'))->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Notification exist';
    }
}
