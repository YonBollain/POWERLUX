@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Editar producto</h1>
        <a href="{{url('/productos')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{url('/productos/editar/'.$producto->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="comercializadora_id" class="form-label">Proveedor</label>
                            <select name="comercializadora_id" class="form-control form-select " id="comercializadora_id">
                                @foreach($comercializadoras as $comercializadora)
                                    <option value="{{$comercializadora->id}}" @if($producto->comercializadora_id == $comercializadora->id)
                                        selected
                                        @endif>{{$comercializadora->nombre}}</option>
                                @endforeach
                            </select>
                            @error('comercializadora_id')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                   placeholder="Nombre del producto o del servicio" value="{{$producto->nombre}}">
                            @error('nombre')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de producto</label>
                            <select name="tipo" class="form-control form-select " id="tipo">
                                @if($producto->tipo == 'Luz')
                                    <option value="Luz" selected>Luz</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Telefonía">Telefonía</option>
                                @elseif($producto->tipo == 'Gas')
                                    <option value="Luz" selected>Luz</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Telefonía">Telefonía</option>
                                @else
                                    <option value="Luz">Luz</option>
                                    <option value="Gas">Gas</option>
                                    <option value="Telefonía" selected>Telefonía</option>
                                @endif

                            </select>
                            @error('tipo')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="activo" class="form-label">¿Producto activo?</label>
                            <select name="activo" class="form-control form-select " id="activo">
                                @if($producto->activo == 'Si')
                                    <option value="Si" selected>Activo</option>
                                    <option value="No">Deshabilitado</option>
                                @else
                                    <option value="Si">Activo</option>
                                    <option value="No" selected>Deshabilitado</option>
                                @endif
                            </select>
                            @error('activo')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipo_iva" class="form-label">Tipo de IVA</label>
                            <input type="number" name="tipo_iva" class="form-control form-control" id="tipo_iva"
                                   placeholder="Tipo de IVA" value="{{$producto->tipo_iva}}" min="0" max="100" pattern="[0-9]+" required>
                            @error('tipo_iva')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" name="precio" class=" form-control" id="precio"
                                   placeholder="Precio" value="{{$producto->precio}}" pattern="[0-9]+" required>
                            @error('precio')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-success btn "><i class="fas fa-user"></i>
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

