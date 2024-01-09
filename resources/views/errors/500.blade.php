@extends('errors.template')
@section('code', '500')
@section('title', __('Página no encontrada'))

@section('content')
    <div class="container ">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center ">
                <h1 class="text-success"><b>SOM</b>LLUM</h1>
                <h1 style="font-size:8rem" class="text-success">500</h1>
                <h1 class="mt-3">¡Oops! Error al intentar encontrar el servidor</h1>
                <p class="lead">Lo sentimos, el servidor no le ha podido proporcionar una respuesta.</p>
                <a href="{{ route('home') }}" class="btn btn-success">Volver a la página de inicio</a>
            </div>
        </div>
    </div>
@endsection

