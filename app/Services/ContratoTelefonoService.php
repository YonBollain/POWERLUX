<?php

namespace App\Services;

use App\Http\Controllers\ContratoTelefonoController;
use App\Models\ContratoTelefono;
use App\Models\Producto;
use App\Models\Producto_contrato;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ContratoTelefonoService
{
    public function crearContrato(array $data, $productosCreados, $lineasCreados)
    {
        $contrato = ContratoTelefono::create($data);

        $this->insertarProductos($contrato->id, $productosCreados);
        $this->insertarLineas($contrato->id, $lineasCreados);
        $this->actualizarPrecioTotal($contrato->id);
        return $contrato;
    }
    public function actualizarPrecioTotal($id): void
    {
        $contrato = ContratoTelefono::find($id);
        $productosContratos = Producto_contrato::where('contrato_id',$id)->get('producto_id');
        $precioTotal = 0 ;
        foreach ($productosContratos as $item){
            $producto = Producto::where('id',$item->producto_id)->get();
            $precioTotal += $producto->first()->precio;
        }
        $contrato->precio_final = $precioTotal;
        $contrato->update();
    }

    public function actualizarContrato($data,$productosCreados, $lineasCreados,$id)
    {
        $contrato = ContratoTelefono::find($id);
        $contrato->fill($data);
        $contrato->update();
        $this->insertarProductos($id, $productosCreados);
        $this->insertarLineas($id, $lineasCreados);

        return $contrato;
    }
    protected function insertarProductos($contratoId, $productosCreados): void
    {
       $productosCreados = json_decode($productosCreados);
        if($productosCreados) {
            foreach ($productosCreados as $productoId) {
                $product = new Producto_contrato();
                $product->producto_id = $productoId;
                $product->contrato_id = $contratoId;
                $product->save();
            }
        }
    }

    protected function insertarLineas($contratoId, $lineasCreados): void
    {
        $lineasCreados = json_decode($lineasCreados);
        if ($lineasCreados) {
            foreach ($lineasCreados as $linea) {
                $lineaid = $linea->id ?? null;
                if ($lineaid == null && $lineaid == '') {
                    $product = new Producto_contrato();
                    $product->producto_id = $linea->productoValue;
                    $product->contrato_id = $contratoId;
                    $product->tipo = $linea->tipo;
                    $product->clase = $linea->clase;
                    $product->numero = $linea->numero;
                    $product->nombre_titular = $linea->nombre_titular;
                    $product->dni = $linea->dni;
                    $product->operador_donante = $linea->operador_donante;
                    $product->icc = $linea->icc;
                    $product->linea_principal = $linea->principal;
                    $product->save();
                }
            }
        }
    }
    public function eliminarProductos($id): void
    {
        $productos = Producto_contrato::where('contrato_id',$id)->get();
        if($productos)
            foreach ($productos as $producto){
                Producto_contrato::destroy($producto->id);
            }
    }
    public function eliminarProducto($id)
    {
        Producto_contrato::destroy($id);

    }
    public function eliminarContrato($id)
    {
        $contrato = ContratoTelefono::find($id);
        if($contrato->liquidacion >0){
            return redirect()->back()
                ->with('error', 'El contrato ya está liquidado, no puedes eliminarlo.');
        }else{
            $this->eliminarProductos($id);
            $this->eliminarArchivos($contrato);
            ContratoTelefono::destroy($id);
            return redirect()->back()
                ->with('success','¡Se ha eliminado el contrato de forma correcta!');
        }
    }
    public function borrarArchivo($id,$tipo)
    {
       $contrato = ContratoTelefono::find($id);
        if($contrato->$tipo != null) {
            if (Storage::exists($contrato->$tipo))
                Storage::delete($contrato->$tipo);
        }
    }
    public function getLineas($id): Collection
    {
        return Producto_contrato::whereNotNull('tipo')->where('contrato_id', $id)->get();
    }
    public function getProductos($id): Collection
    {
        return  Producto_contrato::whereNull('tipo')->where('contrato_id', $id)->get();
    }
    public function getEstadosContrato(): array
    {
    return ContratoTelefonoController::$estados_contrato;
    }
    public function guardarArchivo($id,$archivo,$tipo)
    {
        $contrato = ContratoTelefono::find($id);
        $ruta = $this->almacenarArchivo($id,$contrato->cliente_id,$archivo);
        $contrato->$tipo = $ruta;
        $contrato->save();
    }

    public function jsonGuardarArchivos($id,$archivos)
    {
        $contrato = ContratoTelefono::find($id);
        $data= [];
        foreach ($archivos as $archivo){
            $ruta = $this->almacenarArchivo($id,$contrato->cliente_id,$archivo);
            $data[] = ['path' => $ruta,'name'=>$archivo->getClientOriginalName()];
        }
        $rutasEnJson = json_encode($data);
        $contrato->documentos = $rutasEnJson;
        $contrato->save();
    }
    private function almacenarArchivo($id,$cliente_id,$documento)
    {
        $nombreCarpeta = 'cliente_' . $cliente_id;
        $nombreCarpetaContrato = 'contratoTelefonico_' . $id;
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
    private function crearCarpeta($ruta)
    {
        if (!Storage::exists($ruta)) {
            Storage::makeDirectory($ruta);
            Storage::setVisibility($ruta, 'public');
        }
    }

    private function eliminarArchivos($contrato)
    {
        $carpeta = 'public/clientes/cliente_'.$contrato->cliente_id.'/contratoTelefonico_'.$contrato->id;
        Storage::deleteDirectory($carpeta);
    }

}
