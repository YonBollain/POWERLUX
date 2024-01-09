<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $tipo
 * @property $nombre
 * @property $comision_vendedor
 * @property $comision_colaborador
 * @property $comision_captador
 * @property $activo
 * @property $tipo_iva
 * @property $precio
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo','nombre','tipo_iva','comercializadora_id','activo','precio'];

    public function comercializadora()
    {
        return $this->hasOne('App\Models\Comercializadora', 'id', 'comercializadora_id');
    }

    public function contratos()
    {
        return $this->belongsToMany('App\Models\ContratoTelefono', 'contratos_productos');
    }

}
