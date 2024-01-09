<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuariosService
{
    public function getAllUsers()
    {
        $users = User::all();
        return $users;
    }
    public function getUser($id)
    {
        $user = User::find($id);
        return $user;
    }
    public function updatePassword(array $data)
    {
        $user = auth()->user();

        if (!Hash::check($data['old_password'], $user->password)) {
            return ['error' => 'La contraseña anterior no coincide.'];
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return ['success' => 'Se ha actualizado la contraseña correctamente.'];
    }

    public function updateUserProfile($requestData,$id)
    {
        $user = User::find($id);
        $user->update($requestData);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public function updateUser($validatedData,$agente,$id)
    {
        $user = User::find($id);
        $user->name = $validatedData['nombre'];
        $user->lastname = $validatedData['lastname'];
        $user->city = $validatedData['city'];
        $user->province = $validatedData['province'];
        $user->dni = $validatedData['dni'];
        $user->address = $validatedData['address'];
        $user->irpf = $validatedData['irpf'];
        $user->iban = $validatedData['iban'];
        $user->cp = $validatedData['cp'];
        $user->contact_name =$validatedData['contact_name'];
        $user->contact_number = $validatedData['contact_number'];
        $user->objectives = $validatedData['objectives'];
        $user->payment_method = $validatedData['payment_method'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->agente_id = $agente;
        $user->save();
    }

    public function createUser($validatedData,$agente)
    {
        $user = new User();
        $user->name = $validatedData['nombre'];
        $user->lastname = $validatedData['lastname'];
        $user->city = $validatedData['city'];
        $user->province = $validatedData['province'];
        $user->dni = $validatedData['dni'];
        $user->address = $validatedData['address'];
        $user->irpf = $validatedData['irpf'];
        $user->iban = $validatedData['iban'];
        $user->cp = $validatedData['cp'];
        $user->contact_name =$validatedData['contact_name'];
        $user->contact_number = $validatedData['contact_number'];
        $user->objectives = $validatedData['objectives'];
        $user->payment_method = $validatedData['payment_method'];
        $user->email = $validatedData['email'];
        $user->password = bcrypt($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->agente_id = $agente;
        $user->save();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!is_null($user->contratos) && count($user->contratos) > 0) {
            return redirect('/comerciales')->with('error', 'El comercial no se ha eliminado con éxito');
        } else {
            $user->delete();
            return redirect('/comerciales')->with('success', 'El comercial se ha eliminado con éxito');
        }
    }
}
