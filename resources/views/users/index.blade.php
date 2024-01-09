@extends('adminlte::page')

@section('title', 'Agentes')

@section('content_header')
    <h1 class="text-olive">Agentes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('flash-message')
            <div class="mb-2">
                <a href="/comerciales/crear" class="btn btn-outline-success mb-3"><i
                        class="fas fa-user-plus"></i> Crear </a>
            </div>
            <div class="table-responsive ">
            <table id="vendedores" class="table table-striped" style="width:100%">
                <thead class="table-white" style="color: #424949;">
                <tr>
                    <th style="width: 10%;">Nombre</th>
                    <th style="width: 11%;">Apellidos</th>
                    <th style="width: 11%;">Email</th>
                    <th style="width: 10%;">Role</th>
                    <th style="width: 2%;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $usuario)
                    <tr>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->lastname}}</td>
                        <td >{{$usuario->email}}</td>
                        <td >{{$usuario->role}}</td>
                        <td class="">
                            <div class="row">
                                <div class="col-4 d-flex justify-content-center">
                                    <a href="{{url('/comerciales/mostrar/'.$usuario->id)}}"
                                       class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <a href="{{url('/comerciales/edit/'.$usuario->id)}}" class="text-info"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-4 d-flex justify-content-center">
                                    <form action="{{url('/comerciales/eliminar/'.$usuario->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('delete')
                                        @include('users.partials.modal_delete')
                                    </form>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$usuario->id}}"
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
            $('#vendedores').DataTable({
                scrollX:true,
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
