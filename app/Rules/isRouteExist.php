<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class isRouteExist implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return app('router')->has($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute does not exist';
    }
}
