@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1 class="text-olive">Clientes</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            @include('flash-message')
            <div class="mb-2">
                <a href="/clientes/crear" class="btn btn-outline-success mb-3"><i
                        class="fas fa-user-plus"></i> Crear </a>
            </div>
            <div class="table-responsive ">
            <table id="clientes" class="table table-striped" style="width:100%">
                <thead class="table-white" style="color: #424949;">
                <tr>
                    <th style="width: 10%;" class="d-none">Tipo</th>
                    <th style="width: 10%;">DNI/NIE/CIF</th>
                    <th style="width: 10%;">Nombre/Razón social</th>
                    <th style="width: 10%;" >Representante Legal</th>
                    <th style="width: 10%;" >Dirección</th>
                    <th style="width: 10%;" class="d-none ">CP</th>
                    <th style="width: 10%;" >Población</th>
                    <th style="width: 10%;" >Provincia</th>
                    <th style="width: 10%;" >Móvil</th>
                    <th style="width: 10%;" class="d-none ">Email</th>
                    <th style="width: 10%;" >Teléfono</th>
                    <th style="width: 10%;" class="d-none ">Teléfono 2</th>
                    <th style="width: 10%;" class="d-none ">IBAN</th>
                    <th style="width: 10%;" class="d-none ">Notas</th>
                    <th style="width: 10%;" class="d-none ">Contacto</th>
                    <th style="width: 10%;" >Teléfono contacto</th>
                    <th style="width: 10%;" >Agente</th>
                    <th style="width: 2%;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td class="d-none">{{$cliente->tipo}}</td>
                        <td>{{$cliente->dni_cif}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->representante}}</td>
                        <td >{{$cliente->direccion}}</td>
                        <td class="d-none ">{{$cliente->cp}}</td>
                        <td>{{$cliente->poblacion}}</td>
                        <td>{{$cliente->provincia}}</td>
                        <td>{{$cliente->movil}}</td>
                        <td class="d-none">{{$cliente->email}}</td>
                        <td>{{$cliente->telefono1}}</td>
                        <td class="d-none">{{$cliente->telefono2}}</td>
                        <td class="d-none">{{$cliente->iban}}</td>
                        <td class="d-none">{{$cliente->notas}}</td>
                        <td class="d-none">{{$cliente->contacto}}</td>
                        <td>{{$cliente->tel_contacto}}</td>
                        <td>{{$cliente->user->name}}</td>
                        <td>
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center">
                                    @include('clientes.partials.modal_contratos')
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal_contratos{{$cliente->id}}" id="{{$cliente->id}}"
                                       class="text-primary enlace"><i class="fas fa-file-contract"></i></a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <a href="{{url('/clientes/mostrar/'.$cliente->id)}}"
                                       class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <a href="{{url('/clientes/editar/'.$cliente->id)}}" class="text-info"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <form action="{{url('/clientes/eliminar/'.$cliente->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        @include('clientes.partials.modal_delete')
                                    </form>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$cliente->id}}"
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
        .table-responsive.tabla-modal{
            max-height: 250px;
            overflow-y: auto;
            overflow-x: auto ;
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
    <script src="js/contratosClientes.js"></script>
    <script>

        $(document).ready(function () {
            $('#clientes').DataTable({
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
                dom: 'flrtipB',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> ',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success col-xs-2',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9,10,11,14,15]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info col-xs-2',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9,10,11,14,15]
                        }
                    },
                ]
            });
        });
    </script>
@stop
