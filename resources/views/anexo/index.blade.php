@extends('adminlte::page')

@section('title', 'Anexos')

@section('content_header')
    <h1 class="text-olive">Anexos</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(Auth::user()->role =='Administrador')
                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header bg-olive">
                            <h5 class="text-bold card-title">Crear anexo</h5>
                            <div class="card-tools ">
                                <button type="button" class="btn pt-0 pb-0 " data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus text-white"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('anexo.store') }}" class="row" role="form"
                                  enctype="multipart/form-data">
                            @csrf
                                <div class="form-group col-6">
                                    <label for="categoria" class="form-label">Categoría<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="categoria" name="categoria" maxlength="50" class="form-control" >
                                    <p class="text-muted small m-0">Si pones una categoría existente se añadira a la misma</p>
                                    @error('categoria')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="subcategoria" class="form-label">Subcategoria<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="subcategoria" name="subcategoria" maxlength="50" class="form-control" >
                                    <p class="text-muted small m-0">Si pones una subcategoría existente dentro de esta categoría se añadira a la misma.</p>
                                    @error('subcategoria')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="nombre" class="form-label">Nombre documento<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="nombre" name="nombre" maxlength="80" class="form-control" >
                                    @error('nombre')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="documento" class="form-label">Documento<span
                                            class="text-danger">*</span></label>
                                    <div class="custom-file">
                                    <input type="file" id="documento" name="documento" class="custom-file-input">
                                    <label class="custom-file-label" for="documentos" id="documentos-label">Seleccionar
                                        archivo</label>
                                    </div>
                                    @error('documento')
                                    <div class="text-danger ">
                                        <p class="small m-0">*{{$message}}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class=" col-12 d-flex justify-content-end" >
                                    <button class="btn btn-success">Guardar anexo</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @foreach($categorias as $categoria)
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-olive">
                            <h5 class="text-bold card-title">{{$categoria}}</h5>
                            <div class="card-tools row align-items-center">

                                @if(Auth::user()->role =='Administrador')
                                <form action="{{route('anexo.destroycategoria',$categoria)}}" method="POST" >
                                    @csrf
                                    @include('anexo.partials.modal_delete')
                                </form>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{strtolower($categoria)}}"
                                       class="text-white col-4"><i class="fas fa-trash-alt"></i></a>
                                <a  href="{{route('anexo.editcategoria',$categoria)}}" class="btn pt-0 pb-0 col-4 ">
                                    <i class="fas fa-pencil-alt" style="color: #ffffff;"></i>
                                </a>
                                @endif
                                <button type="button" class="btn pt-0 pb-0 col-4" data-toggle="collapse"
                                        data-target="#{{str_replace(' ', '', $categoria)}}" aria-expanded="false"
                                        aria-controls="{{str_replace(' ', '', $categoria)}}">
                                    <i class="fas fa-plus text-white"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body collapse" id="{{str_replace(' ', '', $categoria)}}">
                            <div class="container-fluid">
                                <div class="row">
                                    @php
                                        $subcategorias = [];
                                    @endphp
                                    @foreach($anexos as $anexo)
                                        @if($anexo->categoria == $categoria && !in_array($anexo->subcategoria, $subcategorias))
                                            @php
                                                $subcategorias[] = $anexo->subcategoria;
                                            @endphp
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header ">
                                                        <h5 class="text-bold card-title">{{$anexo->subcategoria}}</h5>
                                                        <div class="card-tools row align-items-center">
                                                            @if(Auth::user()->role =='Administrador')
                                                            <form action="{{route('anexo.destroySubcategoria',$anexo->subcategoria)}}" method="POST" class="col-4">
                                                                @csrf
                                                                <button class="btn text-danger  btn-sm text-center"><i class="fas fa-trash"></i></button>
                                                            </form>
                                                            <a  href="{{route('anexo.editsubcategoria',[$categoria,$anexo->subcategoria])}}" class="btn pt-0 pb-0 col-4 ">
                                                                <i class="fas fa-pencil-alt"></i>
                                                            </a>
                                                            @endif
                                                            <button type="button" class="btn pt-0 pb-0 col-4"
                                                                    data-toggle="collapse"
                                                                    data-target="#{{str_replace(' ', '', $anexo->categoria)}}{{str_replace(' ', '', $anexo->subcategoria)}}"
                                                                    aria-expanded="false"
                                                                    aria-controls="{{str_replace(' ', '', $anexo->categoria)}}{{str_replace(' ', '', $anexo->subcategoria)}}">
                                                                <i class="fas fa-plus text-black"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body collapse" id="{{str_replace(' ', '', $anexo->categoria)}}{{str_replace(' ', '', $anexo->subcategoria)}}">
                                                        @foreach($anexos as $anexoSub)
                                                            @if($anexoSub->categoria == $categoria && $anexoSub->subcategoria == $anexo->subcategoria)
                                                                <div class="d-flex justify-content-between row">
                                                                    <h6 class="col-10">{{$anexoSub->nombre}}</h6>
                                                                    <div class="col-2">
                                                                        <div class="row justify-content-end">
                                                                            @if(Auth::user()->role =='Administrador')
                                                                            <a href="{{route('anexo.edit',$anexoSub)}}" class="btn pt-0 pb-0 col-4">
                                                                                <i class="fas fa-edit" style="color: #000000;"></i>
                                                                            </a>
                                                                                <form action="{{route('anexo.destroy',$anexoSub->id)}}" method="POST" class="col-4 d-flex justify-content-center">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button class="btn text-danger  btn-sm text-center"><i class="fas fa-trash"></i></button>
                                                                                </form>
                                                                            @endif
                                                                            <form action="{{route('anexo.descargar',$anexoSub)}}" method="POST" class="col-4 d-flex justify-content-center">
                                                                                @csrf
                                                                                <button class="btn text-success  btn-sm text-center"><i class="fas fa-download"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <hr>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endforeach
        </div>
    </div>
@stop

@section('css')
    <style>
        .content-wrapper {
            background-color: #f3f3f3;
        }
        .custom-file-label::after{
            content: "Buscar";
        }
    </style>

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
    <script>
        //Este script hace que en el label de los inputs file se muestre el nombre del archivo selecionado
        $(document).ready(function () {
            function handleFileInput(e) {
                var fileName = e.target.files[0].name;
                $(this).next('label').html(fileName);
            }
            $('input[type="file"]').each(function() {
                $(this).change(handleFileInput);
            });
        });
    </script>
@stop
