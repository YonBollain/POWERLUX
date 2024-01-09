@extends('adminlte::page')

@section('title', 'Contratos Telefonia')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Contratos de telefonía</h1>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @include('flash-message')
                        <div class="mb-2">
                            <a href="{{route('contratotelefono.create')}}" class="btn btn-outline-success mb-3"><i
                                    class="fas fa-fw fa-file-signature"></i> Crear </a>
                        </div>
                        <div class="form-group">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownEstado" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filtrar por estados <i class="fas fa-filter"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownEstado">
                                    <a class="dropdown-item" href="#" data-estado="">Todos</a>
                                    <a class="dropdown-item" href="#" data-estado="por revisar">Por revisar</a>
                                    <a class="dropdown-item" href="#" data-estado="activo">Activo</a>
                                    <a class="dropdown-item" href="#" data-estado="inactivo">Inactivo</a>
                                    <a class="dropdown-item" href="#" data-estado="en activacion">En activación</a>
                                    <a class="dropdown-item" href="#" data-estado="incidencia">Incidencia</a>
                                    <a class="dropdown-item" href="#" data-estado="a renovar">A renovar</a>
                                    <a class="dropdown-item" href="#" data-estado="rechazado">Rechazado</a>
                                    <a class="dropdown-item" href="#" data-estado="revisado">Revisado</a>
                                    <a class="dropdown-item" href="#" data-estado="pte. firma">Pte. Firma</a>
                                    <a class="dropdown-item" href="#" data-estado="pte. verificación">Pte. Verificación</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive ">
                            <table id="contratos" class="table table-striped" style="width:100%">
                                <thead class="table-white" style="color: #424949;">
                                    <tr >
                                        <th style="width: 2%">#</th>
										<th style="width: 10%">Cliente</th>
                                        <th style="width: 10%">DNI/CIF</th>
										<th style="width: 10%">Fecha </th>
										<th style="width: 10%">Fecha Fin</th>
										<th style="width: 10%">Proveedor</th>
										<th style="width: 10%">Dirección</th>
										<th style="width: 10%">Cp</th>
										<th style="width: 10%">Población</th>
                                        <th style="width: 10%">Móvil</th>
                                        <th style="width: 10%">Estado</th>
										<th style="width: 10%">Agente</th>
                                        <th style="width: 10%">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contratos_agente as $contrato)
                                        <tr>
                                            <td>{{ $contrato->id }}</td>
											<td>{{ $contrato->cliente->nombre }}</td>
                                            <td>{{ $contrato->cliente->dni_cif }}</td>
											<td>{{ \Carbon\Carbon::parse($contrato->fecha_incio)->format('d/m/Y') }}</td>
											<td>{{ \Carbon\Carbon::parse($contrato->fecha_fin)->format('d/m/Y') }}</td>
											<td>{{ $contrato->comercializadora->nombre}}</td>
											<td>{{ $contrato->direccion }}</td>
                                            <td >{{ $contrato->cp }}</td>
											<td>{{ $contrato->poblacion }}</td>
                                            <td> @if($contrato->movil == null){{$contrato->cliente->movil}} @else {{ $contrato->movil }} @endif</td>
                                            <td><span class="badge @if($contrato->estado !== 'Activo')badge-warning @else badge-success @endif">@if($contrato->estado == 'Tramitado')En activacion @else {{ $contrato->estado }} @endif</span></td>
											<td>{{ $contrato->user->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3 d-flex justify-content-center">
                                                        <a href="{{ route('gestion.create',[$contrato->id,'telefonia']) }}"
                                                           class="text-indigo"><i class="fas fa-users-cog"></i></a>
                                                    </div>
                                                    <div class="col-3 d-flex justify-content-center">
                                                        <a href="{{ route('contratotelefono.show',$contrato->id) }}"
                                                           class="text-success"><i class="fas fa-eye"></i></a>
                                                    </div>
                                                    <div class="col-3 d-flex justify-content-center">
                                                        <a href="{{ route('contratotelefono.edit',$contrato->id) }}" class="text-info"><i
                                                                class="fas fa-edit"></i></a>
                                                    </div>
                                                    <div class="col-3 @if(Auth::user()->role !='Administrador') d-none @else d-flex justify-content-center @endif">
                                                        <form action="{{ route('contratotelefono.destroy',$contrato->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            @include('contratotelefono.partials.modal_delete')
                                                        </form>
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$contrato->id}}"
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
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="{{url('DataTables/datatables.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/datetable.css')}}">
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }
    </style>

@stop
@section('js')
    <script src="{{url('DataTables/datatables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#contratos').DataTable({
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
                            columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,16,18]
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> ',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info col-xs-2',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4,5,6,7,8,9,10,11,14,15,18]
                        }
                    },
                ]
            });
        });
    </script>
   <script>
       $(document).ready(function() {
           var table = $('#contratos').DataTable();
           $('.dropdown-menu a').on('click', function() {
               var estado = $(this).data('estado');
               $('#dropdownEstado').text($(this).text());
               table.column(10).search(estado).draw();
           });
       });
   </script>
@stop
