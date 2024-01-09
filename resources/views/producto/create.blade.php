@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Crear producto</h1>
        <a href="{{url('/productos')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop


@section('content')
    <div class="card">
        @include('flash-message')
        <div class="card-body">
            <form action="{{route('productos.create')}}" onsubmit="return validarNumero()" method="POST" id="crear-comercial">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="comercializadora" class="form-label">Proveedor:<span class="text-danger">*</span></label>
                            <select name="comercializadora" class="form-control form-select " id="comercializadora">
                                <option selected value="0">Selecciona una proveedor</option>
                                @foreach($comercializadoras as $comercializadora)
                                    <option value="{{$comercializadora->id}}">{{$comercializadora->nombre}}</option>
                                @endforeach

                            </select>
                            <a href="{{route('comercializadoras.create')}}" class="small text-primary">Crear proveedor</a>
                            @error('comercializadora')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de producto:<span class="text-danger">*</span></label>
                            <select name="tipo" class="form-control form-select " id="tipo">
                                <option selected value="0">Selecciona un tipo</option>
                                <option value="Luz">Luz</option>
                                <option value="Gas">Gas</option>
                                <option value="Telefonía">Telefonía</option>
                            </select>
                            @error('tipo')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:<span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                   placeholder="Nombre del producto o del servicio">
                            @error('nombre')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="activo" class="form-label">¿Producto activo?<span class="text-danger">*</span></label>
                            <select name="activo" class="form-control form-select " id="activo">
                                <option selected value="0">Selecciona si esta activo</option>
                                <option value="Si">Activo</option>
                                <option value="No">Deshabilitado</option>
                            </select>
                            @error('activo')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="iva" class="form-label">Tipo de IVA:<span class="text-danger">*</span></label>
                            <input type="number" name="iva" class="form-control form-control" id="iva"
                                   placeholder="Tipo de IVA" pattern="[0-9]+" min="0" max="100" required>
                            @error('iva')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio:<span class="text-danger">*</span></label>
                            <input type="number" name="precio" class=" form-control" id="precio"
                                   placeholder="Precio" pattern="[0-9]+" required >
                            @error('precio')
                            <div class="text-danger ">
                                <p class="small m-0">*{{$message}}</p>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 lineas hide">
                            <label for="lineas" class="form-label">¿Es una línea? ¿Que tipo?<span class="text-muted small"> Si no seleccionas nada será "No"</span></label>
                            <div>
                                <label for="lineauno" class="form-label">
                                    <input type="radio" name="linea" class="form-check-inline" id="lineauno" value="linea">
                                    Linea normal
                                </label>
                            </div>
                            <div>
                                <label for="lineados" class="form-label">
                                    <input type="radio" name="linea" class="form-check-inline" id="lineados" value="fijo">
                                    Fijo
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-success btn "><i class="fas fa-fw fa-box-open"></i>
                            Crear
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            if ($('#tipo').val() === 'Telefonía') {
                $('.lineas').show(); // Muestra el div completo si "Telefonía" está seleccionada al cargar la página
            } else {
                $('.lineas').hide(); // Oculta el div completo por defecto
            }

            $('#tipo').change(function() {
                if ($(this).val() === 'Telefonía') {
                    $('.lineas').show();
                } else {
                    $('.lineas').hide();
                }
            });
        });
    </script>
@stop
