<?php

namespace App\Http\Requests;

use App\Rules\CupsValidation;
use App\Rules\IBANFormatRule;
use App\Rules\MayusculaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContratosSuministrosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => 'required',
            'fecha_incio' => 'required',
            'fecha_fin' => 'required',
            'tipo_contrato' => 'required',
            'comercializadora_id' => 'required',
            'producto_id' => 'required',
            'cups' => ['required', new CupsValidation(),Rule::unique('contratos')->where(function ($query) {
                $query->where('estado', '<>', 'inactivo');
            }),],
            'direccion' => ['required', new MayusculaRule()],
            'cp' => 'required|size:5',
            'estado' => 'required',
            'precio_producto' => 'required',
            'iva' => 'required',
            'poblacion' => ['required', new MayusculaRule()],
            'provincia' => ['required', new MayusculaRule()],
            'titular_banco' => ['required', new MayusculaRule()],
            'iban' => ['required', new IBANFormatRule()],
            'user_id' => 'required',
            'comision'=>'nullable',
            'email'=>'nullable',
            'movil'=>'nullable',
            'comentarios'=>'nullable',
            'documento_dni' => 'nullable|mimes:png,jpg,pdf|file_ext',
            'documento_cif' => 'nullable|mimes:png,jpg,pdf|file_ext',
            'documento_factura' => 'nullable|mimes:png,jpg,pdf|file_ext',
            'documento_escritura' => 'nullable|mimes:png,jpg,pdf|file_ext',
            'documento_cie' => 'nullable|mimes:png,jpg,pdf|file_ext',
        ];
    }
}
