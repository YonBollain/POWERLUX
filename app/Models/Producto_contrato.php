<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto_contrato extends Model
{
    use HasFactory;

    protected $table = 'contratos_productos';

    protected $fillable = ['contrato_id','producto_id','tipo','clase','numero','nombre_titular','dni',
        'comercializadora_actual','operador_donante','icc','linea_principal'];

    public function contratos()
    {
        return $this->hasOne('App\Models\ContratoTelefono', 'contratotel_id');
    }
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'producto_id');
    }
}
