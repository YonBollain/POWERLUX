@extends('adminlte::page')

@section('title', 'Anexos')

@section('content_header')
    <h1 class="text-olive">Editar subcategoria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <form method="POST" action="{{ route('anexo.updatesubcategoria') }}" class="row" role="form">
                        @csrf
                        @method('PUT')
                        <input type="hidden" class="form-control" value="{{$subcategoria}}" name="subcategoriaVieja">
                        <input type="hidden" class="form-control" value="{{$categoria}}" name="categoriaVieja">
                        <div class="form-group col-12">
                            <label class="form-label" for="categoriaNueva">Nombre categoría</label>
                            <input type="text" class="form-control" name="categoriaNueva" id="categoriaNueva" value="{{$categoria}}">
                        </div>
                        <div class="form-group col-12">
                            <label class="form-label" for="subcategoriaNueva">Nombre subcategoría</label>
                            <input type="text" class="form-control" name="subcategoriaNueva" id="subcategoriaNueva" value="{{$subcategoria}}">
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
