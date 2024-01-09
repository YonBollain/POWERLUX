@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Crear proveedor</h1>
        <a href="{{url('/comercializadoras')}}" class="btn btn-outline-danger"><i class="fas fa-long-arrow-alt-left"></i> Volver</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('comercializadoras.store')}}" method="POST" id="crear-comercial">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                   placeholder="Nombre del proveedor" value="{{old('nombre')}}">
                            @error('nombre')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-success btn "><i class="fas fa-fw  fa-bolt"></i>
                            Crear
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

