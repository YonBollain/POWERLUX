@extends('adminlte::page')

@section('title', 'Gestiones')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Crear Gestión</h1>
        <a href="{{url('/contratos')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
    <section class="content container-fluid">
        @include('flash-message')
        <form method="POST" action="/gestiones/{{$contrato}}/crear" class="row" role="form" enctype="multipart/form-data">
            @csrf
            @include('gestion.form')
        </form>
    </section>
@endsection


