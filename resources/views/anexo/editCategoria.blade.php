@extends('adminlte::page')

@section('title', 'Anexos')

@section('content_header')
    <h1 class="text-olive">Cambiar nombre categoria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('anexo.updatecategoria') }}" class="row" role="form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="form-control" value="{{$categoria}}" name="categoriaVieja">
                        <div class="form-group col-12">
                            <label class="form-label" for="categoriaNueva">Nombre categoría</label>
                            <input type="text" class="form-control" name="categoriaNueva" id="categoriaNueva" value="{{$categoria}}">
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-outline-success">Cambiar nombre categoria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }
    </style>

@stop

@section('js')

@stop
