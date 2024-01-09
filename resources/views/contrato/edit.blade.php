@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1 class="text-olive">Editar contrato</h1>
        <a href="{{url('/contratos')}}" class="btn btn-outline-danger">Volver</a>
    </div>
@stop
@section('content')
    <section class="content container-fluid">
                        <form method="POST" action="{{ route('contratos.update', $contrato->id) }}" class="row"  role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('contrato.form')
                            <div class="col-12 pb-4 d-flex justify-content-md-center">
                                <button type="submit" class="btn btn-outline-success btn-lg col-12 col-md-4 ">Editar</button>
                            </div>
                        </form>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('input[type="file"]').change(function(e) {
                var fileName = e.target.files[0].name;
                $('#documentos-label').html(fileName);
            });
        });
    </script>
@stop
