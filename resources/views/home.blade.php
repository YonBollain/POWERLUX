@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @yield('contenido')
                </div>
            </div>
        </div>
    </div>
@stop
