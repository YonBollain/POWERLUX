@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Mostrar contrato</h1>
        <a onclick="function goBack() {
            window.history.back();
        }
        goBack()" class="btn btn-outline-danger">Volver</a>

    </div>
@stop
@section('content')
    @include('flash-message')
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
                        <div class="box-body row">
                            <div class="form-group col-12">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" id="nombre" class="form-control" disabled
                                       value="{{$contrato->cliente->nombre}}">
                            </div>
                            <div class="form-group col-12">
                                <label for="dni" class="form-label">DNI/CIF/NIE:</label>
                                <input type="text" id="dni" class="form-control" disabled
                                       value="{{$contrato->cliente->dni_cif}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="dni" class="form-label">Email:</label>
                                <input type="text" id="email" class="form-control" disabled
                                       value="@if($contrato->email == null){{$contrato->cliente->email}} @else {{$contrato->email}} @endif">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="movil" class="form-label">Movil:</label>
                                <input type="text" id="email" class="form-control" disabled
                                       value="@if($contrato->movil == null){{$contrato->cliente->movil}} @else {{$contrato->movil}} @endif">
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
                                <label for="direccion" class="form-label">Direccion:</label>
                                <input type="text" id="direccion" class="form-control" disabled
                                       value="{{$contrato->direccion}}">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="poblacion" class="form-label">Poblacion:</label>
                                <input type="text" id="poblacion" class="form-control" disabled
                                       value="{{$contrato->poblacion}}">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="cp" class="form-label">Código postal:</label>
                                <input type="text" id="cp" class="form-control" disabled value="{{$contrato->cp}}">
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <label for="provincia" class="form-label">Provincia:</label>
                                <input type="text" id="provincia" class="form-control" disabled
                                       value="{{$contrato->provincia}}">
                            </div>
                            <div class="form-group col-12 ">
                                <label for="cups" class="form-label">CUPS:</label>
                                <input type="text" id="cups" class="form-control" disabled value="{{$contrato->cups}}">
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
                                <label for="fechaI" class="form-label">Fecha incio:</label>
                                <input type="text" id="fechaI" class="form-control" disabled
                                       value="{{$contrato->fecha_incio}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="fechaF" class="form-label">Fecha fin:</label>
                                <input type="text" id="fechaF" class="form-control" disabled
                                       value="{{$contrato->fecha_fin}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="tipo" class="form-label">Tipo de contrato:</label>
                                <input type="text" id="tipo" class="form-control" disabled
                                       value="{{$contrato->tipo_contrato}}">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="comercializadora" class="form-label">Comercializadora:</label>
                                <input type="text" id="comercializadora" class="form-control" disabled
                                       value="{{$contrato->comercializadora->nombre}}">
                            </div>
                            <div class="form-group col-12 ">
                                <label for="producto" class="form-label">Producto:</label>
                                <input type="text" id="producto" class="form-control" disabled
                                       value="{{$contrato->producto->nombre}}">
                            </div>
                            @if(Auth::user()->role =='Administrador')
                            <div class="form-group col-12 col-md-6">
                                <label for="producto_precio" class="form-label">Precio producto:</label>
                                <input type="text" id="producto_precio" class="form-control" disabled
                                       value="{{$contrato->precio_producto}}">
                            </div>
                            @endif
                            <div class="form-group col-12 col-md-6">
                                <label for="iva" class="form-label">IVA:</label>
                                <input type="text" id="iva" class="form-control" disabled
                                       value="{{$contrato->iva}}%">
                            </div>
                            <div class="form-group col-12 ">
                                <label for="estado" class="form-label">Estado:</label>
                                <input type="text" id="estado" class="form-control" disabled
                                       value="{{$contrato->estado}}">
                            </div>
                            <div class="form-group col-12 ">
                                <label for="comentarios" class="form-label">Notas:</label>
                                <textarea id="comentarios" class="form-control" style="resize: none"
                                          disabled> {{$contrato->comentarios}}</textarea>
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="agente" class="form-label">Agente:</label>
                                <input type="text" id="agente" class="form-control" disabled
                                       value=" {{ $contrato->user->name }}">
                            </div>
                            @if(Auth::user()->role== 'Administrador')
                            <div class="form-group col-12 col-md-6">
                                <label for="comision" class="form-label">Comisión:</label>
                                <input type="text" id="comision" class="form-control" disabled
                                       value=" {{ $contrato->comision }}%">
                            </div>
                            @endif
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
                            <div class="form-group col-12 ">
                                <label for="titular" class="form-label">Titular de la cuenta:</label>
                                <input type="text" id="titular" class="form-control" disabled
                                       value="{{$contrato->titular_banco}}">
                            </div>
                            <div class="form-group col-12 6">
                                <label for="iban" class="form-label">IBAN:</label>
                                <input type="text" id="iban" class="form-control" disabled value="{{$contrato->iban}}">
                            </div>
                            <div class="form-group col-12 pt-2">
                                <label for="iban" class="form-label">Factura Online:</label>
                                {{$contrato->factura_online}}
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
                               <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_dni)) }}"
                                  class="btn @if($contrato->documento_dni !=null)btn-outline-success @else btn-outline-dark disabled @endif  w-100 ">Descargar DNI</a>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_cif)) }}"
                                   class="btn @if($contrato->documento_cif != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">Descargar CIF</a>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_factura)) }}"
                                   class="btn @if($contrato->documento_factura != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">Descargar Factura</a>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_escritura)) }}"
                                   class="btn  @if($contrato->documento_escritura != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">Descargar Escritura</a>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <a href="{{url('/descargar-archivo/'.$contrato->cliente->id.'/'.$contrato->id.'/'.basename($contrato->documento_cie)) }}"
                                   class="btn  @if($contrato->documento_cie != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">Descargar CIE</a>
                            </div>
                            <div class="form-group col-12 col-md-4">
                                <a href="{{url('/descargar-archivo-json/'.$contrato->id.'/suministros')}}" class="btn  @if($contrato->documentos != null)btn-outline-success @else btn-outline-dark disabled @endif w-100">
                                    Descargar documentos adicionales
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
