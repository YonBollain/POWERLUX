<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'nombre',
        'dni_cif',
        'representante',
        'direccion',
        'poblacion',
        'cp',
        'provincia',
        'movil',
        'email',
        'telefono1',
        'telefono2',
        'notas',
        'iban',
        'contacto',
        'tel_contacto',
        'actividad'

    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
