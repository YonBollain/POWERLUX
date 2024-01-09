@extends('errors.template')
@section('code', '419')
@section('title', __('Página no encontrada'))

@section('content')
    <div class="container ">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center ">
                <h1 class="text-success"><b>SOM</b>LLUM</h1>
                <h1 style="font-size:8rem" class="text-success">419</h1>
                <h1 class="mt-3">¡Oops! No tienes permisos</h1>
                <p class="lead">Lo sentimos, parece que has excedido el tiempo de autenticacion.</p>
                <a href="{{ route('home') }}" class="btn btn-succes">Volver a iniciar sesion</a>
            </div>
        </div>
    </div>
@endsection

