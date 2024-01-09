@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Crear contrato telefonía</h1>
        <a href="{{url('/contratos/telefonia')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
    <section class="content container-fluid">
        @include('flash-message')
        <form method="POST" action="{{ route('contratotelefono.store') }}" class="row" role="form"
              enctype="multipart/form-data">
            @csrf

            @include('contratotelefono.form')
            <div class="col-12 pb-4 d-flex justify-content-md-center">
                <button type="submit" class="btn btn-outline-success btn-lg col-12 col-md-4 ">Crear contrato</button>
            </div>
        </form>
    </section>
@endsection


