@extends('errors.template')
@section('code', '404')
@section('title', __('Página no encontrada'))

@section('content')
    <div class="container ">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center ">
                <h1 class="text-success"><b>SOM</b>LLUM</h1>
                <h1 style="font-size:8rem" class="text-success">404</h1>
                <h1 class="mt-3">¡Oops! Página no encontrada</h1>
                <p class="lead">Lo sentimos, la página que estás buscando no se pudo encontrar.</p>
                <a href="{{ route('home') }}" class="btn btn-success">Volver a la página de inicio</a>
            </div>
        </div>
    </div>
@endsection

