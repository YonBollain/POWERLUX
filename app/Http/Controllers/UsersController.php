<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Contrato;
use App\Models\User;
use App\Services\UsuariosService;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    protected $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }
    public function index():mixed
    {
        $users = $this->usuariosService->getAllUsers();
        return view('users.index')->with('users',$users);
    }

    public function create():mixed
    {
        $usuarios = $this->usuariosService->getAllUsers();
        return view('users.create',compact('usuarios'));
    }
    public function show(string $id)
    {
        $user = $this->usuariosService->getUser($id);
        return view('users.show')->with('usuario',$user);
    }
    public function profile()
    {
        $usuario = Auth::user();
        return view('users.profile',compact('usuario'));
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $response = $this->usuariosService->updatePassword($request->validated());

        return redirect()->back()->with($response);
    }
    public function updateUserProfile(UpdateUserProfileRequest $request, string $id)
    {
         $this->usuariosService->updateUserProfile($request->validated(), $id);

        return redirect()->back()->with('success','Los datos se han actualizado correctamente.');
    }
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('users.edit')->with('usuario',$user);
    }

    public function update(UpdateUserRequest $request,string $id):mixed
    {
        $agente = $request['agente_id'];
        $this->usuariosService->updateUser($request->validated(),$agente,$id);
        return redirect('/comerciales')->with('success','El comercial se ha editado con exito');

    }
    public function store(StoreUserRequest $request)
    {
        $agente = $request['agente_id'];
        $this->usuariosService->createUser($request->validated(),$agente);
        return redirect('/comerciales')->with('success', 'El comercial se ha creado con éxito');
    }

    public function destroy(string $id)
    {
       return $this->usuariosService->destroy($id);
    }
}
