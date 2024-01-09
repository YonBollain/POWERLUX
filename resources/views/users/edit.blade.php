@extends('adminlte::page')

@section('title', 'Agentes')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Editar agente</h1>
        <a href="{{url('/comerciales')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
            <form action="{{url('/comerciales/edit/'.$usuario->id)}}" class="row" method="POST">
                @csrf
                @method('PUT')
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
                                        <label for="nombre" class="form-label">Nombre<span class="text-danger">*</span></label>
                                        <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                               placeholder="Nombre" value="{{$usuario->name}}">
                                        @error('nombre')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" class="form-control form-control" id="apellidos"
                                               placeholder="Apellidos" value="{{$usuario->lastname}}">
                                        @error('lastname')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="dni" class="form-label">DNI<span class="text-danger">*</span></label>
                                        <input type="text" name="dni" class="form-control form-control" id="dni"
                                               placeholder="DNI" value="{{$usuario->dni}}">
                                        @error('dni')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control form-control" id="email"
                                               placeholder="Email" value="{{$usuario->email}}">
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
                                <div class="box-body row">
                                    <div class="form-group col-12 ">
                                        <label for="direccion" class="form-label">Dirección<span class="text-danger">*</span></label>
                                        <input type="text" name="address" class="form-control form-control" id="direccion"
                                               placeholder="Dirección" value="{{$usuario->address}}">
                                        @error('address')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="provincia" class="form-label">Provincia<span class="text-danger">*</span></label>
                                        <input type="text" name="province" class="form-control form-control" id="provincia"
                                               placeholder="Provincia" value="{{$usuario->province}}">
                                        @error('province')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="ciudad" class="form-label">Ciudad<span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control form-control" id="ciudad"
                                               placeholder="Ciudad" value="{{$usuario->city}}">
                                        @error('city')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="cp" class="form-label">Código postal<span class="text-danger">*</span></label>
                                        <input type="text" name="cp" class="form-control form-control" id="cp"
                                               placeholder="Código Postal" value="{{$usuario->cp}}">
                                        @error('cp')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nombre_contacto" class="form-label">Nombre contacto<span class="text-danger">*</span></label>
                                        <input type="text" name="contact_name" class="form-control form-control" id="nombre_contacto"
                                               placeholder="Nombre de contacto" value="{{$usuario->contact_name}}">
                                        @error('contact_name')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="contacto" class="form-label">Teléfono<span class="text-danger">*</span></label>
                                        <input type="text" name="contact_number" class="form-control form-control" id="contacto"
                                               placeholder="Teléfono de contacto" value="{{$usuario->contact_number}}">
                                        @error('contact_number')
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
                                        <label for="pago" class="form-label">Método de pago<span class="text-danger">*</span></label>
                                        <input type="text" name="payment_method" class="form-control form-control" id="pago"
                                               placeholder="Método de pago" value="{{$usuario->payment_method}}">
                                        @error('payment_method')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="irpf" class="form-label">IRPF<span class="text-danger">*</span></label>
                                        <input type="number" name="irpf" class="form-control " id="irpf"
                                               placeholder="IRPF" value="{{$usuario->irpf}}">
                                        @error('irpf')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="iban" class="form-label">IBAN<span class="text-danger">*</span></label>
                                        <input type="text" name="iban" class="form-control form-control" id="iban"
                                               placeholder="IBAN" value="{{$usuario->iban}}">
                                        @error('iban')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6 ">
                                        <label for="objetivos" class="form-label">Objetivos<span class="text-danger">*</span></label>
                                        <select name="objectives" class="form-control form-select " id="objetivos">
                                            <option value="0" selected>Selecciona objetivos</option>
                                            <option value="Gas" @if(old('objectives', $usuario->objectives) === 'Gas') selected @endif>Gas</option>
                                            <option value="Luz" @if(old('objectives', $usuario->objectives) === 'Luz') selected @endif>Luz</option>
                                            <option value="Telefonia" @if(old('objectives', $usuario->objectives) === 'Telefonia') selected @endif>Telefonía</option>
                                        </select>
                                        @error('objetivos')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="rol" class="form-label">Role<span class="text-danger">*</span></label>
                                        <select name="role" class="form-control form-select " id="rol">
                                            <option value="0">Selecciona un rol</option>
                                            <option value="Administrador" @if(old('role', $usuario->role) === 'Administrador') selected @endif >Administrador</option>
                                            <option value="Agente" @if(old('role', $usuario->role) === 'Agente') selected @endif>Agente</option>
                                            <option value="Subagente" @if(old('role', $usuario->role) === 'Subagente') selected @endif>Subagente</option>
                                        </select>
                                        @error('role')
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
                <div class="col-12 mb-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-success btn-lg "><i class="fas fa-user"></i>
                        Crear usuario
                    </button>
                </div>
            </form>
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
