<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLiquidacionRequest;
use App\Models\Contrato;
use App\Models\Liquidacion;
use App\Models\User;
use App\Services\LiquidacionService;
use App\Services\UsuariosService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCPDF;
use Termwind\Components\Li;

/**
 * Class LiquidacionController
 * @package App\Http\Controllers
 */
class LiquidacionController extends Controller
{
    protected $usuariosService;
    protected $liquidacionesService;

    public function __construct(UsuariosService $usuariosService,LiquidacionService $liquidacionesService)
    {
        $this->usuariosService = $usuariosService;
        $this->liquidacionesService = $liquidacionesService;
    }
    public function index()
    {
        $liquidaciones = $this->liquidacionesService->getLiquidacionesPorRole();
        $usuarios = $this->usuariosService->getAllUsers();
        return view('liquidacion.index', compact('liquidaciones','usuarios'));
    }

    public function create()
    {
        $liquidacione = new Liquidacion();
        return view('liquidacion.create', compact('liquidacione'));
    }

    public function store(StoreLiquidacionRequest $request)
    {
        return $this->liquidacionesService->store($request->validated());
    }
    public function show($id)
    {
        $liquidacione = Liquidacion::find($id);

        return view('liquidacion.show', compact('liquidacione'));
    }

    public function edit($id)
    {
        $liquidacione =  $this->liquidacionesService->getLiquidacion($id);
        $contratos = $this->liquidacionesService->getContratosLiquidados($id);
        $contratosTel = $this->liquidacionesService->getContratosTelLiquidados($id);
        return view('liquidacion.edit', compact('liquidacione','contratos','contratosTel'));
    }
    public function update(Request $request, $id)
    {
        $liquidacione =  $this->liquidacionesService->getLiquidacion($id);
        $liquidacione->estado = $request['estado'];
        $liquidacione->update();
        return redirect()->back()->with('success','Se ha cambiado el estado de la liquidación correctamente');
    }

    public function updateNumeroFactura(Request $request, $id)
    {
        $liquidacion =  $this->liquidacionesService->getLiquidacion($id);
        $this->liquidacionesService->updateCampoLiquidacion($liquidacion,'numero_factura',$request['numero_factura']);

        return redirect('/liquidaciones')
            ->with('success', 'El número de factura se ha actualizado correctamente');
    }
    public function descargarLiquidacion($id)
    {
        $liquidacion = $this->liquidacionesService->getLiquidacion($id);

        if(Auth::user()->role != 'Administrador' ) {
            if ($liquidacion->numero_factura == null || $liquidacion->numero_factura == '') {
                return redirect()->back()->with('error', 'Pon algún número de factura a la liquidación');
            }
            if($liquidacion->user_id != Auth::user()->getAuthIdentifier()){
                return redirect()->back()->with('error', 'No intentes descargar facturas que no te pertenecen');
            }
        }
        $contratos = $this->liquidacionesService->getContratosLiquidados($id);
        $contratosTel = $this->liquidacionesService->getContratosTelLiquidados($id);
        $usuario = $liquidacion->user;

        $total_importes = $this->liquidacionesService->calcularBaseImponible($contratos,$contratosTel);
        $importeDefinitivo = number_format($this->liquidacionesService->calcularImporte($liquidacion, $contratos,$contratosTel),2);

        $data = ['liquidacion', 'contratos', 'usuario', 'total_importes', 'importeDefinitivo', 'contratosTel'];

        return view('liquidacion.pdf',compact($data));
    }

    public function destroy($id)
    {
        $this->liquidacionesService->borrarLiquidacion($id);
        return redirect()->route('liquidacion.index')
            ->with('success', 'Liquidación eliminada correctamente!');
    }
}
