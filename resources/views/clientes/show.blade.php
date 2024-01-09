@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Mostrar cliente</h1>
        <a href="{{url('/clientes')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
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
                                <label for="tipo" class="form-label">Tipo de cliente <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nombre" class="form-control " id="nombre"
                                       placeholder="Nombre" value="{{$cliente->tipo}}" disabled>
                                @error('tipo')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre completo / Razón social <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="nombre" class="form-control " id="nombre"
                                       placeholder="Nombre" value="{{$cliente->nombre}}" disabled>
                                @error('nombre')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="dni_cif" class="form-label">DNI / NIE / CIF <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="dni_cif" class="form-control " id="dni_cif"
                                       placeholder="Documento de identificación" value="{{$cliente->dni_cif}}"
                                       disabled>
                                @error('dni_cif')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="representante" class="form-label">Representante legal <span
                                        class="text-muted small">(Solo para empresas)</span> </label>
                                <input type="text" name="representante" class="form-control " id="representante"
                                       placeholder="Representante legal" value="{{$cliente->representante}}" disabled>
                                @error('representante')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control " id="email"
                                       placeholder="Email" value="{{$cliente->email}}" disabled>
                                @error('email')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
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
                        <div class="box-body">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Dirección <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="direccion" class="form-control " id="direccion"
                                       placeholder="Dirección" value="{{$cliente->direccion}}" disabled>
                                @error('direccion')
                                <div class="text-danger">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="provincia" class="form-label">Provincia <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="provincia" class="form-control " id="provincia"
                                       placeholder="Provincia" value="{{$cliente->provincia}}" disabled>
                                @error('provincia')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-6 ">
                                    <label for="ciudad" class="form-label">Ciudad <span class="text-danger">*</span></label>
                                    <input type="text" name="poblacion" class="form-control " id="ciudad"
                                           placeholder="Ciudad" value="{{$cliente->poblacion}}" disabled>
                                    @error('poblacion')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label for="cp" class="form-label">Código postal <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="cp" class="form-control " id="cp"
                                           placeholder="Codigo postal" value="{{$cliente->cp}}" disabled>
                                    @error('cp')
                                    <div class="text-danger">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-4 ">
                                    <label for="movil" class="form-label">Móvil <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="movil" class="form-control " id="movil"
                                           placeholder="Móvil" value="{{$cliente->movil}}" disabled>
                                    @error('movil')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-4 ">
                                    <label for="telefono1" class="form-label">Teléfono 1 <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="telefono1" class="form-control " id="telefono_1"
                                           placeholder="Teléfono 1" value="{{$cliente->telefono1}}"disabled>
                                    @error('telefono1')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-4 ">
                                    <label for="telefono2" class="form-label">Teléfono 2</label>
                                    <input type="tel" name="telefono2" class="form-control " id="telefono2"
                                           placeholder="Teléfono 2" value="{{$cliente->telefono2}}" disabled>
                                    @error('telefono2')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-md-6 ">
                                    <label for="contacto" class="form-label">Contacto <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="contacto" class="form-control " id="contacto"
                                           placeholder="Contacto" value="{{$cliente->contacto}}" disabled>
                                    @error('contacto')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="tel_contacto" class="form-label">Teléfono contacto <span
                                            class="text-danger">*</span></label>
                                    <input type="tel" name="tel_contacto" class="form-control" id="tel_contacto"
                                           placeholder="Teléfono contacto" value="{{$cliente->tel_contacto}}" disabled>
                                    @error('tel_contacto')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
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
                    <h5 class="text-bold card-title">Datos bancarios</h5>
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
                                <label for="iban" class="form-label">IBAN <span class="text-danger">*</span></label>
                                <input type="text" name="iban" class="form-control" id="iban"
                                       placeholder="IBAN" value="{{$cliente->iban}}" disabled>
                                @error('iban')
                                <div class="text-danger ">
                                    <p class="small m-0">*{{$message}}</p>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header bg-olive">
                    <h5 class="text-bold card-title">Información adicional</h5>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box box-info padding-1">
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-12 col-md-6 ">
                                    <label for="notas" class="form-label">Notas</label>
                                    <textarea name="notas" id="notas" class="form-control" cols="30" rows="5" disabled>{{$cliente->notas}}</textarea>
                                    @error('notas')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label for="actividad" class="form-label">Actividad</label>
                                    <textarea name="actividad" id="actividad" class="form-control" disabled cols="30"
                                              rows="5">{{$cliente->actividad}}</textarea>
                                    @error('actividad')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }
    </style>

@stop

@section('js')

@stop
