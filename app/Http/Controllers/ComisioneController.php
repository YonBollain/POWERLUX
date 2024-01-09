<?php

namespace App\Http\Controllers;

use App\Comisione;
use App\Models\Comercializadora;
use App\Models\Comision;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class ComisioneController
 * @package App\Http\Controllers
 */
class ComisioneController extends Controller
{
    private $tipos_producto = [
        '1' => 'Luz',
        '2' => 'Gas',
        '3' => 'Telefonia'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idagente = auth()->user()->getAuthIdentifier();
        $comisiones = [];
        $comisionesReales= Comision::all();
        if(auth()->user()->role == 'Administrador'){
            $comisiones = $comisionesReales;
        }else{
            foreach ($comisionesReales as $comisionReal)
                if($comisionReal->user_id == $idagente)
                    $comisiones[] = $comisionReal;
        }
        return view('comisione.index', compact('comisiones',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comision = new Comision();
        $users = User::all();
        $tipos_producto = $this->tipos_producto;
        $comercializadoras = Comercializadora::pluck('nombre', 'id');
        return view('comisione.create', compact('comision','users','tipos_producto','comercializadoras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Comision::$rules);
        $comisione = Comision::create([
            'producto_id'=>$request['producto_id'],
            'user_id'=>$request['user_id'],
            'comision'=>$request['comision']
        ]);

        return redirect()->route('comisiones.index')
            ->with('success', 'Comisión creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comisione = Comision::find($id);

        return view('comisione.show', compact('comisione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comision = Comision::find($id);
        $users = User::all();
        $tipos_producto = $this->tipos_producto;
        $comercializadoras = Comercializadora::pluck('nombre', 'id');
        return view('comisione.edit', compact('comision','tipos_producto','comercializadoras','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comision $comisione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comision = Comision::find($id);
        request()->validate(Comision::$rules);

        $comision->update([
            'producto_id'=>$request['producto_id'],
            'user_id'=>$request['user_id'],
            'comision'=>$request['comision']
        ]);

        return redirect()->route('comisiones.index')
            ->with('success', 'Comisión actualizada correctamente!');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comisione = Comision::find($id)->delete();

        return redirect()->route('comisiones.index')
            ->with('success', 'Comisión borrada correctamente!');
    }
}
