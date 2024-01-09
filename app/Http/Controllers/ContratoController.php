<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContratosSuministrosRequest;
use App\Http\Requests\UpdateContratosSuministrosRequest;
use App\Models\Contrato;
use App\Models\Gestion;
use App\Rules\CupsValidation;
use App\Services\ContratosGeneralService;
use App\Services\ContratosSuministrosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;



/**
 * Class ContratoController
 * @package App\Http\Controllers
 */
class ContratoController extends Controller
{
    public static array $tipos_contrato = [
        '1' => 'Luz',
        '2' => 'Gas',
    ];
    public static array $estados_contrato = ['1' => 'Por revisar', '2' => 'Revisado', '3' => 'Pte. firma', '4' => 'Pte. verificación',
        '5' => 'Tramitado', '6' => 'Activo', '7' => 'Incidencia', '8' => 'Rechazado', '9' => 'A renovar', '10' => 'Inactivo'
    ];
    protected $contratosGeneralService;

    public function __construct(ContratosSuministrosService $contratoService, ContratosGeneralService $contratosGeneralService)
    {
        $this->contratoService = $contratoService;
        $this->contratosGeneralService = $contratosGeneralService;
    }
    public function index(Request $request)
    {
        $contratos_agente = $this->contratoService->getContratos($request);
        $descripcion = $descripcion = $request->query('estado')??'';
        return view('contrato.index', compact('contratos_agente','descripcion'));
    }

    public function create()
    {
        $contrato = new Contrato();
        $clientes = $this->contratosGeneralService->getAllClientes();
        $comercializadoras = $this->contratosGeneralService->getComercializadoras();
        $tipos_contrato = ContratoController::$tipos_contrato;
        $estados_contrato = ContratoController::$estados_contrato;
        $fecha_actual = $this->contratosGeneralService->getDefaultFechaActual();
        $fecha_fin = $this->contratosGeneralService->getDefaultFechaFin();
        $agentes = $this->contratosGeneralService->getAllAgentes();
        $mode= 'create';

        return view('contrato.create', compact('contrato', 'clientes',
            'comercializadoras', 'tipos_contrato', 'estados_contrato', 'agentes', 'fecha_actual', 'fecha_fin','mode'));
    }

    public function store(StoreContratosSuministrosRequest $request)
    {
        $comision = $this->contratoService->getComision($request);
        $valorComision = $comision->isEmpty() ? 0 : $comision[0]->comision;

        $contrato = $this->contratoService->createContrato($request->validated(),$valorComision);
        $tipos = ['documento_dni','documento_cif','documento_escritura','documento_factura','documento_cie'];
        foreach ($tipos as $tipo){
            if($request->file($tipo)) {
                $this->contratoService->guardarArchivo($contrato, $request->file($tipo), $tipo);
            }
        }
        if($request->file('documentos')) {
            $this->contratoService->jsonGuardarArchivos($contrato->id, $request->file('documentos'));
        }

        return redirect()->route('contratos.index')
            ->with('success', 'El contrato se ha creado correctamente');
    }

    public function show($id)
    {
        $contrato = Contrato::find($id);
        return view('contrato.show', compact('contrato'));
    }

    public function edit($id)
    {
        $contrato = $this->contratosGeneralService->getContrato($id);
        if($contrato->estado == 'Por revisar' || Auth::user()->role == 'Administrador'){
            if($this->contratosGeneralService->isLiquidated($contrato)) {
                $clientes = $this->contratosGeneralService->getAllClientes();
                $comercializadoras = $this->contratosGeneralService->getComercializadoras();
                $tipos_contrato = ContratoController::$tipos_contrato;
                $estados_contrato = ContratoController::$estados_contrato;
                $fecha_actual = $contrato->fecha_incio;
                $fecha_fin = $contrato->fecha_fin;
                $agentes = $this->contratosGeneralService->getAllAgentes();
                $mode = 'edit';

                return view('contrato.edit', compact('contrato', 'clientes',
                    'comercializadoras', 'tipos_contrato', 'estados_contrato', 'fecha_actual', 'agentes', 'fecha_fin', 'mode'));
            }else{
                return redirect()->back()->with('error','El contrato que intentas modificar ya está liquidado');
            }
        }else{
            return redirect()->back()->with('error','El contrato que intentas modificar ya no lo puedes modificar');
        }
    }

    public function update(UpdateContratosSuministrosRequest $request, string $id)
    {
        $contrato = $this->contratosGeneralService->getContrato($id);
        $request->validate([
            'cups' => ['required', new CupsValidation(),  Rule::unique('contratos')->ignore($id)->where(function ($query) {
                $query->where('estado', '<>', 'inactivo');
            }),]
        ]);
        $this->contratoService->actualizarContrato($contrato,$request->validated(),$request['comision']);
        $tipos = ['documento_dni','documento_cif','documento_escritura','documento_factura','documento_cie'];
        foreach ($tipos as $tipo){
            if($request->file($tipo)) {
                $this->contratoService->borrarArchivo($contrato->id, $tipo);
                $this->contratoService->guardarArchivo($contrato, $request->file($tipo), $tipo);
            }
        }
        if($request->file('documentos')) {
            $this->contratoService->jsonGuardarArchivos($contrato->id, $request->file('documentos'));
        }
        return redirect()->route('contratos.index')
            ->with('success', 'El contrato se ha modificado correctamente');
    }

    public function destroy($id)
    {
        $contrato = Contrato::find($id);
        $gestion = Gestion::find(['contrato_id'=>$id]);
        if (Gestion::where('contrato_id', $id)->exists()) {
            return redirect()->route('contratos.index')
                ->with('error', 'El contrato tiene una gestión pendiente');
        }
        if($contrato->liquidacion >0){
            return redirect()->route('contratos.index')
                ->with('error', 'El contrato ya está liquidado, no puedes eliminarlo.');
        }
        $carpeta = 'public/clientes/cliente_'.$contrato->cliente_id.'/contrato_'.$contrato->id;
        Storage::deleteDirectory($carpeta);
        Contrato::destroy($id);
        return redirect()->route('contratos.index')
            ->with('success', 'El contrato se ha eliminado correctamente');
    }
}
