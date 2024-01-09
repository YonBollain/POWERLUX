@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Productos</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @include('flash-message')
            @if(Auth::user()->role == 'Administrador')
            <div class="mb-2">
                <a href="{{route('productos.create')}}" class="btn btn-outline-success mb-3"><i
                        class="fas fa-fw fa-box-open"></i> Crear </a>
            </div>
            @endif
            <div class="table-responsive ">
            <table id="productos" class="table table-striped" style="width:100%">
                <thead class="table-white" style="color: #424949;">
                <tr>
                    <th style="width: 10%;">Proveedor</th>
                    <th style="width: 10%;">Nombre</th>
                    <th style="width: 10%;">Tipo</th>
                    <th style="width: 10%;" class="@if(Auth::user()->role != 'Administrador')d-none @endif">Precio</th>
                    <th style="width: 10%;">IVA</th>
                    <th style="width: 10%;">Activo</th>
                    <th style="width: 5%;" class="@if(Auth::user()->role != 'Administrador') d-none @endif">Acciones</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($productos as $producto)
                    <tr>
                        @foreach($comercializadoras as $comercializadora)
                            @if($comercializadora->id == $producto->comercializadora_id)
                                <td>{{$comercializadora->nombre}}</td>
                            @endif
                        @endforeach
                        <td>{{$producto->nombre}}</td>
                        <td >{{$producto->tipo}}</td>
                        <td class="@if(Auth::user()->role != 'Administrador')d-none @endif">{{$producto->precio}} €</td>
                        <td >{{$producto->tipo_iva}}%</td>
                        <td >{{$producto->activo}}</td>
                        <td class="@if(Auth::user()->role != 'Administrador') d-none @endif">
                            <div class="row">
                                <div class="col-3 d-flex justify-content-center ">
                                    <a href="{{url('/comisiones/crear')}}" class="text-orange"><i class="fas fa-percentage"></i></a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <a href="/productos/mostrar/{{$producto->id}}"
                                       class="text-success"><i class="fas fa-eye"></i></a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <a href="/productos/editar/{{$producto->id}}" class="text-info"><i
                                            class="fas fa-edit"></i></a>
                                </div>
                                <div class="col-3 d-flex justify-content-center">
                                    <form action="{{url('/productos/eliminar/'.$producto->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        @include('producto.partials.modal_delete')
                                    </form>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$producto->id}}"
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
            $('#productos').DataTable({
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
                dom: 'flrtip',
            });
        });
    </script>
@stop
