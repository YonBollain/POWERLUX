<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NoNumericRule;
use App\Rules\MayusculaRule;
use App\Rules\IBANFormatRule;
use App\Rules\PhoneFormatRule;
use App\Rules\DniCifNieFormatRule;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => ['required', 'max:64', 'min:2'],
            'lastname' => ['required', 'max:64', 'min:2'],
            'city' => ['required', 'max:64', 'min:2', new NoNumericRule(), new MayusculaRule()],
            'province' => ['required', 'max:64', 'min:2', new NoNumericRule(), new MayusculaRule()],
            'dni' => ['required', new DniCifNieFormatRule()],
            'address' => ['required', 'max:255', 'min:2', new MayusculaRule()],
            'irpf' => 'required|numeric',
            'iban' => ['required', new IBANFormatRule()],
            'cp' => 'required|size:5',
            'contact_name' => 'required|max:64|min:2',
            'contact_number' => ['required', new PhoneFormatRule()],
            'payment_method' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'objectives' => 'required|not_in:0',
            'role' => 'required|not_in:0',
            'password' => 'required'
        ];
    }
}
