@extends('adminlte::page')

@section('title', 'Liquidaciones')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Liquidaciones</h1>
    </div>
@stop
@section('content')
    @include('flash-message')
    <section class="content container-fluid">
        <div class="row">
            @if(Auth::user()->role == 'Administrador')
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Generar liquidación</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body ">
                                <form method="POST" action="{{ route('liquidacion.store') }}" class="row" role="form">
                                    @csrf
                                    <div class="form-group col-12 col-md-6">
                                        {{ Form::label('fecha_incio','Fecha inicio') }}<span
                                            class="text-danger">*</span>
                                        {{ Form::date('fecha_incio','', ['class' => 'form-control' . ($errors->has('fecha_incio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Incio','required'=>'required']) }}
                                        {!! $errors->first('fecha_incio', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        {{ Form::label('fecha_fin','Fecha fin') }}<span class="text-danger">*</span>
                                        {{ Form::date('fecha_fin', '', ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin','required'=>'required']) }}
                                        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group col-12 pb-3">
                                        {{ Form::label('agentes','Agentes') }}<span class="text-danger">*</span>
                                        <select
                                            class="form-control usuarios {{($errors->has('cliente_id') ? ' is-invalid' : '')}}"
                                            name="usuarios[]"
                                            id="usuarios"
                                            multiple >
                                            <option value=""></option>
                                            @if($usuarios)
                                                @foreach($usuarios as $usuario)
                                                    <option value="{{$usuario->id}}">{{$usuario->name}}
                                                        ({{$usuario->dni}})
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        {!! $errors->first('usuarios', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    <div class="form-group col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-outline-success">Generar liquidación</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Liquidaciones</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body">
                                <div class="table-responsive ">
                                    <table id="liquidaciones" class="table table-striped" style="width:100%">
                                        <thead class="table-white" style="color: #424949;">
                                        <tr>
                                            <th style="width: 10%;">Nº</th>
                                            <th style="width: 10%;">Numero Factura</th>
                                            <th style="width: 10%;">Fecha</th>
                                            <th style="width: 10%;">Estado</th>
                                            <th style="width: 10%;">Importe</th>
                                            <th style="width: 10%;">Agente</th>
                                            <th style="width: 5%;">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($liquidaciones as $liquidacione)
                                            <tr>
                                                <td>{{$liquidacione->id}}</td>

                                                <td>@if($liquidacione->numero_factura != null || $liquidacione->numero_factura != '')
                                                        <span class="badge badge-secondary">{{ $liquidacione->numero_factura }}</span>@endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($liquidacione->fecha)->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($liquidacione->estado == 'Pagado')
                                                        <span class="badge badge-success">{{ $liquidacione->estado }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ $liquidacione->estado }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ number_format($liquidacione->importe,2) }}€</td>
                                                <td>{{ $liquidacione->user->name }}</td>
                                                <td >
                                                    <div class="row ">
                                                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center ">
                                                            <a href="{{route('liquidacion.edit',$liquidacione->id)}}" class="btn-sm btn-danger text-center"><i class="fas fa-list"></i></a>
                                                        </div>
                                                        @if($liquidacione->numero_factura !=null ||$liquidacione->numero_factura !='')
                                                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                                            <a href="{{route('liquidacion.descargarLiquidacion',$liquidacione->id)}}" class="btn-sm btn-info" target="_blank"><i class="fas fa-download"></i></a>
                                                        </div>
                                                        @else
                                                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                                                <a href="{{route('liquidacion.descargarLiquidacion',$liquidacione->id)}}" class="btn-sm btn-info"><i class="fas fa-download"></i></a>
                                                            </div>
                                                        @endif
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    <link href="DataTables/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/datetable.css">
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }
    </style>
    <link href="/select2/select2.min.css" rel="stylesheet"/>
    <style>
        #usuarios {
            width: 100%;
        }

        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 4px;
            min-height: 38px;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            margin-right: 5px;
            padding: 5px 10px;
            text-align: center;
            width: 12rem;
        }

        .select2-container--default .select2-selection--multiple .select2-search__field {
            height: 1.5rem !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            font-size: 16px;
            color: #999;
            line-height: 1;
            padding: 0 0.5rem;
            height: 100% !important;
            margin: 0;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #999;
            cursor: pointer;
        }
        .select2-selection__choice__display{
            padding-left: 10px !important;
        }
    </style>
@stop
@section('js')
    <script src="{{ asset('/select2/select2.min.js') }}"></script>
    <script src="{{ asset('select2/es.js') }}"></script>
    <script src="{{ asset('js/select2Personalizados.js') }}"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
    <script src="js/contratosClientes.js"></script>
    <script>
        $(document).ready(function () {
            $('#liquidaciones').DataTable({
                scrollX: true,
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "sProcessing": "Procesando...",
                },
                dom: 'flrtip',
            });
        });
    </script>
@stop
