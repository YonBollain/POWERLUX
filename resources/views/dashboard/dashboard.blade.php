@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    @include('flash-message')
    <h1 class="text-olive">Panel de control</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{count($contratosActivos)}}</h3>
                    <p>Contratos activos</p>
                </div>
                <div class="icon">
                    <i class="far fa-check-circle"></i>
                </div>
                <a href="{{route('contratos.index',['estado'=>'Activo'])}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{count($contratosPendientes)}}</h3>
                    <p>Contratos por revisar</p>
                </div>
                <div class="icon">
                    <i class="fas fa-eye"></i>
                </div>
                <a href="{{route('contratos.index',['estado'=>'Por revisar'])}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{count($contratosQuefaltan)}}</h3>
                    <p>con documentación pendiente</p>
                </div>
                <div class="icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="{{route('contratos.index',['documentos'=>'Falta documentacion'])}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-teal">
                <div class="inner">
                    <h3>{{$totalARenovar}}
                    </h3>
                    <p>Renovaciones pendientes</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sync-alt"></i>
                </div>
                <a href="{{route('contratos.index',['estado'=>'A renovar'])}}" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header ui-sortable-handle " style="cursor: move;">
                    <h3 class="card-title pt-1">
                        <i class="fas fa-file-contract"></i>
                        Contratos
                    </h3>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus "></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownEstadoContratos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filtrar por estados <i class="fas fa-filter"></i>
                            </button>
                            <div class="dropdown-menu menucontratos" aria-labelledby="dropdownEstadoContratos">
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="">Todos</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="por revisar">Por revisar</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="activo">Activo</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="inactivo">Inactivo</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="tramitado">En activación</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="incidencia">Incidencia</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="a renovar">A renovar</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="rechazado">Rechazado</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="revisado">Revisado</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="pte. firma">Pte. Firma</a>
                                <a class="dropdown-item" href="#dropdownEstadoContratos" data-estado="pte. verificación">Pte. Verificación</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table id="contratos" class="table table-striped my-datatable" style="width:100%">
                            <thead class="table-white" style="color: #424949;">
                            <tr>
                                <th style="width: 10%">#</th>
                                <th style="width: 10%">Cliente</th>
                                <th style="width: 10%">DNI/CIF</th>
                                <th style="width: 10%">Fecha </th>
                                <th style="width: 10%">Fecha Fin</th>
                                <th style="width: 10%">Tipo </th>
                                <th style="width: 10%">Comercializadora</th>
                                <th style="width: 10%">Producto</th>
                                <th style="width: 10%">Cups</th>
                                <th style="width: 10%">Direccion</th>
                                <th style="width: 10%">Cp</th>
                                <th style="width: 10%">Poblacion</th>
                                <th style="width: 10%">Movil</th>
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
                                    <td>{{ $contrato->fecha_incio }}</td>
                                    <td>{{ $contrato->fecha_fin }}</td>
                                    <td>{{ $contrato->tipo_contrato }}</td>
                                    <td>{{ $contrato->comercializadora->nombre}}</td>
                                    <td>{{ $contrato->producto->nombre }}</td>
                                    <td>{{ $contrato->cups }}</td>
                                    <td>{{ $contrato->direccion }}</td>
                                    <td >{{ $contrato->cp }}</td>
                                    <td>{{ $contrato->poblacion }}</td>
                                    <td> @if($contrato->movil == null){{$contrato->cliente->movil}} @else {{ $contrato->movil }} @endif</td>
                                    <td><span class="badge @if($contrato->estado !== 'Activo')badge-warning @else badge-success @endif">@if($contrato->estado == 'Tramitado')En activacion @else {{ $contrato->estado }} @endif</span></td>
                                    <td>{{ $contrato->user->name }}</td>
                                    <td>
                                        <div class="row">
                                            <div class="col-3 d-flex justify-content-center">
                                                <a href="{{ route('gestion.create',[$contrato->id,'suministros']) }}"
                                                   class="text-indigo"><i class="fas fa-users-cog"></i></a>
                                            </div>
                                            <div class="col-3 d-flex justify-content-center">
                                                <a href="{{ route('contratos.show',$contrato->id) }}"
                                                   class="text-success"><i class="fas fa-eye"></i></a>
                                            </div>
                                            <div class="col-3 d-flex justify-content-center">
                                                <a href="{{ route('contratos.edit',$contrato->id) }}" class="text-info"><i
                                                        class="fas fa-edit"></i></a>
                                            </div>
                                            @if(Auth::user()->role == 'Administrador')
                                            <div class="col-3 d-flex justify-content-center">
                                                <form action="{{ route('contratos.destroy',$contrato->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    @include('contrato.partials.modal_delete')
                                                </form>
                                                <a href="#" data-bs-toggle="modal"
                                                   data-bs-target="#modal{{$contrato->id}}"
                                                   class="text-danger"><i class="fas fa-trash-alt"></i></a>
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header ui-sortable-handle " style="cursor: move;">
                    <h3 class="card-title pt-1">
                        <i class="fas fa-file-contract"></i>
                        Contratos Telefonía
                    </h3>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus "></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownEstado" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filtrar por estados <i class="fas fa-filter"></i>
                            </button>
                            <div class="dropdown-menu menucontratostelefonia" aria-labelledby="dropdownEstado">
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="">Todos</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="por revisar">Por revisar</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="activo">Activo</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="inactivo">Inactivo</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="tramitado">En activación</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="incidencia">Incidencia</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="a renovar">A renovar</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="rechazado">Rechazado</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="revisado">Revisado</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="pte. firma">Pte. Firma</a>
                                <a class="dropdown-item" href="#dropdownEstado" data-estado="pte. verificación">Pte. Verificación</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table id="contratosTelefono" class="table table-striped my-datatable" style="width:100%">
                            <thead class="table-white" style="color: #424949;">
                            <tr>
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
                            @foreach ($contratos_telefono as $contrato)
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
                                //para usar los botones
                                dom: 'frtip',
                                pageLength: 4
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function () {
                            $('#contratosTelefono').DataTable({
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
                                dom: 'frtip',
                                pageLength: 4
                            });
                        });
                    </script>
                    <script>
                        $(document).ready(function() {
                            var table = $('#contratos').DataTable();

                            $('.menucontratos a').on('click', function() {
                                var estado = $(this).data('estado');
                                $('#dropdownEstadoContratos').text($(this).text());
                                table.column(13).search(estado).draw();
                            });

                            var tableTelefono = $('#contratosTelefono').DataTable();

                            $('.menucontratostelefonia a').on('click', function() {
                                var estado = $(this).data('estado');
                                $('#dropdownEstado').text($(this).text());
                                tableTelefono.column(10).search(estado).draw();
                            });
                        });

                    </script>
@stop
