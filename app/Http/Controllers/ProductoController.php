<?php

namespace App\Http\Controllers;

use App\Models\Comercializadora;
use App\Models\Contrato;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $comercializadoras = Comercializadora::all();
        return view('producto.index',compact('productos','comercializadoras'));

    }

    public function create()
    {
        $comercializadoras = Comercializadora::all();
        return view('producto.create', compact('comercializadoras'));
    }

    public function store(Request $request):mixed
    {
        $producto = new Producto();
        $request->validate([
            'nombre'=>'required',
            'tipo'=>'required|not_in:0',
            'activo'=>'required|not_in:0',
            'iva'=>'required',
            'comercializadora'=>'required|not_in:0',
            'precio'=>'required'
        ]);

        DB::table('productos')->insert([
                'nombre'=>$request['nombre'],
                'tipo'=>$request['tipo'],
                'activo'=>$request['activo'],
                'tipo_iva'=>$request['iva'],
                'comercializadora_id'=>$request['comercializadora'],
                'precio'=>$request['precio'],
                'linea'=>$request['linea'],

            ]
        );
        return redirect('/productos')->with('success','El producto se ha creado con éxito');

    }

    public function show($id)
    {
        $producto = Producto::find($id);
        return view('producto.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::find($id);
        $comercializadoras = Comercializadora::all();
        return view('producto.edit', compact('producto','comercializadoras'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'=>'required',
            'tipo'=>'required|not_in:0',
            'activo'=>'required|not_in:0',
            'tipo_iva'=>'required',
            'comercializadora_id'=>'required|not_in:0',
            'precio'=>'required'
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
            ->with('success', 'El producto se ha actualizado con éxito.');
    }

    public function destroy($id)
    {
        $contratos = Contrato::where('producto_id',$id)->get();
        if (count($contratos)>0){
            return redirect()->route('productos.index')
                ->with('error', 'No puedes eliminar el producto que esta en un contrato!');
        }else{
            $producto = Producto::find($id)->delete();
            return redirect()->route('productos.index')
                ->with('success', 'El producto se ha borrado con éxito.');
        }
    }
}
