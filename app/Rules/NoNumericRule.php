<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoNumericRule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z\s]+$/', $value);
    }

    public function message()
    {
        return 'El campo :attribute solo puede contener letras.';
    }
}
