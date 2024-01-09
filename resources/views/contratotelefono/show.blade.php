@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Ver contrato de telefonía</h1>
        <a onclick="function goBack() {
            window.history.back();
        }
        goBack()" class="btn btn-outline-danger">Volver</a>
    </div>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="row">
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
                                    {{ Form::label('cliente','Cliente') }}
                                    {{ Form::text('Cliente', $contrato->cliente->nombre, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('movil','Móvil') }}
                                    {{ Form::text('movil', $contrato->movil, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('email') }}
                                    {{ Form::text('email', $contrato->email, ['class' => 'form-control','disabled'=>'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Datos de la propiedad</h5>
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
                                    {{ Form::text('direccion', $contrato->direccion, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12 ">
                                    {{ Form::label('poblacion','Población') }}<span class="text-danger">*</span>
                                    {{ Form::text('poblacion', $contrato->poblacion, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    {{ Form::label('cp','Código postal') }}<span class="text-danger">*</span>
                                    {{ Form::text('cp', $contrato->cp, ['class' => 'form-control' ,'disabled'=>'disabled']) }}

                                </div>
                                <div class="form-group col-12 col-md-6">
                                    {{ Form::label('provincia') }}<span class="text-danger">*</span>
                                    {{ Form::text('provincia', $contrato->provincia, ['class' => 'form-control','disabled'=>'disabled']) }}
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
                                <div class="form-group col-12 col-md-6">
                                    {{ Form::label('fecha_incio','Fecha inicio') }}<span class="text-danger">*</span>
                                    {{ Form::date('fecha_incio', $contrato->fecha_inicio, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>

                                <div class="form-group col-12 col-md-6">
                                    {{ Form::label('fecha_fin','Fecha fin') }}<span class="text-danger">*</span>
                                    {{ Form::date('fecha_fin', $contrato->fecha_fin, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    {{ Form::label('comercializadora_id','Comercializadora') }}<span
                                        class="text-danger">*</span>
                                    {{ Form::text('comercializadora_id', $contrato->comercializadora->nombre, ['class' => 'form-control ' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12">
                                    {{ Form::label('estado') }}<span class="text-danger">*</span>
                                    {{ Form::text('estado',$contrato->estado, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    {{ Form::label('user_id','Agente') }}<span class="text-danger">*</span>
                                    {{ Form::text('user_id',$contrato->user->name, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12">
                                    {{ Form::label('comentarios','Nota') }}
                                    {{ Form::textarea('comentarios', $contrato->comentarios, ['class' => 'form-control' ,'disabled'=>'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Productos</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body row align-items-end">
                                <div class="form-group col-12 table">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="productos" class="table table-striped m-0 w-100"
                                                       style="width:100%">
                                                    <thead class="table-white" style="color: #424949;">
                                                    <tr>
                                                        <th style="width: 10%">ID</th>
                                                        <th style="width: 80%">Producto</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($productos as $product)
                                                            <tr>
                                                            @php($produ = \App\Models\Producto::where('id',$product->producto_id)->get())
                                                            <td>{{$product->producto_id}}</td>
                                                            <td>{{$produ[0]->nombre}}</td>
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
                        <h5 class="text-bold card-title">Lineas</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body row align-items-end">
                                <div class="form-group col-12 tabledos " id="table">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="linea" class="table table-striped m-0 w-100 "
                                                       style="width:100%;overflow-x: scroll;">
                                                    <thead class="table-white" style="color: #424949;">
                                                    <tr>
                                                        <th style="width: 2%">ID</th>
                                                        <th style="width: 5%">Producto</th>
                                                        <th style="width: 8%">Clase</th>
                                                        <th style="width: 10%">Numero</th>
                                                        <th style="width: 20%">Nombre</th>
                                                        <th style="width: 25%">ICC</th>
                                                        <th style="width: 5%">Principal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lineas as $linea)
                                                        <tr>
                                                            @php($prod = \App\Models\Producto::where('id',$linea->producto_id)->get())
                                                            <td>{{$linea->producto_id}}</td>
                                                            <td>{{$prod[0]->nombre}}</td>
                                                            <td>{{$linea->clase}}</td>
                                                            <td>{{$linea->numero}}</td>
                                                            <td>{{$linea->nombre_titular}}</td>
                                                            <td>{{$linea->icc}}</td>
                                                            <td>@if($linea->linea_principal == 1)Si @else No @endif</td>
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
                                    {{ Form::text('iban', $contrato->iban, ['class' => 'form-control','disabled'=>'disabled']) }}
                                </div>
                                <div class="form-group col-12">
                                    {{ Form::label('factura', 'Factura online') }}<span class="text-danger">*</span>
                                    {{ Form::text('iban', $contrato->factura_online, ['class' => 'form-control','disabled'=>'disabled']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Documentos</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body row">
                                <div class="form-group col-12 col-md-4 ">
                                    <a href="{{url('/descargar-archivo-telefonico/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_dni)) }}"
                                       class="btn @if($contrato->documento_dni !=null)btn-outline-success @else btn-outline-dark disabled @endif  w-100 ">Descargar DNI</a>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <a href="{{url('/descargar-archivo-telefonico/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_factura)) }}"
                                       class="btn @if($contrato->documento_factura != null) btn-outline-success @else btn-outline-dark disabled @endif w-100">Descargar CIF</a>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <a href="{{url('/descargar-archivo-telefonico/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_cerficado)) }}"
                                       class="btn @if($contrato->documento_cerficado != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">Descargar Factura</a>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <a href="{{url('/descargar-archivo-json/'.$contrato->id.'/telefonico')}}" class="btn  @if($contrato->documentos != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">
                                        Descargar documentos adicionales
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

