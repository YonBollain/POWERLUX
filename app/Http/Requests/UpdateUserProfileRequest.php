<?php

namespace App\Http\Requests;

use App\Rules\IBANFormatRule;
use App\Rules\MayusculaRule;
use App\Rules\NoNumericRule;
use App\Rules\PhoneFormatRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $userId = $this->user()->id;
        return [
            'city' => ['required', 'max:64', 'min:2', new NoNumericRule(), new MayusculaRule()],
            'province' => ['required', 'max:64', 'min:2', new NoNumericRule(), new MayusculaRule()],
            'address' => ['required', 'max:255', 'min:2', new MayusculaRule()],
            'iban' => ['required', new IBANFormatRule()],
            'cp' => 'required|size:5',
            'contact_name' => 'required|max:64|min:2',
            'contact_number' => ['required', new PhoneFormatRule()],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId )],
        ];
    }
}
