@extends('adminlte::page')

@section('title', 'Liquidaciones')
@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Mostrar liquidación</h1>
        <a href="{{url('/liquidaciones')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop
@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Número de factura</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body ">
                                @include('flash-message')
                                <form method="POST" action="{{ route('liquidacion.updateFactura', $liquidacione->id) }}"
                                      class="row" role="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group col-12">
                                        {{ Form::label('numero_factura','Número Factura') }}<span
                                            class="text-danger">*</span>
                                        <div class="input-group">
                                            @if($liquidacione->numero_factura == null ||$liquidacione->numero_factura == ''||Auth::user()->role == 'Administrador')
                                                {{ Form::text('numero_factura', $liquidacione->numero_factura, ['class' => 'form-control' . ($errors->has('numero_factura') ? ' is-invalid' : ''), 'placeholder' => 'Número de factura']) }}
                                                <button class="btn btn-outline-success ">Guardar</button>
                                            @else
                                                {{ Form::text('numero_factura', $liquidacione->numero_factura, ['class' => 'form-control ' . ($errors->has('numero_factura') ? ' is-invalid' : ''), 'placeholder' => 'Número de factura','disabled'=>'disabled']) }}
                                                <button class="btn btn-outline-success disabled" disabled>Guardar
                                                </button>
                                            @endif
                                            {!! $errors->first('numero_factura', '<div class="invalid-feedback">:message</div>') !!}
                                        </div>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('liquidacion.update', $liquidacione->id) }}"
                                      class="row" role="form" onchange="submit()">
                                    @csrf
                                    @method('PUT')
                                    @if(Auth::user()->role == 'Administrador' && $liquidacione->numero_factura != null)
                                        <div class="form-group col-12">
                                            <label for="estado" class="form-label">Estado<span
                                                    class="text-danger">*</span></label>
                                            <select name="estado" class="form-control form-select " id="estado"
                                                    required>
                                                <option value="Pagado"
                                                        @if($liquidacione->estado=='Pagado') selected @endif>Pagado
                                                </option>
                                                <option value="Pendiente"
                                                        @if($liquidacione->estado=='Pendiente')selected @endif>
                                                    Pendiente
                                                </option>
                                            </select>
                                            @error('tipo')
                                            <div class="text-danger ">
                                                <p class="small m-0">*{{$message}}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Contratos</h5>
                        <div class="card-tools ">
                            <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus text-white"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="box box-info padding-1">
                            <div class="box-body ">
                                <div class="table-responsive ">
                                    <table id="contratos" class="table table-striped" style="width:100%">
                                        <thead class="table-white" style="color: #424949;">
                                        <tr>
                                            <th style="width: 2%">Nº</th>
                                            <th style="width: 12%">Cliente</th>
                                            <th style="width: 5%">DNI/CIF</th>
                                            <th style="width: 5%">Fecha</th>
                                            <th style="width: 5%">Fecha Fin</th>
                                            <th style="width: 5%">Comisión</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($contratos as $contrato)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('contratos.show',$contrato->id)}}">Contrato
                                                        #{{ $contrato->id}}</a>
                                                </td>
                                                <td>{{ $contrato->cliente->nombre }}</td>
                                                <td>{{ $contrato->cliente->dni_cif }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrato->fecha_incio)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrato->fecha_fin)->format('d/m/Y') }}</td>
                                                @php
                                                    $importe = $contrato->precio_producto * $contrato->comision / 100;
                                                    $importeContratos = $importe;
                                                    $cuotaIVAContratos = $importe * $contrato->iva / 100;
                                                    $cuotaIRPFContratos = $importe * $contrato->user->irpf / 100;
                                                    $total = $importeContratos +$cuotaIVAContratos - $cuotaIRPFContratos;
                                                @endphp
                                                <td>{{number_format($total,2)}} €</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($contratosTel as $contrato)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('contratotelefono.show',$contrato->id)}}">Contrato
                                                        Tel #{{ $contrato->id}}</a>
                                                </td>
                                                <td>{{ $contrato->cliente->nombre }}</td>
                                                <td>{{ $contrato->cliente->dni_cif }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrato->fecha_incio)->format('d/m/Y') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($contrato->fecha_fin)->format('d/m/Y') }}</td>
                                            @php
                                                foreach ($contratosTel as $contratoTel){
                                                    $productosContrato = \App\Models\Producto_contrato::where('contrato_id',$contratoTel->id)->get();
                                                     $importeContratosTel =0;
                                                     $cuotaIVAContratosTel = 0;
                                                     $cuotaIRPFTel = 0;
                                                        foreach ($productosContrato as $productoContrato){
                                                            $producto= \App\Models\Producto::find($productoContrato->producto_id);
                                                            $comision = \App\Models\Comision::where('producto_id',$productoContrato->producto_id)
                                                                    ->where('user_id',$contratoTel->user->id)
                                                                    ->first();
                                                            if($comision==null){
                                                                $comision = 0;
                                                            }else{
                                                             $comision = $comision->comision;
                                                            }
                                                            $importe= $producto->precio * $comision / 100; ;
                                                            $importeContratosTel += $importe;
                                                            $cuotaIVAContratosTel += $importe * $producto->tipo_iva / 100;
                                                            $cuotaIRPFTel += $importe * $contratoTel->user->irpf / 100;
                                                            }
                                                        $importeTotal =  $importeContratosTel + $cuotaIVAContratosTel - $cuotaIRPFTel;
                                                        }
                                            @endphp
                                            <td>{{number_format($importeTotal,2)}}€</td>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::user()->role == 'Administrador')
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header bg-olive">
                            <h5 class="text-bold card-title">Borrar liquidación</h5>
                            <div class="card-tools ">
                                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse"
                                        title="Collapse">
                                    <i class="fas fa-minus text-white"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="box box-info padding-1">
                                <div class="box-body ">
                                    <form method="POST"
                                          action="{{ route('liquidacion.delete', $liquidacione->id) }}"
                                          class="row" role="form">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger">Eliminar liquidación</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
