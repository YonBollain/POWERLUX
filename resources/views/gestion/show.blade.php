@extends('adminlte::page')

@section('title', 'Gestiones')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Mostrar gestión</h1>
        <a href="{{url('/gestiones')}}" class="btn btn-outline-danger">Volver</a>

    </div>
@stop
@section('content')
    @include('flash-message')
    @if($gestion->tipo_contrato == 'suministros')
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card card-default">
                <div class="card-header bg-olive">
                    <h5 class="text-bold card-title">Datos del contrato Nº#{{$gestion->contrato->id}} {{ucfirst($gestion->tipo_contrato)}}</h5>
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
                                       value="{{$gestion->contrato->cliente->nombre}}">
                            </div>
                            <div class="form-group col-12">
                                <label for="dni" class="form-label">DNI/CIF/NIE:</label>
                                <input type="text" id="dni" class="form-control" disabled
                                       value="{{$gestion->contrato->cliente->dni_cif}}">
                            </div>
                            <div class="form-group col-12">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <input type="text" id="direccion" class="form-control" disabled
                                       value="{{$gestion->contrato->direccion}} ({{$gestion->contrato->poblacion}}, {{$gestion->contrato->cp}}, {{$gestion->contrato->provincia}})">
                            </div>
                            <div class="form-group col-12">
                                <label for="cups" class="form-label">CUPS:</label>
                                <input type="text" id="cups" class="form-control" disabled
                                       value="{{$gestion->contrato->cups}}">
                            </div>
                            <div class="form-group col-12 d-flex justify-content-end">
                                <a href="{{route('contratos.show',$gestion->contrato->id)}}">Ver contrato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="row">
            <div class="col-md-6 col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Datos del contrato Nº#{{$gestion->contratoTelefonico->id}} {{ucfirst($gestion->tipo_contrato)}}</h5>
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
                                           value="{{$gestion->contratoTelefonico->cliente->nombre}}">
                                </div>
                                <div class="form-group col-12">
                                    <label for="dni" class="form-label">DNI/CIF/NIE:</label>
                                    <input type="text" id="dni" class="form-control" disabled
                                           value="{{$gestion->contratoTelefonico->cliente->dni_cif}}">
                                </div>
                                <div class="form-group col-12">
                                    <label for="direccion" class="form-label">Dirección:</label>
                                    <input type="text" id="direccion" class="form-control" disabled
                                           value="{{$gestion->contratoTelefonico->direccion}} ({{$gestion->contratoTelefonico->poblacion}}, {{$gestion->contratoTelefonico->cp}}, {{$gestion->contratoTelefonico->provincia}})">
                                </div>
                                <div class="form-group col-12 d-flex justify-content-end">
                                    <a href="{{route('contratotelefono.show',$gestion->contratoTelefonico->id)}}">Ver contrato</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-6 col-12">
            <div class="card card-default">
                <div class="card-header bg-olive">
                    <h5 class="text-bold card-title">Datos de la gestion</h5>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box box-info padding-1">
                        <div class="box-body row">
                            <div class="form-group col-12 col-md-6">
                                <label for="tipo" class="form-label">Tipo:</label>
                                <input type="text" id="tipo" class="form-control" disabled
                                       value="{{$gestion->tipo}}">
                            </div>
                            @if(Auth::user()->role != 'Administrador')
                            <div class="form-group col-12 col-md-6">
                                <label for="estado" class="form-label">Estado:</label>
                                <input type="text" id="estado" class="form-control" disabled
                                       value="{{$gestion->estado}}">
                            </div>
                            @else
                                <form method="POST"  action="{{route('gestion.update',$gestion->id)}}" class="form-group col-12 col-md-6"  role="form" enctype="multipart/form-data">
                                    @csrf
                                    <label for="estado" class="form-label">Estado:</label>
                                    <select id="estado" onchange="this.form.submit()" class="form-control{{($errors->has('estado') ? ' is-invalid' : '')}}" name="estado">
                                        <option value="0">Selecciona un estado</option>
                                        <option value="En tramite" @if($gestion->estado == 'En tramite') selected @endif>En tramite</option>
                                        <option value="Incidencia" @if($gestion->estado == 'Incidencia') selected @endif>Incidencia</option>
                                        <option value="Tramitado"@if($gestion->estado == 'Tramitado') selected @endif>Tramitado</option>
                                    </select>
                                </form>
                            @endif
                            <div class="form-group col-12">
                                <label for="nota" class="form-label mb-1">Nota:</label>
                                <textarea disabled cols="30" class="form-control" style="resize: none" rows="10" id="nota">{{$gestion->nota}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-12">
            <div class="card card-default">
                <div class="card-header bg-olive">
                    <h5 class="text-bold card-title">Documentos</h5>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box box-info padding-1">
                        <div class="box-body row">
                            @if($gestion->documentos != null)
                                <a href="{{url('/descargar-archivos-gestion/'.$gestion->id)}}">Descargar archivos</a>
                            @else
                                <p>No hay archivos en esta gestión</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
