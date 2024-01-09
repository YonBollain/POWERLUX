<?php

namespace App\Services;



use App\Http\Requests\StoreContratosSuministrosRequest;
use App\Models\Comision;
use App\Models\Contrato;
use App\Models\ContratoTelefono;
use App\Models\Producto;
use App\Rules\CupsValidation;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ContratosSuministrosService
{
    public function getContratos($request): Collection
    {
        $contratos = Contrato::orderByRaw("CASE WHEN estado = 'Activo' THEN 1 ELSE 0 END, estado ASC")->get();
        $contratosAgente = [];
        $descripcion = "";

        $userRole = Auth::user()->role;
        $userId = Auth::user()->getAuthIdentifier();

        foreach ($contratos as $contrato) {
            if ($this->isContratoVisible($contrato, $userRole, $userId, $request)) {
                $contratosAgente[] = $contrato;
            }
        }

        if ($request->query('documentos')) {
            $descripcion = 'sin documentos';
            $contratosAgente = $this->filterContratosSinDocumentos($contratosAgente);
        }

        return collect($contratosAgente);
    }

    private function isContratoVisible($contrato, $userRole, $userId, $request): bool
    {
        if ($userRole === 'Administrador') {
            return $this->isContratoVisibleForAdmin($contrato, $request);
        } else {
            return $this->isContratoVisibleForUser($contrato, $userId, $request);
        }
    }

    private function isContratoVisibleForAdmin($contrato, $request): bool
    {
        if ($request->query('estado')) {
            if ($request->query('estado') == $contrato->estado) {
                $descripcion = $request->query('estado');
                return true;
            }
        } else {
            return true;
        }

        return false;
    }

    private function isContratoVisibleForUser($contrato, $userId, $request): bool
    {
        if ($contrato->user_id == $userId) {
            return $this->isContratoVisibleForAdmin($contrato, $request);
        }

        return false;
    }

    private function filterContratosSinDocumentos($contratosAgente): Collection
    {
        return collect($contratosAgente)->filter(function ($contratoAgente) {
            return (
                $contratoAgente->documento_dni === null || $contratoAgente->documento_dni === "" ||
                $contratoAgente->documento_factura === null || $contratoAgente->documento_factura === "" ||
                $contratoAgente->documento_escritura === null || $contratoAgente->documento_escritura === "" ||
                $contratoAgente->documento_cif === null || $contratoAgente->documento_cif === "" ||
                $contratoAgente->documento_cie === null || $contratoAgente->documento_cie === ""
            );
        });
    }

    public function getComision($request)
    {
        return Comision::where('producto_id', $request['producto_id'])
            ->where('user_id', $request['user_id'])
            ->get('comision');
    }

    public function createContrato($request,$comision)
    {
        Contrato::create($request);
        $id = Contrato::latest()->first()->id;
        $contrato = Contrato::find($id);
        $contrato->comision = $comision;
        $contrato->save();
        return $contrato;
    }

    public function actualizarContrato(Contrato $contrato,$request, $valorComision)
    {
        $contrato->comision = $valorComision;

        $contrato->update($request);
    }

    public function guardarArchivo(Contrato $contrato,$archivo,$tipo)
    {
        $ruta = $this->almacenarArchivo($contrato->id, $contrato->cliente_id, $archivo);
        $contrato->$tipo = $ruta;
        $contrato->save();
    }
    public function almacenarArchivo($idContrato,$idcliente, $documento)
    {
        $nombreCarpeta = 'cliente_' . $idcliente;
        $nombreCarpetaContrato = 'contrato_' . $idContrato;
        $archivo = $documento;
        $fecha = Carbon::now();
        $numeroAleatorio = random_int(20000, 10000000);
        $nombreArchivo = $numeroAleatorio.'_'.$fecha->format('Ymd_His') .'.'. $documento->getClientOriginalExtension();
        $rutaArchivo = '';
        $rutaClientes = 'public/clientes';
        $rutaCarpeta = $rutaClientes . '/' . $nombreCarpeta . '/'.$nombreCarpetaContrato;

        $this->crearCarpeta($rutaClientes);
        $this->crearCarpeta($rutaCarpeta);

        $rutaArchivo = $rutaCarpeta . '/' . $nombreArchivo;
        Storage::putFileAs($rutaCarpeta, $archivo, $nombreArchivo);

        return $rutaArchivo;

    }

    public function borrarArchivo($id,$tipo)
    {
        $contrato = Contrato::find($id);
        if($contrato->$tipo != null){
            if(Storage::exists($contrato->$tipo))
                Storage::delete($contrato->$tipo);
        }
    }
    private function crearCarpeta($ruta)
    {
        if (!Storage::exists($ruta)) {
            Storage::makeDirectory($ruta);
            Storage::setVisibility($ruta, 'public');
        }
    }
    public function jsonGuardarArchivos($id,$archivos)
    {
        $contrato = Contrato::find($id);
        $data= [];
        foreach ($archivos as $archivo){
            $ruta = $this->almacenarArchivo($id,$contrato->cliente_id,$archivo);
            $data[] = ['path' => $ruta,'name'=>$archivo->getClientOriginalName()];
        }
        $rutasEnJson = json_encode($data);
        $contrato->documentos = $rutasEnJson;
        $contrato->save();
    }


}
