<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
class DniCifNieFormatRule implements Rule
{
    public function passes($attribute, $value)
    {
        $regexDni = '/^\d{8}[a-zA-Z]$/';
        $regexNie = '/^[XYZ]\d{7}[a-zA-Z]$/';
        $regexCif = '/^[ABCDEFGHJKLMNPQS]\d{7}[0-9A-J]$/';

        if (preg_match($regexDni, $value) || preg_match($regexNie, $value) || preg_match($regexCif, $value)) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'El campo DNI/NIE/CIF no es válido.';
    }
}
