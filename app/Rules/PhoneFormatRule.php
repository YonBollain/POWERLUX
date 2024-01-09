<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneFormatRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(?:\+?(?:[0-9] ?){6,14}[0-9]|[0-9] ?(?:[0-9] ?){5,13}[0-9])$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute no tiene el formato correcto de teléfono.';
    }
}
