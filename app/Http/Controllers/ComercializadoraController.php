<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Comercializadora;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercializadoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');


        $comercializadoras = Comercializadora::all();
        return view('comercializadora.index')->with('comercializadoras',$comercializadoras);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');


        return view('comercializadora.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');


        $request->validate([
            'nombre'=>['required','max:100']
        ]);

        if(DB::table('comercializadoras')->insert([
            'nombre'=>$request['nombre']
        ])){
            return redirect('/comercializadoras')->with('success','Se ha creado correctamente la comercializadora');
        }else{
            return redirect('/comercializadoras')->with('error','No se ha podido crear la comercializadora');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');

        $comercializadora = Comercializadora::find($id);
        return view('comercializadora.edit')->with('comercializadora',$comercializadora);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id):mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');

        $request->validate([
            'nombre'=>['required','max:40']
        ]);

        $comercializadora = Comercializadora::find($id);
        if($comercializadora->update([
            'nombre'=>$request['nombre']
                ]
        )){
            return redirect('/comercializadoras')->with('success','La comercializadora se ha actualizado');
        }else{
            return redirect('/comercializadoras')->with('error','La comercializadora no se ha actualizado');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');

        //TODO: Validaciones si tiene clientes o contratos asociados antes de eliminar

        if(Comercializadora::destroy($id)){
            return redirect('/comercializadoras')->with('success','La comercializadora se ha eliminado con exito');
        }
        return redirect('/comercializadoras')->with('error','La comercializadora no se ha eliminado');
    }
}
