<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratoTelefono extends Model
{
    use HasFactory;

    protected $table = 'contratostel';

    protected $fillable = [
        'cliente_id',
        'fecha_incio',
        'fecha_fin',
        'comercializadora_id',
        'comision',
        'direccion',
        'cp',
        'estado',
        'poblacion',
        'provincia',
        'iban',
        'movil',
        'email',
        'fijo_numero',
        'fijo_nombre',
        'fijo_dni',
        'fijo_comercializadora_actual',
        'comentarios',
        'documentos',
        'documento_dni',
        'documento_factura',
        'documento_cerficado',
        'precio_final',
        'factura_online',
        'liquidacion',
        'user_id',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
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
    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto', 'contratos_productos');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

}
