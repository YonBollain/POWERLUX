<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MayusculaRule implements Rule
{
    public function passes($attribute, $value)
    {
        $words = explode(' ', $value);
        $firstWord = $words[0];

        return ucwords($firstWord) === $firstWord;
    }

    public function message()
    {
        return 'El :attribute debe empezar con letra mayúscula.';
    }
}
