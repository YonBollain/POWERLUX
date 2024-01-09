<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\ContratoTelefono;
use App\Models\Gestion;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ArchivoController extends Controller
{
    public function descargarArchivoCliente($id,$idContrato,$archivo)
    {
        $rutaArchivo = '/public/clientes/cliente_'.$id.'/contrato_'.$idContrato.'/'.$archivo;
        $rutaCompleta  = storage_path("/app".$rutaArchivo);

        if (!Storage::exists($rutaArchivo)) {
            abort(404);
        }

        $nombreArchivo = 'Cliente_'.$id.'_Contrato_'.$idContrato.'_Documento';

        $tipoArchivo = Storage::mimeType($rutaArchivo);

        return response()->download($rutaCompleta, $nombreArchivo, ['Content-Type' => $tipoArchivo]);
    }
    public function descargarArchivoClienteTelefonico($id,$idContrato,$archivo)
    {
        $rutaArchivo = '/public/clientes/cliente_'.$id.'/contratoTelefonico_'.$idContrato.'/'.$archivo;
        $rutaCompleta  = storage_path("/app".$rutaArchivo);

        if (!Storage::exists($rutaArchivo)) {
            abort(404);
        }

        $nombreArchivo = 'Cliente_'.$id.'_ContratoTelefonico_'.$idContrato.'_Documento';

        $tipoArchivo = Storage::mimeType($rutaArchivo);

        return response()->download($rutaCompleta, $nombreArchivo, ['Content-Type' => $tipoArchivo]);
    }
    public function descargarArchivosJson($contrato_id,$tipo){
        if($tipo == 'suministros'){
            $contrato = Contrato::find($contrato_id);
        }else{
            $contrato = ContratoTelefono::find($contrato_id);
        }

        $json = $contrato->documentos;
        if($json != null) {
            $data = json_decode($json, true);
            $zipName = 'documentos_adicionales_contrato_' . $contrato_id . '.zip';

            $zip = new ZipArchive();
            $zip->open($zipName, ZipArchive::CREATE);

            foreach ($data as $file) {
                $rutaArchivo = $file['path'];
                $nombreArchivo = $file['name'];
                $zip->addFile(storage_path('app/' . $rutaArchivo), $nombreArchivo);
            }
            $zip->close();
            return response()->download($zipName)->deleteFileAfterSend();
        }
        return redirect()->back()->with('error','No hay archivos adicionales!');
    }
    public function descargarArchivosJsonGestion($gestionid){
        $gestion = Gestion::find($gestionid);
        $json = $gestion->documentos;
        if($json != null) {
            $data = json_decode($json, true);
            $zipName = 'documentos_gestion_' . $gestionid . '.zip';

            $zip = new ZipArchive();
            $zip->open($zipName, ZipArchive::CREATE);

            foreach ($data as $file) {
                $rutaArchivo = $file['path'];
                $nombreArchivo = $file['name'];
                $zip->addFile(storage_path('app/' . $rutaArchivo), $nombreArchivo);
            }
            $zip->close();
            return response()->download($zipName)->deleteFileAfterSend();
        }
        return redirect()->back()->with('error','No hay archivos!');
    }
    public function borrarArchivos($idcontrato,$tipo,$tipo_contrato){
        if($tipo_contrato == 'suministro'){
            $contrato = Contrato::find($idcontrato);
        }else{
            $contrato = ContratoTelefono::find($idcontrato);
        }


        if (is_string($contrato->$tipo) && is_array(json_decode($contrato->$tipo, true)) && (json_last_error() == JSON_ERROR_NONE)) {
            $archivos = json_decode($contrato->$tipo, true);
            $rutas = array_column($archivos, 'path');
            Storage::delete($rutas);
            $contrato->$tipo = null;
            $contrato->update();
        } else {
            Storage::delete($contrato->$tipo);
            $contrato->$tipo = null;
            $contrato->update();
        }
        return redirect()->back()->with('success','Se ha eliminado correctamente el archivo!');
    }
}


