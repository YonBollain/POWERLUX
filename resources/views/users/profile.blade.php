@extends('adminlte::page')

@section('title', 'Agentes')

@section('content_header')
    <h1 class="text-olive">Perfil {{$usuario->name}} {{$usuario->lastname}}</h1>
@stop

@section('content')
    @include('flash-message')
    <div class="row">
        <div class="col-12 col-md-6 ">
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
                        <div class="box-body ">
                            <form action="{{route('updateUser',$usuario->id)}}" method="POST" class="row">
                                @csrf
                                @method('PUT')
                                <div class="form-group col-12 ">
                                    <label for="email" class="form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control form-control" id="email"
                                           placeholder="Email" value="{{$usuario->email}}" required>
                                    @error('email')
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
                                <div class="form-group col-12 ">
                                    <label for="direccion" class="form-label">Dirección<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control form-control" id="direccion"
                                           placeholder="Dirección" value="{{$usuario->address}}">
                                    @error('address')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="provincia" class="form-label">Provincia<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="province" class="form-control form-control" id="provincia"
                                           placeholder="Provincia" value="{{$usuario->province}}">
                                    @error('province')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="ciudad" class="form-label">Ciudad<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="city" class="form-control form-control" id="ciudad"
                                           placeholder="Ciudad" value="{{$usuario->city}}">
                                    @error('city')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="cp" class="form-label">Código postal<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="cp" class="form-control form-control" id="cp"
                                           placeholder="Código Postal" value="{{$usuario->cp}}">
                                    @error('cp')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="nombre_contacto" class="form-label">Nombre contacto<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="contact_name" class="form-control form-control"
                                           id="nombre_contacto"
                                           placeholder="Nombre de contacto" value="{{$usuario->contact_name}}">
                                    @error('contact_name')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="contacto" class="form-label">Teléfono<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="contact_number" class="form-control form-control"
                                           id="contacto"
                                           placeholder="Teléfono de contacto" value="{{$usuario->contact_number}}">
                                    @error('contact_number')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-success">Cambiar datos</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-12 col-md-6">
            <div class="card card-default">
                <div class="card-header bg-olive">
                    <h5 class="text-bold card-title">Contraseña</h5>
                    <div class="card-tools ">
                        <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="box box-info padding-1">
                        <div class="box-body">
                            <form action="{{route('updatePassword')}}" method="POST" class="row">
                                @csrf
                                <div class="form-group col-12">
                                    <label for="oldPassword" class="form-label">Contraseña anterior<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="old_password" class="form-control form-control"
                                           id="oldPassword"
                                           placeholder="Contraseña anterior" value="">
                                    @error('oldpassword')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="newPassword" class="form-label">Contraseña nueva<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="new_password" class="form-control form-control"
                                           id="newPassword"
                                           placeholder="Contraseña nueva" value="">
                                    @error('newPassword')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="confirmNewPassword" class="form-label">Confirmar contraseña nueva<span
                                            class="text-danger">*</span></label>
                                    <input type="password" name="new_password_confirmation" class="form-control form-control"
                                           id="confirmNewPassword"
                                           placeholder="Confirmar nueva contraseña" value="">
                                    @error('newPassword')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-success">Cambiar contraseña</button>
                                </div>
                            </form>
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
