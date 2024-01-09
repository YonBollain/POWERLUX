<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CupsValidation implements Rule
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
        // Validate length
        $len = strlen($value);
        if (($len != 20 && $len != 22) || !preg_match('/^[a-zA-Z0-9]+$/', $value)) {
            return false;
        }

        // Validate first character (electricity only)
        if ($len == 20 && substr($value, 0, 1) != 'E') {
            return false;
        }

        // Validate last 2 characters (gas only)
        if ($len == 22 && !ctype_digit(substr($value, -2))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute no es un CUPS válido.';
    }
}
