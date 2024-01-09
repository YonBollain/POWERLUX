<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoTelefonoRequest;
use App\Models\ContratoTelefono;
use App\Services\ContratosGeneralService;
use App\Services\ContratosSuministrosService;
use App\Services\LiquidacionService;
use App\Services\ContratoTelefonoService;
use Illuminate\Support\Facades\Auth;

class ContratoTelefonoController extends Controller
{
    public static array $estados_contrato = ['1' => 'Por revisar', '2' => 'Revisado', '3' => 'Pte. firma', '4' => 'Pte. verificación',
        '5' => 'Tramitado', '6' => 'Activo', '7' => 'Incidencia', '8' => 'Rechazado', '9' => 'A renovar', '10' => 'Inactivo'
    ];
    protected $contratoService;
    protected $contratosGeneralService;

    public function __construct(ContratoTelefonoService $contratoService, ContratosGeneralService $contratosGeneralService)
    {
        $this->contratoService = $contratoService;
        $this->contratosGeneralService = $contratosGeneralService;
    }

    public function index()
    {
        $contratos = ContratoTelefono::all();
        $contratosOrdenados = $this->contratosGeneralService->ordenarContratos($contratos);
        $contratos_agente = $this->contratosGeneralService->filtrarContratosPorRol($contratos,Auth::user());

        return view('contratotelefono.index',compact('contratos_agente')) ;
    }

    public function create()
    {
        $contrato = new ContratoTelefono();
        $clientes = $this->contratosGeneralService->getAllClientes();
        $comercializadoras = $this->contratosGeneralService->getComercializadoras();
        $fecha_actual = $this->contratosGeneralService->getDefaultFechaActual();
        $fecha_fin = $this->contratosGeneralService->getDefaultFechaFin();
        $agentes = $this->contratosGeneralService->getAllAgentes();
        $estados_contrato = $this->contratoService->getEstadosContrato();
        $mode = 'create';
        $productos = [];
        $lineasCreados = [];

        return view('contratotelefono.create', compact('contrato', 'clientes',
            'comercializadoras', 'fecha_actual', 'fecha_fin', 'agentes', 'mode','estados_contrato', 'productos', 'lineasCreados'));
    }

    public function store(ContratoTelefonoRequest $request)
    {
        $contrato = $this->contratoService->crearContrato($request->validated(), $request->productosCreados, $request->lineasCreados);
        $tipos = ['documento_dni','documento_factura','documento_cerficado'];
        foreach ($tipos as $tipo){
            if($request->file($tipo)) {
                $this->contratoService->guardarArchivo($contrato->id, $request->file($tipo), $tipo);
            }
        }
        if($request->file('documentos')) {
            $this->contratoService->jsonGuardarArchivos($contrato->id, $request->file('documentos'));
        }
        return redirect('/contratos/telefonia')->with('success', 'Se ha creado correctamente el contrato');
    }

    public function show(string $id)
    {
        $contrato = ContratoTelefono::find($id);
        $productos = $this->contratoService->getProductos($id);
        $lineas = $this->contratoService->getLineas($id);

        return view('contratotelefono.show', compact('contrato','productos','lineas'));
    }

    public function edit(string $id)
    {
        $contrato = ContratoTelefono::find($id);
        if($contrato->estado == 'Por revisar' || Auth::user()->role == 'Administrador') {
            if($this->contratosGeneralService->isLiquidated($contrato)) {
            $clientes = $this->contratosGeneralService->getAllClientes();
            $comercializadoras = $this->contratosGeneralService->getComercializadoras();
            $estados_contrato = $this->contratoService->getEstadosContrato();
            $agentes = $this->contratosGeneralService->getAllAgentes();
            $fecha_actual = $contrato->fecha_incio;
            $fecha_fin = $contrato->fecha_fin;
            $mode = 'edit';
            $productos = $this->contratoService->getProductos($id);
            $lineas = $this->contratoService->getLineas($id);

            $productosCreados = $productos->pluck('producto_id')->toArray();
            $lineasCreados = $lineas->toArray();

            return view('contratotelefono.edit', compact('contrato', 'clientes', 'comercializadoras',
                'estados_contrato', 'agentes', 'mode', 'productos', 'fecha_fin', 'fecha_actual', 'productosCreados', 'lineasCreados'));
            }else{
                return redirect()->back()->with('error','El contrato que intentas modificar ya está liquidado');
            }
        }else{
            return redirect()->back()->with('error','El contrato que intentas modificar ya no lo puedes modificar');
        }

    }

    public function update(ContratoTelefonoRequest $request, string $id)
    {
        $contrato = $this->contratoService->actualizarContrato($request->validated(),$request->productosCreados, $request->lineasCreados,$id);
        $tipos = ['documento_dni','documento_factura','documento_cerficado'];
        foreach ($tipos as $tipo){
            if($request->file($tipo)) {
                $this->contratoService->borrarArchivo($contrato->id, $tipo);
                $this->contratoService->guardarArchivo($contrato->id, $request->file($tipo), $tipo);
            }
        }
        if($request->file('documentos')) {
            $this->contratoService->jsonGuardarArchivos($contrato->id, $request->file('documentos'));
        }
        return redirect('/contratos/telefonia')->with('success', 'Se ha actualizado correctamente el contrato');
    }

    public function destroy(string $id)
    {
        return $this->contratoService->eliminarContrato($id);
    }
    public function destroyProduct(string $id)
    {
        $this->contratoService->eliminarProducto($id);
        return redirect()->back()->with('success','Se ha borrado el producto correctamente');
    }

}
