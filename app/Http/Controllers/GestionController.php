<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\ContratoTelefono;
use App\Models\Gestion;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user())
            return new RedirectResponse('/');

        $gestiones = Gestion::all();
        $arrayGestiones = [];
        foreach ($gestiones as $gestion){
            if($gestion->agente == auth()->user()->getAuthIdentifier()){
                $arrayGestiones[]= $gestion;
            }
        }
        if(auth()->user()->role == 'Administrador')
            $arrayGestiones =$gestiones;

        return view('gestion.index',compact('arrayGestiones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($contrato_id,$tipo_contrato)
    {
        $contrato = $contrato_id;
        if($tipo_contrato == 'suministros'){
            $nombre = Contrato::find($contrato_id);
        }else{
            $nombre = ContratoTelefono::find($contrato_id);
        }

        return view('gestion.create',compact('contrato','nombre','tipo_contrato'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contrato_id'=>'required',
            'tipo'=>'required|not_in:0',
            'nota'=>'required',
            'estado'=>'required|not_in:0'

        ]);
        DB::table('gestiones')->insert([
            'contrato_id'=>$request['contrato_id'],
            'tipo'=>$request['tipo'],
            'nota'=>$request['nota'],
            'estado'=>$request['estado'],
            'documentos'=>null,
            'agente'=>auth()->user()->getAuthIdentifier(),
            'tipo_contrato'=>$request['tipo_contrato']
        ]);
        $tipo_contrato = $request['tipo_contrato'];
        if ($tipo_contrato == 'telefonia'){
            $contrato = ContratoTelefono::find($request['contrato_id']);
        }else{
            $contrato = Contrato::find($request['contrato_id']);
        }

        if ($request->file('documentos')) {
            if (count($request->file('documentos')) > 5) {
                return redirect()->back()->withErrors(['documentos' => 'No se pueden subir más de 5 documentos'])->withInput();
            }
            $jsondocumentos = $this->saveJson($tipo_contrato,$contrato->id,$contrato->cliente->id, $request->file('documentos'));
            DB::table('gestiones')->where('id',Gestion::max('id'))->update(['documentos'=>$jsondocumentos]);
        }
        return redirect('/gestiones')->with('success','Solicitud de gestion enviada.');
    }

    function saveJson($tipo_contrato,$idContrato,$cliente_id,$documentos) {
        if($tipo_contrato == 'telefonia'){
            $tipo_contrato = 'Telefonico';
        }else{
            $tipo_contrato ='';
        }
        $nombreCarpeta = 'cliente_' . $cliente_id;
        $nombreCarpetaContrato = 'contrato'.$tipo_contrato.'_' . $idContrato;
        $nombreCarpetaGestiones = 'gestion_'. Gestion::max('id')+1;
        $rutaClientes = 'public/clientes';
        if (!Storage::exists($rutaClientes)) {
            Storage::makeDirectory($rutaClientes);
            Storage::setVisibility($rutaClientes, 'public');
        }
        $rutaCarpeta = $rutaClientes . '/' . $nombreCarpeta . '/'.$nombreCarpetaContrato.'/'.$nombreCarpetaGestiones;

        $data = [];
        foreach ($documentos as $file) {
            $rutaArchivo = $rutaCarpeta . '/' . $file->getClientOriginalName();
            if (Storage::exists($rutaArchivo)) {
                Storage::delete($rutaArchivo);
            }
            Storage::putFileAs($rutaCarpeta, $file, $file->getClientOriginalName());
            $data[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $rutaArchivo
            ];
        }
        $json = json_encode($data);
        return $json;
    }

    /**
     * Display the specified resource.
     */
    public function show(Gestion $gestion)
    {
        return view('gestion.show',compact('gestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estado = $request['estado'];
        $gestion = Gestion::find($id);
        $gestion->update([
            'estado'=>$estado
        ]);
        return redirect()->back()->with('success','Se ha cambiado el estado de la gestion');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gestion = Gestion::find($id);
        if ($gestion->documentos) {
            $archivos = json_decode($gestion->documentos, true);
            $rutas = array_column($archivos, 'path');
            Storage::delete($rutas);
        }
        Gestion::destroy($id);
        return redirect()->back()->with('success','Se ha borrado correctamente la gestión!');
    }
}
