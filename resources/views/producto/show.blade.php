@extends('adminlte::page')

@section('title', 'Producto')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Mostrar producto</h1>
        <a href="{{url('/productos')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header bg-olive">
                    <h5 class="text-bold card-title">Datos del cliente</h5>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box box-info padding-1">
                        <div class="box-body row">
                            <div class="form-group col-12">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" class="form-control" disabled
                                       value="{{$producto->nombre}}">
                            </div>
                            <div class="form-group col-12">
                                <label for="dni" class="form-label">Tipo:</label>
                                <input type="text" id="dni" class="form-control" disabled
                                       value=" {{$producto->tipo}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="dni" class="form-label">Estado:</label>
                                <input type="text" id="email" class="form-control" disabled
                                       value="{{$producto->activo}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="movil" class="form-label">IVA:</label>
                                <input type="text" id="email" class="form-control" disabled
                                       value=" {{$producto->tipo_iva}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="movil" class="form-label">Proveedor:</label>
                                <input type="text" id="email" class="form-control" disabled
                                       value="{{$producto->comercializadora->nombre}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="movil" class="form-label">¿Es una línea o fijo?</label>
                                <input type="text" id="email" class="form-control" disabled
                                       value="@if($producto->linea == null) No @else{{$producto->linea}} @endif">
                            </div>
                        </div>
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
