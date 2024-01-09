<?php

namespace App\Services;



use App\Models\Comision;
use App\Models\Contrato;
use App\Models\ContratoTelefono;
use App\Models\Liquidacion;
use App\Models\Producto;
use App\Models\Producto_contrato;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LiquidacionService
{
    public function getLiquidacionesPorRole()
    {
        $liquidacions = Liquidacion::all();
        $liquidaciones= [];
        if (Auth::user()->role != 'Administrador') {
            foreach ($liquidacions as $liquidacion) {
                if($liquidacion->user_id == Auth::user()->getAuthIdentifier())
                    $liquidaciones[] = $liquidacion;
            }
        }else{
            $liquidaciones = $liquidacions;
        }
        return $liquidaciones;
    }
    public function getLiquidacion($id)
    {
        $liquidacion = Liquidacion::find($id);

        return $liquidacion;
    }
    public function store($datos)
    {
        $fechaInicio = $datos['fecha_incio'];
        $fechaFinal = $datos['fecha_fin'];
        $agentesId = $datos['usuarios'];

        $usuarios = $this->getUsuarios($agentesId);
        if (count($usuarios) !== count($agentesId)) {
            return redirect()->back()->with('error', 'No se ha econtrado algún usuario');
        }

        foreach ($usuarios as $usuario) {
            $contratos = $this->getContratosPendientes($usuario->id, $fechaInicio, $fechaFinal);
            $contratosTel = $this->getContratosTelPendientes($usuario->id, $fechaInicio, $fechaFinal);
            if ($contratos->isEmpty() && $contratosTel->isEmpty()) {
                return redirect()->back()->with('error', 'Alguno de los agentes no tiene contratos que liquidar en estas fechas o de ese agente');
            }
            $liquidacion = $this->createLiquidacion($usuario);
            $this->updateContratos($contratos,$contratosTel, $liquidacion);
            $this->calcularImporte($liquidacion, $contratos,$contratosTel);

        }
        return redirect()->back()->with('success', 'La liquidación se ha completado');
    }
    public function getContratosLiquidados($id)
    {
        return Contrato::where('liquidacion',$id)->get();
    }
    public function getContratosTelLiquidados($id)
    {
        return ContratoTelefono::where('liquidacion',$id)->get();
    }
    public function updateCampoLiquidacion($liquidacion,$campo,$data)
    {
        if($data != '' || $data !=null) {
            $liquidacion->$campo = $data;
            $liquidacion->save();
        }
    }
    private function getUsuarios($agentesId)
    {
        return User::find($agentesId);
    }

    private function getContratosPendientes($userId, $fechaInicio, $fechaFinal)
    {
        return Contrato::where('user_id', $userId)
            ->where('estado', 'Activo')
            ->where(function ($query) {
                $query->whereNull('liquidacion')
                    ->orWhere('liquidacion', 0);
            })
            ->whereBetween('fecha_incio', [$fechaInicio, $fechaFinal])
            ->get();
    }
    private function getContratosTelPendientes($userId, $fechaInicio, $fechaFinal)
    {
        return ContratoTelefono::where('user_id', $userId)
            ->where('estado', 'Activo')
            ->where(function ($query) {
                $query->whereNull('liquidacion')
                    ->orWhere('liquidacion', 0);
            })
            ->whereBetween('fecha_incio', [$fechaInicio, $fechaFinal])
            ->get();
    }

    private function createLiquidacion($usuario)
    {
        $liquidacion = new Liquidacion();
        $liquidacion->numero_factura = '';
        $liquidacion->fecha = Carbon::now();
        $liquidacion->estado = 'Pendiente';
        $liquidacion->user_id = $usuario->id;
        $liquidacion->save();
        return $liquidacion;
    }

    private function updateContratos($contratos,$contratosTel,$liquidacion)
    {
        foreach ($contratos as $contrato) {
            $contrato->liquidacion = $liquidacion->id;
            $contrato->save();
        }
        foreach ($contratosTel as $contrato) {
            $contrato->liquidacion = $liquidacion->id;
            $contrato->save();
        }
    }

    public function calcularImporte($liquidacion, $contratos,$contratosTel)
    {
        $importeTotal = 0;
        $cuotaIVAContratos = 0;
        $cuotaIVAContratosTel = 0;
        $cuotaIRPFContratos = 0;
        $cuotaIRPFTel = 0;
        $importeContratos= 0;
        $importeContratosTel = 0;

        foreach ($contratos as $contrato) {
            $importe = $contrato->precio_producto * $contrato->comision / 100;
            $importeContratos += $importe;
            $cuotaIVAContratos += $importe * $contrato->iva / 100;
            $cuotaIRPFContratos += $importe * $contrato->user->irpf / 100;
        }

        foreach ($contratosTel as $contratoTel){
            $productosContrato = Producto_contrato::where('contrato_id',$contratoTel->id)->get();
            foreach ($productosContrato as $productoContrato){
                $producto= Producto::find($productoContrato->producto_id);
                $comision = Comision::where('producto_id',$productoContrato->producto_id)
                    ->where('user_id',$contratoTel->user->id)
                    ->first();
                if($comision==null){
                    $comision = 0;
                }else{
                    $comision = $comision->comision;
                }
                $importe= $producto->precio * $comision / 100; ;
                $importeContratosTel += $importe;
                $cuotaIVAContratosTel += $importe * $producto->tipo_iva / 100;
                $cuotaIRPFTel += $importe * $contratoTel->user->irpf / 100;
            }
        }

        $importeContratosTel = $importeContratosTel + $cuotaIVAContratosTel -  $cuotaIRPFTel;
        $importeContratos = $importeContratos + $cuotaIVAContratos -  $cuotaIRPFContratos;
        $total = $importeContratos+$importeContratosTel;
        $liquidacion->importe = $total;
        $liquidacion->save();
        return $total;
    }
    public function calcularBaseImponible( $contratos,$contratosTel)
    {
        $importeContratos = 0;
        $importeContratosTel = 0;
        foreach ($contratos as $contrato) {
            $importe = $contrato->precio_producto * $contrato->comision / 100;
            $importeContratos += $importe;
        }

        foreach ($contratosTel as $contratoTel){
            $productosContrato = Producto_contrato::where('contrato_id',$contratoTel->id)->get();
            foreach ($productosContrato as $productoContrato){
                $producto= Producto::find($productoContrato->producto_id);
                $comision = Comision::where('producto_id',$productoContrato->producto_id)
                    ->where('user_id',$contratoTel->user->id)
                    ->first();
                if($comision==null){
                    $comision = 0;
                }else{
                    $comision = $comision->comision;
                }
                $importe= $producto->precio * $comision / 100; ;
                $importeContratosTel += $importe;
            }
        }
        $total = $importeContratos + $importeContratosTel;
        return $total;
    }
    public function borrarLiquidacion($id)
    {
        $this->liberarContratosLiquidados($this->getContratosLiquidados($id));
        $this->liberarContratosLiquidados($this->getContratosTelLiquidados($id));
        Liquidacion::destroy($id);
    }
    private function liberarContratosLiquidados($contratos){
        foreach ($contratos as $contrato){
            $contrato->liquidacion = 0;
            $contrato->save();
        }
    }
}
