<div class="col-12">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Comision: #{{$comision->id}}</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row">
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('tipo_producto','Tipo de producto') }}<span class="text-danger">*</span>
                            <?php $tipo = isset($comision->producto) ? $comision->producto->tipo : ''; ?>
                            {{ Form::select('tipo_producto', $tipos_producto, array_search($tipo, $tipos_producto), ['class' => 'form-control' . ($errors->has('tipo_producto') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona el tipo de producto']) }}
                            {!! $errors->first('tipo_producto', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('comercializadora_id', 'Comercializadora') }}<span class="text-danger">*</span>
                            <?php $comercializadora_id = isset($comision->producto->comercializadora) ? $comision->producto->comercializadora->id : 0; ?>
                            {{ Form::select('comercializadora_id', $comercializadoras, $comercializadora_id, ['class' => 'form-control ' . ($errors->has('comercializadora_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona una comercializadora']) }}
                            {!! $errors->first('comercializadora_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    <input type="hidden" id="valor_guardado" value="{{($comision->producto_id)}}">
                    <div class="form-group col-12">
                        {{ Form::label('producto_id','Producto') }}<span class="text-danger">*</span>
                        <select name="producto_id" id="producto_id"
                                class="form-control{{ $errors->has('producto_id') ? ' is-invalid' : '' }}">
                            <option value="">Selecciona el producto de la comercializadora</option>
                        </select>
                        {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('Agente') }}
                        <select class="form-control users {{($errors->has('user_id') ? ' is-invalid' : '')}}"
                                name="user_id"
                                id="users">
                            <option value=""></option>
                            @if($users)
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" {{ (old('user_id') == $user->id) ? 'selected' : '' }}>{{$user->name}} ({{$user->dni}})</option>
                                @endforeach
                            @endif
                        </select>
                        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('comisión') }}
                        {{ Form::number('comision', $comision->comision, ['class' => 'form-control' . ($errors->has('comision') ? ' is-invalid' : ''), 'placeholder' => 'Comision']) }}
                        {!! $errors->first('comision', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
            </div>
        </div>
    </div>
</div>
@section('css')
    <link href="/select2/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-selection--single {
            height: 2.50rem !important;
            border-color: lightgrey !important;
        }

        .select2-selection__rendered {
            padding: 0 !important;
        }
    </style>
@stop
@section('js')
    <script src="{{ asset('/select2/select2.min.js') }}"></script>
    <script src="{{ asset('select2/es.js') }}"></script>
    <script src="{{ asset('js/select2Personalizados.js') }}"></script>
    <script>
        let rutaActual = window.location.pathname;
        let rutaExcluir = "/comisiones/crear";
        if (rutaActual !== rutaExcluir) {
            $(document).ready(function () {
                $(".users").val({{$comision->user->id ?? old('user_id')}}).trigger("change");
            });
        }
    </script>
    <script>
        function actualizarSelectProductos() {
            let comercializadora = $('#comercializadora_id').val();
            let valorGuardado = $('#valor_guardado').val();
            if (comercializadora !== "") {
                $.ajax({
                    url: "/datos/comercializadora/productos",
                    method: "GET",
                    data: {comercializadora_id: comercializadora},
                    success: function (data) {
                        let selectProductos = $('#producto_id');
                        selectProductos.empty();
                        let tipContrato = ['Luz', 'Gas', 'Telefonia'];
                        let numerotipo = $('#tipo_producto').val();
                        let tipo = tipContrato[numerotipo - 1];
                        if (data.length !== 0) {
                            $('#mensajeErrorComercializadora').remove();
                            $.each(data, function (index, opcion) {
                                if (tipo === opcion.tipo) {
                                    let nuevaOpcion = $('<option>').val(opcion.id).text(opcion.nombre);
                                    selectProductos.append(nuevaOpcion);
                                }
                                $('#producto_id option').each(function() {
                                    if ($(this).val() == valorGuardado) {
                                        $(this).prop('selected', true);
                                    }
                                });
                            });
                        } else {
                            $('#mensajeErrorComercializadora').remove();
                            selectProductos.after($('<p class="small text-danger" id="mensajeErrorComercializadora">').text('Esa comercializadora no tiene productos'));
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error al obtener los productos de esa comercializadora: " + error);
                    }
                });
            }
        }
        $(document).ready(function () {
            actualizarSelectProductos();
        });
        $(window).on('load', function () {
            actualizarSelectProductos();
        });

        $('#comercializadora_id').add($('#tipo_producto')).on('change', function (event) {
            event.preventDefault();
            actualizarSelectProductos();
        });
    </script>
@stop
