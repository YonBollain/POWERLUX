<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\ContratoTelefono;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Contratos Telefonicos
        $contratosTelefonoCompletos = ContratoTelefono::orderByRaw("CASE WHEN estado = 'Activo' THEN 1 ELSE 0 END, estado asc")->get();
        $contratos_telefono= [];

        if(Auth::user()->role == 'Administrador'){
            $contratos_telefono = $contratosTelefonoCompletos;
        }
        else{
            foreach ($contratosTelefonoCompletos as $contrato){
                if($contrato->user_id == Auth::user()->id ){
                    $contratos_telefono[] = $contrato;
                }
            }
        }

        //Todos los contratos
        $contratos = Contrato::orderByRaw("CASE WHEN estado = 'Activo' THEN 1 ELSE 0 END, estado asc")->get();
        $contratos_agente= [];


        if(Auth::user()->role == 'Administrador'){
            $contratos_agente = $contratos;
        }
        else{
            foreach ($contratos as $contrato){
                if($contrato->user_id == Auth::user()->getAuthIdentifier() ){
                    $contratos_agente[] = $contrato;
                }
            }
        }
        //Contratos activos
        $activo = 'Activo';

        $contratosQuefaltan = collect($contratos_agente)->filter(function ($contrato_agente){
            return (
                $contrato_agente->documento_dni === null || $contrato_agente->documento_dni === "" ||
                $contrato_agente->documento_factura === null || $contrato_agente->documento_factura === "" ||
                $contrato_agente->documento_escritura === null || $contrato_agente->documento_escritura === "" ||
                $contrato_agente->documento_cif === null || $contrato_agente->documento_cif === "" ||
                $contrato_agente->documento_cie === null || $contrato_agente->documento_cie === ""
            );
        });

        $contratosActivos= collect($contratos_agente)->filter(function ($contrato_agente) use ($activo) {
            return $contrato_agente->estado === $activo;
        });
        //Contratos pendientes "Se pueden modificar a gusto los que no quieres que formen parte"
        $estadosExcluidos = ['Activo', 'Inactivo','A renovar'];
        $contratosPendientes  = collect($contratos_agente)->whereNotIn('estado', $estadosExcluidos);

        //Contratos renovación
        $fechaAUnMes = Carbon::now()->addMonth();
        $apuntoDeRenovar = DB::table('contratos')
            ->whereDate('fecha_fin', '<=', $fechaAUnMes)
            ->get();
        $contratosARenovar = collect($contratos_agente)->where('estado', 'A renovar');

        $totalContratosRenovar = count($apuntoDeRenovar) + count($contratosARenovar);
        $contratosUnicos = collect($apuntoDeRenovar)->merge($contratosARenovar)->unique(function ($item) {
            return $item->id;
        });
        $totalARenovar = $contratosUnicos->count();

        return view('dashboard.dashboard',compact('contratos_agente','contratosActivos',
            'contratosPendientes', 'apuntoDeRenovar','contratosARenovar','totalARenovar','contratosQuefaltan','contratos_telefono'));
    }
}
