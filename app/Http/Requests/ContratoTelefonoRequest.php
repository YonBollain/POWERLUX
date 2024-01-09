<?php

namespace App\Http\Requests;

use App\Rules\IBANFormatRule;
use App\Rules\MayusculaRule;
use App\Rules\PhoneFormatRule;
use Illuminate\Foundation\Http\FormRequest;

class ContratoTelefonoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cliente_id' => 'required',
            'fecha_incio' => 'required',
            'fecha_fin' => 'required',
            'comercializadora_id' => 'required',
            'direccion' => ['required', new MayusculaRule()],
            'cp' => 'required|size:5',
            'estado' => 'required',
            'poblacion' => ['required', new MayusculaRule()],
            'provincia' => ['required', new MayusculaRule()],
            'iban' => ['required', new IBANFormatRule()],
            'user_id' => 'required',
            'email'=>'email',
            'comentarios'=>'nullable',
            'movil'=>new PhoneFormatRule(),
            'documento_dni' => 'nullable|mimes:png,jpg,pdf|file_ext',
            'documento_factura' => 'nullable|mimes:png,jpg,pdf|file_ext',
            'documento_certificado' => 'nullable|mimes:png,jpg,pdf|file_ext',
        ];
    }
}
