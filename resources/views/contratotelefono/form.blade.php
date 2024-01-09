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
                        {{ Form::text('movil', $contrato->movil, ['class' => 'form-control' . ($errors->has('movil') ? ' is-invalid' : ''), 'placeholder' => 'Movil','value'=>old('movil')]) }}
                        {!! $errors->first('movil', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email') }}
                        {{ Form::text('email', $contrato->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email','value'=>old('email')]) }}
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
            <h5 class="text-bold card-title">Dirección</h5>
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
                    <div class="form-group col-12 ">
                        {{ Form::label('poblacion','Población') }}<span class="text-danger">*</span>
                        {{ Form::text('poblacion', $contrato->poblacion, ['class' => 'form-control' . ($errors->has('poblacion') ? ' is-invalid' : ''), 'placeholder' => 'Poblacion']) }}
                        {!! $errors->first('poblacion', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('cp','Código postal') }}<span class="text-danger">*</span>
                        {{ Form::text('cp', $contrato->cp, ['class' => 'form-control' . ($errors->has('cp') ? ' is-invalid' : ''), 'placeholder' => 'Código postal']) }}
                        {!! $errors->first('cp', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('provincia') }}<span class="text-danger">*</span>
                        {{ Form::text('provincia', $contrato->provincia, ['class' => 'form-control' . ($errors->has('provincia') ? ' is-invalid' : ''), 'placeholder' => 'Provincia']) }}
                        {!! $errors->first('provincia', '<div class="invalid-feedback">:message</div>') !!}
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
                            {{ Form::date('fecha_incio' ,$fecha_actual, ['class' => 'form-control' . ($errors->has('fecha_incio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Incio']) }}
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
                            {{ Form::date('fecha_fin', $fecha_fin, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Fin']) }}
                            {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    @endif
                    @if($mode == 'edit')
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('comercializadora_id','Proveedor') }}<span class="text-danger">*</span>
                            {{ Form::select('comercializadora_id',$comercializadoras, $contrato->comercializadora_id, ['class' => 'form-control ' . ($errors->has('comercializadora_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un proveedor']) }}
                            {!! $errors->first('comercializadora_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    @else
                        <div class="form-group col-12 col-md-6">
                            {{ Form::label('comercializadora_id','Proveedor') }}<span
                                class="text-danger">*</span>
                            {{ Form::select('comercializadora_id',$comercializadoras, $contrato->comercializadora_id, ['class' => 'form-control ' . ($errors->has('comercializadora_id') ? ' is-invalid' : ''), 'placeholder' => 'Selecciona un proveedor',]) }}
                            {!! $errors->first('comercializadora_id', '<div class="invalid-feedback">:message</div>') !!}
                            <div class="text-muted small">Si cambias de proveedor se borraran los productos del
                                contrato
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->role == 'Administrador')
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
<div class="col-12 col-md-6">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Añadir productos</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row align-items-end">
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('producto_id','Producto') }}<span class="text-danger">*</span>
                        <select name="producto_id" id="producto_id"
                                class="form-control{{ $errors->has('producto_id') ? ' is-invalid' : '' }}">
                            <option value="">Selecciona el proveedor</option>
                        </select>
                        {!! $errors->first('producto_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6 d-flex justify-content-md-start justify-content-end ">
                        <button type="button" id="addproducto" class="btn btn-outline-info">Añadir producto</button>
                    </div>
                    <div class="form-group col-12 table @if($mode !='edit')d-none @endif ">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="productos" class="table table-striped m-0 w-100" style="width:100%">
                                        <thead class="table-white" style="color: #424949;">
                                        <tr>
                                            <th style="width: 10%">ID</th>
                                            <th style="width: 80%">Producto</th>
                                            <th style="width: 10%">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($productos as $producto)
                                            <tr>
                                                @php($produ = \App\Models\Producto::where('id',$producto->producto_id)->get())
                                                <td>{{$producto->producto_id}}</td>
                                                <td>{{$produ[0]->nombre}}</td>
                                                <td>
                                                    @if($mode == 'edit')
                                                        <a href="{{route('contratotelefono.producto.destroy',$producto->id)}}">
                                                            <i class="fas fa-trash-alt text-danger"></i>
                                                        </a>
                                                </td>
                                                @else
                                                    <td><a class="text-danger" onclick="eliminarFila(this)"><i
                                                                class="fas fa-trash-alt"></i></a></td>
                                                @endif
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
        </div>
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="card card-default">
        <div class="card-header bg-olive">
            <h5 class="text-bold card-title">Añadir lineas</h5>
            <div class="card-tools ">
                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus text-white"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body row align-items-end">
                    <div class="form-group col-12 col-md-6">
                        {{ Form::label('lineas_id','Lineas') }}<span class="text-danger">*</span>
                        <select name="lineas" id="lineas_id"
                                class="form-control{{ $errors->has('lineas') ? ' is-invalid' : '' }}">
                            <option value="">Selecciona el proveedor</option>
                        </select>
                        {!! $errors->first('lineas', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 col-md-6 d-flex justify-content-md-start justify-content-end ">
                        <button type="button" id="addlinea" class="btn btn-outline-info">Añadir linea</button>
                    </div>
                    <div class="col-12 row lineas-inputs ">
                        <div class="form-group col-12 col-md-3">
                            <label for="linea_nombre" class="form-label">Nombre<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="linea_nombre">
                            <span class="error-message" id="linea_nombre-error"></span>
                        </div>
                        <div class="form-group col-12 col-md-3">
                            <label for="linea_dni">DNI<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="linea_dni">
                            <span class="error-message" id="linea_dni-error"></span>
                        </div>
                        <div class="form-group col-12 col-md-3">
                            <label for=linea_numero" class="form-label">Número<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="linea_numero">
                            <span class="error-message" id="linea_numero-error"></span>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="linea_operador" class="form-label">Operador donante</label>
                            <input type="text" class="form-control" id="linea_operador">
                        </div>
                        <div class="form-group col-12 col-md-2">
                            <label for="linea_dni">Clase<span class="text-danger">*</span></label>
                            <select id="clase" class="form-control">
                                <option value="Nueva">Nueva</option>
                                <option value="Portavilidad">Portabilidad</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="linea_icc">ICC<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="linea_icc">
                            <span class="error-message" id="linea_icc-error"></span>
                        </div>
                        <div class="form-group col-12 col-md-2 ">
                            <label for=linea_numero" class="form-label">¿Línea principal?<span
                                    class="text-danger">*</span></label>
                            <div class="d-flex justify-content-around ">
                                <div class="d-flex">
                                    <input type="radio" class="form-check principal" name="prin" value="1">
                                    <label class="form-label mb-0 pl-1"> Si</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="form-check principal" name="prin" value="0">
                                    <label class="form-label mb-0 pl-1">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-md-6 d-flex justify-content-md-start justify-content-end ">
                            <button type="button" id="savelinea" class="btn btn-outline-info">Guardar linea</button>
                        </div>
                    </div>
                    <div class="form-group col-12 tabledos @if($mode !='edit')d-none @endif " id="table">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="linea" class="table table-striped m-0 w-100 "
                                           style="width:100%;overflow-x: scroll;">
                                        <thead class="table-white" style="color: #424949;">

                                        <tr>
                                            <th style="width: 5%">ID</th>
                                            <th style="width: 10%">Producto</th>
                                            <th style="width: 10%">Numero</th>
                                            <th style="width: 10%">Clase</th>
                                            <th style="width: 20%">Nombre</th>
                                            <th style="width: 30%">ICC</th>
                                            <th style="width: 20%">Linea Principal</th>
                                            <th style="width: 5%">Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($lineasCreados as $linea)
                                            @php($produ = \App\Models\Producto::where('id',$linea['producto_id'])->first())
                                            <tr>
                                                <td>{{$linea['id']}}</td>
                                                <td>{{$produ->nombre}}</td>
                                                <td>{{$linea['numero']}}</td>
                                                <td>{{$linea['clase']}}</td>
                                                <td>{{$linea['nombre_titular']}}</td>
                                                <td>{{$linea['icc']}}</td>
                                                <td>@if($linea['linea_principal']== 1)
                                                        Si
                                                    @else
                                                        No
                                                    @endif</td>
                                                @if($mode == 'edit')
                                                    <form
                                                        action="{{route('contratotelefono.producto.destroy',$linea['id'])}}">
                                                        <td>
                                                            <button type="submit" class="btn text-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </form>
                                                @else
                                                    <td><a class="text-danger" onclick="eliminarFila(this)"><i
                                                                class="fas fa-trash-alt"></i></a></td>
                                                @endif

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
                            <label class="custom-file-label" for="documento_dni" id="documento-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_dni)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo-telefonico/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_dni)) }}"
                                       class="archivos">DNI</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_dni/telefonico')}}"
                                       class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_dni', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_factura', 'Factura') }}
                        <div class="custom-file">
                            {{ Form::file('documento_factura', ['class' => 'custom-file-input' . ($errors->has('documento_factura') ? ' is-invalid' : ''), 'id' => 'documento_factura', 'data-browse' => 'Seleccionar factura']) }}
                            <label class="custom-file-label" for="documento_factura" id="documento-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_factura)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo-telefonico/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_factura)) }}"
                                       class="archivos">Factura</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_factura/telefonico')}}"
                                       class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_factura', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        {{ Form::label('documento_cerficado', 'Certificado') }}
                        <div class="custom-file">
                            {{ Form::file('documento_cerficado', ['class' => 'custom-file-input' . ($errors->has('documento_cerficado') ? ' is-invalid' : ''), 'id' => 'documento_cerficado', 'data-browse' => 'Seleccionar factura']) }}
                            <label class="custom-file-label" for="documento_cerficado" id="documento-label">Seleccionar
                                archivo</label>
                            @if($contrato->documento_cerficado)
                                <div class="d-flex justify-content-between align-items-center gap-2">
                                    <a href="{{url('/descargar-archivo-telefonico/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_cerficado)) }}"
                                       class="archivos">Certificado</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documento_cerficado/telefonico')}}"
                                       class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documento_cerficado', '<div class="invalid-feedback">:message</div>') !!}

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
                                    <a href="{{url('/descargar-archivo-json/'.$contrato->id.'/telefonico')}}"
                                       class="archivos">Archivos</a>
                                    <a href="{{url('/borrar-archivo/'.$contrato->id.'/documentos/telefonico')}}"
                                       class="text-danger"><i class="fas fa-times"></i></a>
                                </div>
                            @endif
                            {!! $errors->first('documentos', '<div class="invalid-feedback">:message</div>') !!}

                        </div>
                    </div>
                    <input type="hidden" name="productosCreados" id="productosCreados">
                    <input type="hidden" name="lineasCreados" id="lineasCreados">
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link href="{{url('/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{url('DataTables/datatables.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="{{url('css/datetable.css')}}">
    <style>
        .select2-selection--single {
            height: 2.50rem !important;
            border-color: lightgrey !important;
        }

        .select2-selection__rendered {
            padding: 0 !important;
        }

        .custom-file-label::after {
            content: "Buscar";
        }

        a.archivos {
            text-decoration: underline;
        }

        .table {
            max-width: 3000px;
        }
    </style>
@stop
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>

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
            $('.lineas-inputs').hide();
            let rutaActual = window.location.pathname;
            let rutaExcluir = "/contratos/telefonia/crear";
            if (rutaActual !== rutaExcluir) {
                $(".clientes").val({{ $contrato->cliente->id ?? old('cliente_id') }}).trigger("change");
            }

            let products = [];
            let lineas = [];

            $('#addproducto').click(function () {
                let productoText = $('#producto_id option:selected').text();
                let productoValue = $('#producto_id').val();

                if (productoValue !== "") {
                    let newRow = $('<tr></tr>');
                    let newIdCell = $('<td></td>').text(productoValue);
                    let newProductoCell = $('<td></td>').text(productoText);
                    let newAccionesCell = $('<td></td>');
                    let accionesLink = $('<a></a>').addClass('text-danger').html('<i class="fas fa-trash-alt"></i>');

                    accionesLink.click(function () {
                        $(this).closest('tr').remove();
                        let rowIndex = $(this).closest('tr').index();
                        productos.splice(rowIndex, 1);
                        updateProductosInput();
                    });

                    newAccionesCell.append(accionesLink);
                    newRow.append(newIdCell);
                    newRow.append(newProductoCell);
                    newRow.append(newAccionesCell);
                    $('#productos tbody').append(newRow);
                    console.log(products)
                    products.push(parseInt(productoValue));
                    updateProductosInput();

                    $('.table').removeClass('d-none');
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'No se ha seleccionado ningún producto',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });

            function updateProductosInput() {
                let arrayString = JSON.stringify(products);
                $('#productosCreados').val(arrayString);
            }

            $('#addlinea').click(function () {
                $('.lineas-inputs').show();
            });

            $('#savelinea').click(function () {

                var linea_dni = $('#linea_dni').val();
                var linea_numero = $('#linea_numero').val();
                var linea_icc = $('#linea_icc').val();

                var errors = {};

                if (!(/^\d{8}[a-zA-Z]$/.test(linea_dni))) {
                    errors.linea_dni = 'El DNI debe ser un número de 8 dígitos y una letra.';
                }

                if (!(/^(?:\+?(?:[0-9] ?){6,14}[0-9]|[0-9] ?(?:[0-9] ?){5,13}[0-9])$/.test(linea_numero))) {
                    errors.linea_numero = 'El teléfono debe ser un número valido.';
                }

                if (!(/^\d{19}$/.test(linea_icc))) {
                    errors.linea_icc = 'El ICC de teléfono debe ser un número de 19 dígitos.';
                }

                if (Object.keys(errors).length > 0) {
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $('#' + key).addClass('is-invalid');
                            $('#' + key + '-error').text(errors[key]);
                        }
                    }
                } else {
                    let productoText = $('#lineas_id option:selected').text();
                    let productoValue = $('#lineas_id').val();
                    let nuevaLinea = {
                        productoValue: productoValue,
                        tipo: 'linea',
                        clase: $('#clase option:selected').val(),
                        numero: $('#linea_numero').val(),
                        nombre_titular: $('#linea_nombre').val(),
                        dni: $('#linea_dni').val(),
                        operador_donante: $('#linea_operador').val(),
                        icc: $('#linea_icc').val(),
                        principal: $('.principal:checked').val(),
                    };

                    $('#linea_numero, #linea_nombre, #linea_dni, #linea_comercializadora, #linea_operador, #linea_icc').val('');
                    $('.principal').prop('checked', false);
                    $('.lineas-inputs').hide();

                    let principal = nuevaLinea.principal == 1 ? 'Si' : 'No';

                    if (productoValue !== "") {
                        let newRow = $('<tr></tr>');
                        let newIdCell = $('<td></td>').text(productoValue);
                        let newProductoCell = $('<td></td>').text(productoText);
                        let newNumeroCell = $('<td></td>').text(nuevaLinea.numero);
                        let newNombreTitularCell = $('<td></td>').text(nuevaLinea.nombre_titular);
                        let newIcc = $('<td></td>').text(nuevaLinea.icc);
                        let newClase = $('<td></td>').text(nuevaLinea.clase);
                        let newPrincipal = $('<td></td>').text(principal);
                        let newAccionesCell = $('<td></td>');
                        let accionesLink = $('<a></a>').addClass('text-danger').html('<i class="fas fa-trash-alt"></i>');

                        accionesLink.click(function () {
                            $(this).closest('tr').remove();
                            let rowIndex = $(this).closest('tr').index();
                            lineas.splice(rowIndex, 1);
                            updateLineasInput();
                        });

                        newAccionesCell.append(accionesLink);
                        newRow.append(newIdCell);
                        newRow.append(newProductoCell);
                        newRow.append(newNumeroCell);
                        newRow.append(newClase);
                        newRow.append(newNombreTitularCell);
                        newRow.append(newIcc);
                        newRow.append(newPrincipal);
                        newRow.append(newAccionesCell);
                        $('.tabledos tbody').append(newRow);

                        lineas.push(nuevaLinea);
                        updateLineasInput();

                        $('.tabledos').removeClass('d-none');
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se ha seleccionado ningún producto',
                            icon: 'error',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });


            function updateLineasInput() {
                let arrayString = JSON.stringify(lineas);
                $('#lineasCreados').val(arrayString);
            }

            function eliminarFila(element) {
                $(element).closest('tr').remove();
                let rowIndex = $(this).closest('tr').index();
                lineas.splice(rowIndex, 1);
                updateLineasInput();
            }

            $('#comercializadora_id').change(function () {
                $('#productos tbody').empty();
            });

            function actualizarSelectProductos() {
                let comercializadora = $('#comercializadora_id').val();
                if (comercializadora !== "") {
                    $.ajax({
                        url: "/datos/comercializadora/productos",
                        method: "GET",
                        data: {comercializadora_id: comercializadora},
                        success: function (data) {
                            let selectProductos = $('#producto_id');
                            let selectLineas = $('#lineas_id');
                            selectProductos.empty();
                            selectLineas.empty();
                            let tipo = 'Telefonía';

                            if (data.length !== 0) {
                                $('#mensajeErrorComercializadora').remove();
                                productos = data;
                                selectProductos.append($('<option>').val('').text('Selecciona el producto'));
                                selectLineas.append($('<option>').val('').text('Selecciona la línea'));

                                $.each(productos, function (index, opcion) {
                                    if (tipo === opcion.tipo) {
                                        if (opcion.linea !== null) {
                                            let nuevaOpcion = $('<option>').val(opcion.id).text(opcion.nombre);
                                            selectLineas.append(nuevaOpcion);
                                        } else {
                                            let nuevaOpcion = $('<option>').val(opcion.id).text(opcion.nombre);
                                            selectProductos.append(nuevaOpcion);
                                        }
                                    }
                                });
                            } else {
                                $('#mensajeErrorComercializadora').remove();
                                selectProductos.after($('<p class="small text-danger" id="mensajeErrorComercializadora">').text('Ese proveedor no tiene productos'));
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

            $('#comercializadora_id').on('change', function (event) {
                event.preventDefault();
                actualizarSelectProductos();
            });
        });
    </script>
    <script src="{{url('DataTables/datatables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
    <script src="{{url('js/filename.js')}}"></script>
    <script src="{{ asset('/select2/select2.min.js') }}"></script>
    <script src="{{ asset('select2/es.js') }}"></script>
    <script src="{{ asset('js/select2Personalizados.js') }}"></script>
@stop
