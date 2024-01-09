@extends('adminlte::page')

@section('title', 'Agentes')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Crear agente</h1>
        <a href="{{url('/comerciales')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop

@section('content')
            <form action="{{route('guardarcomercial')}}" method="POST" class="row" id="crear-comercial" novalidate>
                @csrf
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
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nombre" class="form-label">Nombre<span class="text-danger">*</span></label>
                                        <input type="text" name="nombre" class="form-control form-control" id="nombre"
                                               placeholder="Nombre" value="{{old('nombre')}}" required>
                                        @error('nombre')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="apellidos" class="form-label">Apellidos<span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" class="form-control form-control" id="apellidos"
                                               placeholder="Apellidos" value="{{old('lastname')}}" required>
                                        @error('lastname')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="dni" class="form-label">DNI<span class="text-danger">*</span></label>
                                        <input type="text" name="dni" class="form-control form-control" id="dni"
                                               placeholder="DNI" value="{{old('dni')}}" required>
                                        @error('dni')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control form-control" id="email"
                                               placeholder="Email" value="{{old('email')}}" required>
                                        @error('email')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="password">Contraseña<span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control form-control" id="password"
                                               placeholder="Contraseña" required>
                                        @error('password')
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
                                               placeholder="Dirección" value="{{old('address')}}" required>
                                        @error('address')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="provincia" class="form-label">Provincia<span class="text-danger">*</span></label>
                                        <input type="text" name="province" class="form-control form-control" id="provincia"
                                               placeholder="Provincia" value="{{old('province')}}" required>
                                        @error('province')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="ciudad" class="form-label">Ciudad<span class="text-danger">*</span></label>
                                        <input type="text" name="city" class="form-control form-control" id="ciudad"
                                               placeholder="Ciudad" value="{{old('city')}}" required>
                                        @error('city')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="cp" class="form-label">Código postal<span class="text-danger">*</span></label>
                                        <input type="text" name="cp" class="form-control form-control" id="cp"
                                               placeholder="Código Postal" value="{{old('cp')}}" required>
                                        @error('cp')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="nombre_contacto" class="form-label">Nombre contacto <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_name" class="form-control form-control" id="nombre_contacto"
                                               placeholder="Nombre de contacto" value="{{old('contact_name')}}" required>
                                        @error('contact_name')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="contacto" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                        <input type="text" name="contact_number" class="form-control form-control" id="contacto"
                                               placeholder="Teléfono de contacto" value="{{old('contact_number')}}" required>
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
                                               placeholder="Método de pago" value="{{old('payment_method')}}" required>
                                        @error('payment_method')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="irpf" class="form-label">IRPF<span class="text-danger">*</span></label>
                                        <input type="number" name="irpf" class="form-control " id="irpf"
                                               placeholder="IRPF" value="{{old('irpf')}}" required>
                                        @error('irpf')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 ">
                                        <label for="iban" class="form-label">IBAN <span class="text-danger">*</span></label>
                                        <input type="text" name="iban" class="form-control form-control" id="iban"
                                               placeholder="IBAN" value="{{old('iban')}}" required>
                                        @error('iban')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6 ">
                                        <label for="objetivos" class="form-label">Objetivos<span class="text-danger">*</span></label>
                                        <select name="objectives" class="form-control form-select " id="objetivos" required>
                                            <option value="0" selected>Selecciona objetivos</option>
                                            <option value="Gas">Gas</option>
                                            <option value="Luz">Luz</option>
                                            <option value="Telefonia">Telefonia</option>
                                        </select>
                                        @error('objetivos')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="rol" class="form-label">Permisos<span class="text-danger">*</span></label>
                                        <select name="role" class="form-control form-select " id="rol" required>
                                            <option value="0" selected>Selecciona un rol</option>
                                            <option value="Administrador" >Administrador</option>
                                            <option value="Agente">Agente</option>
                                            <option value="Subagente">Subagente</option>
                                        </select>
                                        @error('role')
                                        <div class="text-danger ">
                                            <p class="small m-0">*{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                    @if(Auth::user()->role == 'Administrador')
                                        <div class="form-group col-12 pb-3">
                                            {{ Form::label('agentes','Agente') }}
                                            <select
                                                class="form-control usuarios {{($errors->has('agente_id') ? ' is-invalid' : '')}}"
                                                name="agente_id"
                                                id="agente_id">
                                                <option value=""></option>
                                                @if($usuarios)
                                                    @foreach($usuarios as $usuario)
                                                        <option value="{{$usuario->id}}">{{$usuario->name}}
                                                            ({{$usuario->dni}})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            {!! $errors->first('usuarios', '<div class="invalid-feedback">:message</div>') !!}
                                            <span class="text-muted small">Selecciona un agente al que pertenezca un subagente (Solo para subagentes)</span>
                                        </div>

                                    @endif
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
    <link href="/select2/select2.min.css" rel="stylesheet"/>
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }

         #usuarios {
             width: 100%;
         }

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
@stop
