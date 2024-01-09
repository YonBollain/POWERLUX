<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnexoController extends Controller
{

    public function index()
    {
        $anexos = Anexo::all();
        $categorias = Anexo::distinct('categoria')->pluck('categoria');
        return view('anexo.index',compact('categorias','anexos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $anexo = new Anexo();
        $request->validate([
          'categoria'=>'required|max:50|min:2',
          'subcategoria'=>'required|max:50|min:2',
          'nombre'=>'required|max:80|min:2',
          'documento'=>'required|mimes:png,jpg,pdf|file_ext'
        ]);
        $ruta = $this->guardarArchivo($request->file('documento'));
        $anexo->categoria = $request['categoria'];
        $anexo->subcategoria = $request['subcategoria'];
        $anexo->nombre = $request['nombre'];
        $anexo->documento = $ruta;
        $anexo->save();
        return redirect()->back()->with('success','Se ha añadido correctamente el anexo');
    }
    public function guardarArchivo($documento): string
    {
        $ruta = 'public/anexos';
        if (!Storage::exists($ruta)) {
            Storage::makeDirectory($ruta);
            Storage::setVisibility($ruta, 'public');
        }
        $nombre = Carbon::now()->format('Y-m-d_H-i-s').'.'.$documento->getClientOriginalExtension();
        $rutaArchivo = $ruta.'/'.$nombre;
        Storage::putFileAs($ruta, $documento, $nombre);
        return $rutaArchivo;
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCategoria(string $categoria)
    {
        return view('anexo.editCategoria',compact('categoria'));
    }
    public function updateCategoria(Request $request)
    {
        $categoriaAnterior = $request['categoriaVieja'];
        $nuevoValor = $request['categoriaNueva'];

        Anexo::where('categoria', $categoriaAnterior)
            ->update(['categoria' => $nuevoValor]);
        return redirect('/anexos')->with('success','Se ha cambiado de nombre la categoria.');
    }
    public function editsubCategoria(string $categoria,string $subcategoria)
    {

        return view('anexo.editsubCategoria',compact('categoria','subcategoria'));
    }
    public function updatesubCategoria(Request $request)
    {
        $categoriaAnterior = $request['categoriaVieja'];
        $subcategoriaAnterior = $request['subcategoriaVieja'];
        $nuevaCategoria = $request['categoriaNueva'];
        $nuevaSubcategoria = $request['subcategoriaNueva'];

        Anexo::where('categoria', $categoriaAnterior)
            ->where('subcategoria', $subcategoriaAnterior)
            ->update(['categoria' => $nuevaCategoria, 'subcategoria' => $nuevaSubcategoria]);
        return redirect('/anexos')->with('success','Se ha cambiado la subcategoria correctamente!');
    }
    public function edit($id)
    {
        $anexo = Anexo::find($id);
        return view('anexo.edit',compact('anexo'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $anexo = Anexo::find($id);
        $anexo->categoria = $request['categoriaNueva'];
        $anexo->subcategoria = $request['subcategoriaNueva'];
        $anexo->nombre = $request['nombre'];
        $anexo->update();
        return redirect('/anexos')->with('success','Se ha cambiado el anexo correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anexo = Anexo::find($id);
        Storage::delete($anexo->documento);
        Anexo::destroy($id);
        return redirect('/anexos')->with('success','Se ha borrado el anexo correctamente!');
    }
    public function destroySubCategoria(string $subcategoria)
    {
        $anexos = Anexo::where('subcategoria', $subcategoria)->get();
        foreach ($anexos as $anexo){
            Storage::delete($anexo->documento);
            Anexo::destroy($anexo->id);
        }
        return redirect('/anexos')->with('success','Se ha borrado la subcategoria correctamente!');
    }
    public function destroyCategoria(string $categoria)
    {
        $anexos = Anexo::where('categoria', $categoria)->get();
        foreach ($anexos as $anexo){
            Storage::delete($anexo->documento);
            Anexo::destroy($anexo->id);
        }
        return redirect('/anexos')->with('success','Se ha borrado la categoria correctamente!');
    }
    public function descargar(string $id){
        $anexo = Anexo::find($id);
        return response()->download(Storage::path($anexo->documento));
    }
}
