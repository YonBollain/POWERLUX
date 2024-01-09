<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;
    protected $table = 'gestiones';

    protected $fillable = [
        'contrato_id',
        'tipo',
        'nota',
        'estado',
        'documentos'
    ];

    public function contrato()
    {
        return $this->hasOne('App\Models\Contrato', 'id', 'contrato_id');
    }
    public function contratoTelefonico()
    {
        return $this->hasOne('App\Models\ContratoTelefono', 'id', 'contrato_id');
    }
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'agente');
    }
}
