@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <div class="d-flex justify-content-between">
    <h1 class="text-olive">Editar proveedor</h1>
    <a href="{{url('/comercializadoras')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{url('/comercializadoras/edit/'.$comercializadora->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                   placeholder="Nombre" value="{{$comercializadora->nombre}}">
                            @error('nombre')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-success btn "><i class="fas fa-edit"></i>
                            Modificar
                        </button>
                    </div>
                </div>
            </form>
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
