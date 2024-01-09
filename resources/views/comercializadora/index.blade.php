@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1 class="text-olive">Proveedores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('flash-message')
            @if(Auth::user()->role == 'Administrador')
            <div class="mb-2">
                <a href="{{route('comercializadoras.create')}}" class="btn btn-outline-success mb-3"><i
                        class="fas fa-fw  fa-bolt"></i> Crear </a>
            </div>
            @endif
            <div class="table-responsive ">
            <table id="comercializadora" class="table table-striped" style="width:100%">
                <thead class="table-white" style="color: #424949;">
                <tr>
                    <th style="width: 10%;">Identificador</th>
                    <th style="width: 80%;">Nombre</th>
                    <th style="width: 10%;" class="@if(Auth::user()->role != "Administrador") d-none @endif">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comercializadoras as $comercializadora)
                    <tr>
                        <td>{{$comercializadora->id}}</td>
                        <td>{{$comercializadora->nombre}}</td>
                        <td class="@if(Auth::user()->role != "Administrador") d-none @endif">
                            <div class="row">
                                <div class="col-6 d-flex justify-content-center">
                                    <a href="/comercializadoras/edit/{{$comercializadora->id}}" class="text-info"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-6 d-flex justify-content-center">
                                    <form action="{{url('/comercializadoras/eliminar/'.$comercializadora->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        @include('comercializadora.partials.modal_delete')
                                    </form>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$comercializadora->id}}"
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
@stop

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
            $('#comercializadora').DataTable({
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
                dom: 'flrtip',
            });
        });
    </script>
@stop
