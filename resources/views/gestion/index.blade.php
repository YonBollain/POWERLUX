@extends('adminlte::page')

@section('title', 'Gestiones')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Gestiones</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('flash-message')
                        <div class="table-responsive ">
                            <table id="gestiones" class="table table-striped" style="width:100%">
                                <thead class="table-white" style="color: #424949;">
                                <tr >
                                    <th style="width: 10%">Contrato</th>
                                    <th style="width: 10%">Nombre cliente</th>
                                    <th style="width: 10%">DNI/CIF/NIE </th>
                                    <th style="width: 10%">Tipo</th>
                                    <th style="width: 5%">Agente</th>
                                    <th style="width: 5%">Estado</th>
                                    <th style="width: 5%" class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($arrayGestiones as $gestion)
                                        <tr>
                                            @if($gestion->tipo_contrato == 'telefonia')
                                                <td><a href="{{route('contratotelefono.show',$gestion->contrato_id)}}">#{{$gestion->contrato_id}} {{ucfirst($gestion->tipo_contrato)}}</a></td>
                                                <td>{{$gestion->contratoTelefonico->cliente->nombre}}</td>
                                                <td>{{$gestion->contratoTelefonico->cliente->dni_cif}}</td>
                                            @else
                                                <td><a href="{{route('contratos.show',$gestion->contrato_id)}}">#{{$gestion->contrato_id}} {{ucfirst($gestion->tipo_contrato)}}</a></td>
                                                <td>{{$gestion->contrato->cliente->nombre}}</td>
                                                <td>{{$gestion->contrato->cliente->dni_cif}}</td>
                                            @endif

                                            <td>{{$gestion->tipo}}</td>
                                            <td>{{$gestion->user->name}}</td>
                                            <td>
                                                <span class="
                                                @if($gestion->estado == 'En tramite')badge badge-warning @endif
                                                @if($gestion->estado == 'Incidencia')badge badge-danger @endif
                                                @if($gestion->estado == 'Tramitado')badge badge-success @endif">
                                                    {{$gestion->estado}}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <a href="{{ route('gestion.show',$gestion->id) }}"
                                                           class="text-success"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                    @if(Auth::user()->role == 'Administrador')
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <a href="{{ route('gestion.delete',$gestion->id) }}"
                                                           class="text-danger"><i class="fas fa-trash"></i></a>
                                                    </div>
                                                    @endif
                                                </div>
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
@endsection
@section('css')
    <link href="DataTables/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="css/datetable.css">
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }
    </style>
@stop

@section('js')
    <script src="DataTables/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#gestiones').DataTable({
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
                //para usar los botones
                dom: 'flrtip'
            });
        });
    </script>
@stop
