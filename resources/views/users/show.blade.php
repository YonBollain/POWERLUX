@extends('adminlte::page')

@section('title', 'Agentes')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Mostrar agente</h1>
        <a href="{{url('/comerciales')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Datos personales</h5>
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
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                           placeholder="Nombre" value="{{$usuario->name}}" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="apellidos" class="form-label">Apellidos</label>
                                    <input type="text" name="lastname" class="form-control form-control" id="apellidos"
                                           placeholder="Apellidos" value="{{$usuario->lastname}}" disabled>
                                </div>
                                <div class="form-group col-12">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" name="dni" class="form-control form-control" id="dni"
                                           placeholder="DNI" value="{{$usuario->dni}}" disabled>
                                </div>
                                <div class="form-group col-12 ">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control form-control" id="email"
                                           placeholder="Email" value="{{$usuario->email}}" disabled>
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
                                <div class="form-group col-12 ">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" name="address" class="form-control form-control" id="direccion"
                                           placeholder="Dirección" value="{{$usuario->address}}" disabled>

                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="provincia" class="form-label">Provincia</label>
                                    <input type="text" name="province" class="form-control form-control" id="provincia"
                                           placeholder="Provincia" value="{{$usuario->province}}" disabled>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="ciudad" class="form-label">Ciudad</label>
                                    <input type="text" name="city" class="form-control form-control" id="ciudad"
                                           placeholder="Ciudad" value="{{$usuario->city}}" disabled>
                                </div>
                                <div class="form-group col-12 ">
                                    <label for="cp" class="form-label">Código postal</label>
                                    <input type="text" name="cp" class="form-control form-control" id="cp"
                                           placeholder="Código Postal" value="{{$usuario->cp}}" disabled>

                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="nombre_contacto" class="form-label">Nombre contacto</label>
                                    <input type="text" name="contact_name" class="form-control form-control" id="nombre_contacto"
                                           placeholder="Nombre de contacto" value="{{$usuario->contact_name}}" disabled>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="contacto" class="form-label">Teléfono</label>
                                    <input type="text" name="contact_number" class="form-control form-control" id="contacto"
                                           placeholder="Teléfono de contacto" value="{{$usuario->contact_number}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header bg-olive">
                        <h5 class="text-bold card-title">Datos adicionales</h5>
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
                                    <label for="pago" class="form-label">Método de pago</label>
                                    <input type="text" name="payment_method" class="form-control form-control" id="pago"
                                           placeholder="Método de pago" value="{{$usuario->payment_method}}" disabled>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="irpf" class="form-label">IRPF</label>
                                    <input type="number" name="irpf" class="form-control " id="irpf"
                                           placeholder="IRPF" value="{{$usuario->irpf}}" disabled>
                                </div>
                                <div class="form-group col-12 ">
                                    <label for="iban" class="form-label">IBAN</label>
                                    <input type="text" name="iban" class="form-control form-control" id="iban"
                                           placeholder="IBAN" value="{{$usuario->iban}}" disabled>
                                </div>
                                <div class="form-group col-12 col-md-6 ">
                                    <label for="objetivos" class="form-label">Objetivos</label>
                                    <input type="text" name="objectives" class="form-control form-control" id="objetivos"
                                            value="{{$usuario->objectives}}" disabled>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="rol" class="form-label">Role</label>
                                    <input type="text" name="role" class="form-control form-control" id="role"
                                           value="{{$usuario->role}}" disabled>
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
