@includeif('partials.errors')
<div class="col-md-6 col-12">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Datos del cliente</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('cliente_id','Identificador del cliente',['escape' => false]) }}<span
                            class="text-danger">*</span>
                        <select class="form-control clientes {{($errors->has('cliente_id') ? ' is-invalid' : '')}}" name="cliente_id" id="clientes">
                            <option value=""></option>
                            @if($clientes)
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}" data-dni="{{$cliente->dni_cif}}">{{$cliente->nombre}} ({{$cliente->dni_cif}})</option>
                                @endforeach
                            @endif
                        </select>
                        {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('movil','Móvil') }}
                        {{ Form::text('movil', $contrato->movil, ['class' => 'form-control' . ($errors->has('movil') ? ' is-invalid' : ''), 'placeholder' => 'Movil']) }}
                        {!! $errors->first('movil', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email') }}
                        {{ Form::text('email', $contrato->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-12">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Datos del suministro</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row">
                    <div class="form-group col-12">
                        {{ Form::label('direccion','Dirección') }}<span class="text-danger">*</span>
                        {{ Form::text('direccion', $contrato->direccion, ['class' => 'form-control' . ($errors->has('direccion') ? ' is-invalid' : ''), 'placeholder' => 'Dirección']) }}
                        {!! $errors->first('direccion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('poblacion','Población') }}<span class="text-danger">*</span>
                        {{ Form::text('poblacion', $contrato->poblacion, ['class' => 'form-control' . ($errors->has('poblacion') ? ' is-invalid' : ''), 'placeholder' => 'Poblacion']) }}
                        {!! $errors->first('poblacion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('cp','Código postal') }}<span class="text-danger">*</span>
                        {{ Form::text('cp', $contrato->cp, ['class' => 'form-control' . ($errors->has('cp') ? ' is-invalid' : ''), 'placeholder' => 'Código postal']) }}
                        {!! $errors->first('cp', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('provincia') }}<span class="text-danger">*</span>
                        {{ Form::text('provincia', $contrato->provincia, ['class' => 'form-control' . ($errors->has('provincia') ? ' is-invalid' : ''), 'placeholder' => 'Provincia']) }}
                        {!! $errors->first('provincia', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('cups','CUPS') }}<span class="text-danger">*</span>
                        {{ Form::text('cups', $contrato->cups, ['class' => 'form-control' . ($errors->has('cups') ? ' is-invalid' : ''), 'placeholder' => 'Numero de CUPS']) }}
                        {!! $errors->first('cups', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Datos del contrato</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row">
                    @if(Auth::user()->role == 'Administrador')
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('fecha_incio','Fecha inicio') }}<span class="text-danger">*</span>
                            {{ Form::date('fecha_incio', $fecha_actual, ['class' => 'form-control' . ($errors->has('fecha_incio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Incio']) }}
                            {!! $errors->first('fecha_incio', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    @else
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('fecha_incio','Fecha inicio') }}<span class="text-danger">*</span>
                            {{ Form::date('fecha_incio', $fecha_actual, ['class' => 'form-control' . ($errors->has('fecha_incio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Incio','readonly']) }}
                            {!! $errors->first('fecha_incio', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    @endif
                    @if(Auth::user()->role == 'Administrador')
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('fecha_fin','Fecha fin') }}<span class="text-danger">*</span>
                        {{ Form::date('fecha_fin', $fecha_fin, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin']) }}
                        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    @else
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('fecha_fin','Fecha fin') }}<span class="text-danger">*</span>
                        {{ Form::date('fecha_fin', $fecha_fin, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin','readonly']) }}
                        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    @endif
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('tipo_contrato','Tipo de contrato') }}<span class="text-danger">*</span>
                        {{ Form::select('tipo_contrato',$tipos_contrato, array_search($contrato->tipo_contrato,$tipos_contrato), ['class' => 'form-control' . ($errors->has('tipo_contrato') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona el tipo de contrato']) }}
                        {!! $errors->first('tipo_contrato', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('comercializadora_id','Proveedor') }}<span class="text-danger">*</span>
                        {{ Form::select('comercializadora_id',$comercializadoras, $contrato->comercializadora_id, ['class' => 'form-control ' . ($errors->has('comercializadora_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un proveedor']) }}
                        {!! $errors->first('comercializadora_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                        <input type="hidden" id="valor_guardado" value="{{($contrato->producto_id)}}">
                    <div class="form-group col-12">
                        {{ Form::label('producto_id','Producto') }}<span class="text-danger">*</span>
                        <select name="producto_id" id="producto_id"
                                class="form-control{{ $errors->has('producto_id') ? ' is-invalid' : '' }}">
                            <option value="">Selecciona el producto del proveedor</option>
                        </select>
                        {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                        @if(Auth::user()->role == 'Administrador')
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('precio_producto','Precio producto') }}<span class="text-danger">*</span>
                        {{ Form::number('precio_producto', $contrato->precio_producto, ['class' => 'form-control' . ($errors->has('precio_producto') ? ' is-invalid' : ''), 'placeholder' => 'Precio producto']) }}
                        {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('iva','IVA producto') }}<span class="text-danger">*</span>
                        {{ Form::number('iva', $contrato->iva, ['class' => 'form-control' . ($errors->has('iva') ? ' is-invalid' : ''), 'placeholder' => 'IVA del producto']) }}
                        {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                            <div class="form-group col-12">
                                <label for="estado">Estado</label><span class="text-danger">*</span>
                                <select class="form-control" id="estado" name="estado">
                                    <option  value="">Selecciona el estado del contrato</option>
                                    <option @if($contrato->estado == 'Por revisar') selected @endif value="1">Por revisar</option>
                                    <option @if($contrato->estado == 'Revisado') selected @endif value="2">Revisado</option>
                                    <option @if($contrato->estado == 'Pte. firma') selected @endif value="3">Pte. firma</option>
                                    <option @if($contrato->estado == 'Pte. verificación') selected @endif value="4">Pte. verificación</option>
                                    <option @if($contrato->estado == 'Tramitado') selected @endif value="5">En activación</option>
                                    <option @if($contrato->estado == 'Activo') selected @endif value="6">Activo</option>
                                    <option @if($contrato->estado == 'Incidencia') selected @endif value="7">Incidencia</option>
                                    <option @if($contrato->estado == 'Rechazado') selected @endif value="8">Rechazado</option>
                                    <option @if($contrato->estado == 'A renovar') selected @endif value="9">A renovar</option>
                                    <option @if($contrato->estado == 'Inactivo') selected @endif value="10">Inactivo</option>
                                </select>
                            </div>
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('user_id','Agente') }}<span class="text-danger">*</span>
                            {{ Form::select('user_id',  $agentes,$contrato->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un agente']) }}
                            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        @if($mode == 'edit')
                            <div class="form-group col-12 col-md-6">
                                {{ Form::label('comisión') }}<span class="text-danger">*</span>
                                {{ Form::number('comision', $contrato->comision, ['class' => 'form-control' . ($errors->has('comision') ? ' is-invalid' : ''), 'placeholder' => 'Comisión del agente', 'step' => 'any']) }}
                            </div>
                        @endif
                    @else

                        @if($mode == 'edit')
                           {{ Form::hidden('comision', $contrato->comision, ['class' => 'form-control' . ($errors->has('comision') ? ' is-invalid' : ''), 'placeholder' => 'comision']) }}
                        @endif
                        {{ Form::hidden('precio_producto', $contrato->precio_producto, ['class' => 'form-control' . ($errors->has('precio_producto') ? ' is-invalid' : ''), 'id'=>'precio_producto']) }}
                        {{ Form::hidden('iva', $contrato->iva, ['class' => 'form-control' . ($errors->has('precio_producto') ? ' is-invalid' : ''), 'id' => 'iva']) }}
                        {{ Form::hidden('estado', 1, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
                        {{ Form::hidden('user_id', Auth::user()->id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'Identificador del agente']) }}
                    @endif
                    <div class="form-group col-12">
                        {{ Form::label('comentarios','Nota') }}
                        {{ Form::textarea('comentarios', $contrato->comentarios, ['class' => 'form-control' . ($errors->has('comentarios') ? ' is-invalid' : ''), 'placeholder' => 'Comentarios']) }}
                        {!! $errors->first('comentarios', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Información bancaria</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row">
                    <div class="form-group col-12">
                        {{ Form::label('titular_banco','Titular de la cuenta bancaria') }}<span class="text-danger">*</span>
                        {{ Form::text('titular_banco', $contrato->titular_banco, ['class' => 'form-control' . ($errors->has('titular_banco') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del titular de la cuenta bancaria']) }}
                        {!! $errors->first('titular_banco', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('iban','IBAN') }}<span class="text-danger">*</span>
                        {{ Form::text('iban', $contrato->iban, ['class' => 'form-control' . ($errors->has('iban') ? ' is-invalid' : ''), 'placeholder' => 'Numero de la cuenta bancaria']) }}
                        {!! $errors->first('iban', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('factura', 'Factura online') }}<span class="text-danger">*</span>
                        <div class="form-check">
                            {{ Form::radio('factura_online','Si', ['id' => 'factura_online_yes', 'class' => 'form-check-input' . ($errors->has('factura_online') ? ' is-invalid' : '')]) }}
                            {{ Form::label('factura_online_yes', 'Sí', ['class' => 'form-check-label']) }}
                        </div>
                        <div class="form-check">
                            {{ Form::radio('factura_online','No' , ['id' => 'factura_online_no', 'class' => 'form-check-input' . ($errors->has('factura_online') ? ' is-invalid' : '')]) }}
                            {{ Form::label('factura_online_no', 'No', ['class' => 'form-check-label']) }}
                        </div>
                        {!! $errors->first('factura_online', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Documentos a aportar</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row">
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_dni', 'DNI') }}
                        <div class="custom-file">
                            {{ Form::file('documento_dni', [
                                'class' => 'custom-file-input' . ($errors->has('documento_dni') ? ' is-invalid' : ''),
                                'id' => 'documento_dni',
                                'data-browse' => 'Seleccionar'
]                           ) }}
                            <label class="custom-file-label" for="documento_dni" id="documentos-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_dni)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_dni)) }}" class="archivos">DNI</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_dni')}}" class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_dni', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_cif', 'CIF') }}
                        <div class="custom-file">
                            {{ Form::file('documento_cif', ['class' => 'custom-file-input' . ($errors->has('documento_cif') ? ' is-invalid' : ''), 'id' => 'documento_cif', 'data-browse' => 'Seleccionar cif']) }}
                            <label class="custom-file-label" for="documentos_cif" id="documentos-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_cif)
                                <div class=" d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_cif)) }}" class="archivos">CIF</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_cif')}}" class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_cif', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_factura', 'Factura') }}
                        <div class="custom-file">
                            {{ Form::file('documento_factura', ['class' => 'custom-file-input' . ($errors->has('documento_factura') ? ' is-invalid' : ''), 'id' => 'documentos_factura', 'data-browse' => 'Seleccionar factura']) }}
                            <label class="custom-file-label" for="documento_factura" id="documentos-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_factura)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_factura)) }}" class="archivos">Factura</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_factura')}}" class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_factura', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_escritura', 'Escritura de constitución') }}
                        <div class="custom-file">
                            {{ Form::file('documento_escritura', ['class' => 'custom-file-input' . ($errors->has('documento_escritura') ? ' is-invalid' : ''), 'id' => 'documentos_escritura', 'data-browse' => 'Seleccionar factura']) }}
                            <label class="custom-file-label" for="documento_escritura" id="documentos-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_escritura)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_escritura)) }}" class="archivos">Escritura</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_escritura')}}" class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_escritura', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_cie', 'CIE') }}
                        <div class="custom-file">
                            {{ Form::file('documento_cie', ['class' => 'custom-file-input' . ($errors->has('documentos_cie') ? ' is-invalid' : ''), 'id' => 'documentos_cie', 'data-browse' => 'Seleccionar factura']) }}
                            <label class="custom-file-label" for="documento_cie" id="documentos-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_cie)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_cie)) }}" class="archivos">CIE</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_cie')}}" class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_cie', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documentos', 'Documentos adicionales') }}
                        <div class="custom-file">
                            {{ Form::file('documentos[]', ['class' => 'custom-file-input' . ($errors->has('documentos') ? ' is-invalid' : ''), 'id' => 'documentos', 'data-browse' => 'Seleccionar archivo','multiple' => true]) }}
                            <label class="custom-file-label" for="documentos" id="documentos-label">Seleccionar
                                archivo</label>
                            @if($contrato->documentos)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo-json/'.$contrato->id.'/suministros')}}" class="archivos" >Archivos</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documentos/suministros')}}" class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documentos', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
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
        .custom-file-label::after{
            content: "Buscar";
        }
        a.archivos{
            text-decoration: underline;
        }
    </style>
@stop
@section('js')

    <script>
        //Este script hace que en el label de los inputs file se muestre el nombre del archivo selecionado
        $(document).ready(function () {
            function handleFileInput(e) {
                var fileName = e.target.files[0].name;
                $(this).next('label').html(fileName);
            }
            $('input[type="file"]').each(function() {
                $(this).change(handleFileInput);
            });
        });
    </script>
    <script src="{{ asset('/select2/select2.min.js') }}"></script>
    <script src="{{ asset('select2/es.js') }}"></script>
    <script src="{{ asset('js/select2Personalizados.js') }}"></script>
    <script>
        //Este script es para que usando el edit funcione el select2 con el valor definido por la base de datos
        let rutaActual = window.location.pathname;
        let rutaExcluir = "/contratos/crear";
        if (rutaActual !== rutaExcluir) {
            $(document).ready(function () {
                $(".clientes").val({{$contrato->cliente->id ?? old('cliente_id')}}).trigger("change");
            });
        }
        $(document).ready(function () {
        $('.clientes').change(function() {
            @foreach($clientes as $cliente)
                if($('.clientes').val() == {{$cliente->id}}){
                    @if($cliente->user_id == Auth::user()->id)
                    $.ajax({
                        url: '/datos/cliente/' +$('.clientes').val(),
                        method: 'GET',
                        success: function(data) {
                            $('#direccion').val(data.direccion);
                            $('#poblacion').val(data.poblacion);
                            $('#movil').val(data.movil);
                            $('#email').val(data.email);
                            $('#cp').val(data.cp);
                            $('#provincia').val(data.provincia);
                            $('#titular_banco').val(data.nombre);
                            $('#iban').val(data.iban);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error al obtener los datos del cliente');
                        }
                    });
                    @endif
            };
            @endforeach


        });
        });
    </script>
    <script>
        let productos ;
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
                        let numerotipo = $('#tipo_contrato').val();
                        let tipo = tipContrato[numerotipo - 1];
                        if (data.length !== 0) {
                            $('#mensajeErrorComercializadora').remove();
                            productos = data;
                            preciosProductos()
                            selectProductos.append($('<option>').val('').text('Selecciona el producto del proveedor'));
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

        //Estas funciones consiguen que se rellene el select de productos con la api en todas las ocasiones
        $(document).ready(function () {
            actualizarSelectProductos();
        });
        $(window).on('load', function () {
            actualizarSelectProductos();
        });

        $('#comercializadora_id').add($('#tipo_contrato')).on('change', function (event) {
            event.preventDefault();
            actualizarSelectProductos();
            preciosProductos()
        });

        function preciosProductos(){
            $('#producto_id').on('change',function (event){
                event.preventDefault();
                productos.forEach((element,index)=>{
                    if(element.id == $('#producto_id').val()){
                        $('#precio_producto').val(element.precio);
                        $('#iva').val(element.tipo_iva);
                    }
                });
            })
        }
    </script>
@stop
