<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Rules\DniCifNieFormatRule;
use App\Rules\IBANFormatRule;
use App\Rules\MayusculaRule;
use App\Rules\PhoneFormatRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->user())
            return new RedirectResponse('/');

        $id = Auth::user()->id;
        $clientes = '';
        if (Auth::user()->role == 'Administrador'){
            $clientes = Cliente::all();
        } elseif(Auth::user()->role == 'Agente'){
            $id = Auth::user()->id;
            $clientes = Cliente::where('user_id', $id)
                ->orWhereHas('user', function ($query) use ($id) {
                    $query->where('agente_id', $id);
                })
                ->get();
        }else{
            $clientes = Cliente::where('user_id', $id)->get();
        }

        return view('clientes.index',compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():mixed
    {
        if(!auth()->user())
            return new RedirectResponse('/');

        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):mixed
    {
        $request->validate($this->getValidationRules(0));
        $cliente = new Cliente($request->all());
        $cliente->user_id = Auth::user()->id;
        $cliente->save();

        return redirect('/clientes')->with('success','Se ha creado correctamente el cliente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):mixed
    {
        $cliente = Cliente::find($id);
        return view('clientes.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id):mixed
    {
        $cliente = Cliente::find($id);
        return view('clientes.edit',compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $request->validate($this->getValidationRules($cliente->id));
        $cliente->update($request->all());
        return redirect('/clientes')->with('success','Se ha modificado correctamente el cliente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(count(Contrato::find($id,'cliente_id')->get()) > 0){
            return redirect('/clientes')->with('error','El cliente no se puede borrar, tiene contratos pendientes !!');
        }else{
            if(Cliente::destroy($id))
                return redirect('/clientes')->with('success','El cliente se ha eliminado con exito');
            else
                return redirect('/clientes')->with('success','El cliente no se ha podido eliminar');
        }
    }

    private function getValidationRules($id):array{
        $rules = [
            'tipo' => 'required|not_in:0',
            'dni_cif' => ['required', new DniCifNieFormatRule,Rule::unique('clientes')->ignore($id)],
            'nombre' => ['required', 'max:120', 'min:2', new MayusculaRule()],
            'representante' => ['max:255', 'nullable', new MayusculaRule()],
            'direccion' => ['required', 'max:255', 'min:2', new MayusculaRule()],
            'cp' => 'required|size:5',
            'poblacion' => ['required', 'max:60', new MayusculaRule()],
            'provincia' => ['required', 'max:60', new MayusculaRule()],
            'movil' => ['required', new PhoneFormatRule, 'max:15', 'min:6'],
            'email' => 'required|max:120|regex:/(.+)@(.+)\.(.+)/i',
            'telefono1' => ['required', new PhoneFormatRule],
            'telefono2' => ['nullable', new PhoneFormatRule],
            'iban' => ['required', new IBANFormatRule],
            'notas' => ['max:255', 'nullable', new MayusculaRule()],
            'contacto' => ['required', 'max:120', new MayusculaRule()],
            'tel_contacto' => ['required', new PhoneFormatRule],
            'actividad' => ['max:255', 'nullable', new MayusculaRule()]
        ];

        return $rules;
    }
}
