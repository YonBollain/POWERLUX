<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IBANFormatRule implements Rule
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
        return preg_match('/^([A-Z]{2}\s*\d{2}\s*(?=(\d{4}\s*){3}|(\d{2}\s*){5})((\d{4}\s*){3}|(\d{2}\s*){5})[\d\s]{1,30})$/
', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute no tiene el formato correcto de IBAN.';
    }
}
