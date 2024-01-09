<?php

namespace App\Models;

use App\Models\Cliente;
use App\Models\Comercializadora;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contrato
 *
 * @property $id
 * @property $cliente_id
 * @property $fecha_incio
 * @property $fecha_fin
 * @property $tipo_contrato
 * @property $comercializadora_id
 * @property $producto_id
 * @property $cups
 * @property $direccion
 * @property $cp
 * @property $estado
 * @property $poblacion
 * @property $provincia
 * @property $titular_banco
 * @property $iban
 * @property $movil
 * @property $email
 * @property $comentarios
 * @property $documentos
 * @property $user_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Comercializadora $comercializadora
 * @property Producto $producto
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contrato extends Model
{

    static $rules = [
		'cliente_id' => 'required',
		'fecha_incio' => 'required',
		'fecha_fin' => 'required',
		'tipo_contrato' => 'required',
		'comercializadora_id' => 'required',
		'producto_id' => 'required',
		'cups' => 'required',
		'direccion' => 'required',
		'cp' => 'required',
		'estado' => 'required',
		'poblacion' => 'required',
		'provincia' => 'required',
		'titular_banco' => 'required',
		'iban' => 'required',
		'comentarios' => 'required',
		'documentos' => 'required',
		'user_id' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cliente_id',
        'fecha_incio',
        'fecha_fin',
        'tipo_contrato',
        'comercializadora_id',
        'producto_id',
        'cups',
        'direccion',
        'cp',
        'estado',
        'poblacion',
        'provincia',
        'titular_banco',
        'iban',
        'movil',
        'email',
        'comentarios',
        'documentos',
        'user_id',
        'factura_online',
        'precio_producto',
        'iva',
        'comision',
        'documento_dni',
        'documento_cif',
        'documento_factura',
        'documento_escritura',
        'documento_cie',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    public function obtenerClienteid(){
        return $this->cliente->id;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function comercializadora()
    {
        return $this->hasOne('App\Models\Comercializadora', 'id', 'comercializadora_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }


}
