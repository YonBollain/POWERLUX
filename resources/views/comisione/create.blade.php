@extends('adminlte::page')

@section('title', 'Comisiones')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Crear comisión</h1>
        <a href="{{url('/comisiones')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop
@section('content')
    <section class="content container-fluid">
        @include('flash-message')
        @includeif('partials.errors')
        <form method="POST" action="{{ route('comisiones.store') }}" class="row"  role="form" >
            @csrf
            @include('comisione.form')
            <div class="col-12 pb-4 d-flex justify-content-md-center">
                <button type="submit" class="btn btn-outline-success btn-lg col-12 col-md-4 ">Crear comisión</button>
            </div>
        </form>
    </section>
@endsection
