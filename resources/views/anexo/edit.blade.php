@extends('adminlte::page')

@section('title', 'Anexos')

@section('content_header')
    <h1 class="text-olive">Editar anexo</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('anexo.update',$anexo->id) }}" class="row" role="form">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-12">
                            <label class="form-label" for="categoriaNueva">Nombre categoría</label>
                            <input type="text" class="form-control" name="categoriaNueva" id="categoriaNueva" value="{{$anexo->categoria}}">
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="subcategoriaNueva">Nombre subcategoría</label>
                            <input type="text" class="form-control" name="subcategoriaNueva" id="subcategoriaNueva" value="{{$anexo->subcategoria}}">
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="nombre">Nombre anexo</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{$anexo->nombre}}">
                        </div>
                        <div>
                            <p class="text-muted small">Para cambiar el documento tienes que borrar y volver a crear el anexo</p>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="btn btn-outline-success">Modificar</button>
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
