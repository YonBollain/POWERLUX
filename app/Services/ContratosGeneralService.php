<?php

namespace App\Services;


use App\Models\Cliente;
use App\Models\Comercializadora;
use App\Models\Contrato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ContratosGeneralService
{
    public function filtrarContratosPorRol($contratos,$usuario)
    {
        $contratos_agente = [];
        if ($usuario->role == 'Administrador') {
            $contratos_agente = $contratos;
        }
        else {
            foreach ($contratos as $contrato) {
                if ($contrato->user_id == $usuario->getAuthIdentifier()) {
                    $contratos_agente[] = $contrato;
                }
            }
        }
        return $contratos_agente;
    }
    public function ordenarContratos($contratos)
    {
        $contratos = $contratos->sortByDesc(function ($contrato) {
            return $contrato->estado === 'Activo' ? 1 : 0;
        });
        return $contratos;
    }

    public function getComercializadoras(): Collection
    {
        return Comercializadora::pluck('nombre', 'id');
    }
    public function getContrato($id)
    {
        return Contrato::find($id);
    }
    public function isLiquidated($contrato)
    {
        if($contrato->liquidacion > 0 && Auth::user()->role != 'Administrador' ){
            return false;
        }
        if($contrato->estado == 'Activo' && Auth::user()->role != 'Administrador' ){
            return false;
        }
        return true;
    }


    public function getDefaultFechaActual(): Carbon
    {
        return Carbon::now();
    }

    public function getDefaultFechaFin(): Carbon
    {
        return Carbon::now()->addMonths(12);
    }

    public function getAllAgentes(): Collection
    {
        return User::pluck('name', 'id');
    }
    public function getAllClientes()
    {
        return Cliente::all();
    }
}
