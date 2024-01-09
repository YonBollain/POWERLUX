<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatosController extends Controller
{
    public function clienteSearch(Request $request)
    {
        $term = $request->input('search');

        $clientes = Cliente::where(function($query) use ($term) {
            $query->where('dni_cif', 'LIKE', '%' . $term . '%');
        })
            ->select('id', 'dni_cif')
            ->get();

        $data = [];
        foreach ($clientes as $cliente) {
            $data[] = [
                'id' => $cliente->id,
                'text' => $cliente->dni_cif,
            ];
        }

        return response()->json($data);
    }
    public function contratoCliente(Request $request){

        $clienteId = $request->input('cliente_id');

        // Obtén los contratos del cliente usando el ID del cliente recibido como parámetro
        $contratos = Contrato::where('cliente_id', $clienteId)->get();

        // Devuelve los contratos en formato JSON
        return response()->json($contratos);
    }

    public function productosComercializadora(Request $request){
        $comercializadoraId = $request->input('comercializadora_id');

        $productos = Producto::where('comercializadora_id', $comercializadoraId)
            ->get();

        return response()->json($productos);
    }

    public function datosCliente($dni){
        $cliente = Cliente::find($dni);

        return response()->json($cliente);
    }
}
