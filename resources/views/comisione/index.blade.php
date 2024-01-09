@extends('adminlte::page')

@section('title', 'Comisiones')

@section('content_header')
    <h1 class="text-olive">Comisiones</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            @include('flash-message')
            @if(Auth::user()->role == 'Administrador')
            <div class="mb-2">
                <a href="{{route('comisiones.create')}}" class="btn btn-outline-success mb-3">
                    <i class="fas fa-percentage"></i> Crear </a>
            </div>
            @endif
            <div class="table-responsive ">
                <table id="comisiones" class="table table-striped" style="width:100%">
                    <thead class="table-white" style="color: #424949;">
                    <tr>
                        <th style="width: 10%;">Nº</th>
                        <th style="width: 10%;">Producto</th>
                        <th style="width: 10%;">Comercializadora</th>
                        <th style="width: 10%;">Agente</th>
                        <th style="width: 10%;">Comisión</th>
                        <th style="width: 5%;" class="@if(Auth::user()->role != 'Administrador')d-none @endif">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($comisiones as $comisione)
                        <tr>
                            <td>{{$comisione->id}}</td>
                            <td>{{ $comisione->producto->nombre }}</td>
                            <td>{{ $comisione->producto->comercializadora->nombre }}</td>
                            <td>{{ $comisione->user->name }} ({{$comisione->user->dni}})</td>
                            <td>{{ $comisione->comision }}%</td>
                            <td class="@if(Auth::user()->role != 'Administrador')d-none @endif">
                                <div class="row">
                                    <div class="col-5 d-flex justify-content-center">
                                        <a class="text-info"
                                           href="{{ route('comisiones.edit',$comisione->id) }}"><i
                                                class="fa fa-fw fa-edit"></i></a>
                                    </div>
                                    <div class="col-5 d-flex justify-content-center">
                                        <form action="{{url('/comisiones/eliminar/'.$comisione->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                            @include('comisione.partials.modal_delete')
                                        </form>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$comisione->id}}"
                                           class="text-danger"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="DataTables/datatables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/css/datetable.css">
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
            $('#comisiones').DataTable({
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
