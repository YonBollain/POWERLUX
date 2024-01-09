<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Liquidacion
 *
 * @property $id
 * @property $numero_factura
 * @property $fecha
 * @property $estado
 * @property $importe
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Liquidacion extends Model
{
    protected $table = 'liquidaciones';
    static $rules = [
		'fecha' => 'required',
		'estado' => 'required',
		'importe' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['numero_factura','fecha','estado','importe'];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
