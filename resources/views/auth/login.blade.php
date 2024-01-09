@section('title','Login')
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

@section('auth_body')
    <form action="{{ $login_url }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group mb-3 column">
            <div class="input-group-prepend" style="border: 1px solid #d7dbdd; border-radius: 4px;">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus
                   style="border: 1px solid #d7dbdd; border-radius: 2px 4px 4px 2px;">

            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <div class="input-group-prepend" style="border: 1px solid #d7dbdd; border-radius: 4px;">
                <span class="input-group-text"><i class="fas fa-unlock"></i></span>
            </div>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Contraseña" style="border: 1px solid #d7dbdd; border-radius: 2px 4px 4px 2px;">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Login field --}}
        <div  style="width: 100%;">
            <div >
                <button type=submit class="btn btn-primary btn-lg btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}" style="border-radius: 7px;">
                    <span>Iniciar</span>
                </button>
            </div>
        </div>
    </form>
@stop

@section('auth_footer')
    {{-- Password reset link
    @if($password_reset_url)
        <p class="my-0">
            <a href="{{ url('/forgot-password') }}">
                He olvidado mi contraseña
            </a>
        </p>
    @endif --}}
@stop
