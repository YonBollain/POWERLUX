@includeif('partials.errors')
<div class="col-md-12 col-12">
    <div class="card card-default">
        <div class="card-header">
            <span>Contrato numero : #{{$nombre->id}} {{$tipo_contrato}}</span>
        </div>
        <div class="card-body">
            <div class="box box-info padding-1">
                <div class="box-body">
                    <input type="hidden" name="tipo_contrato" value="{{$tipo_contrato}}">
                    <input type="hidden" name="contrato_id" value="{{$contrato}}">
                    <div class="form-group col-12 col-md-6">
                        <label for="tipo" class="form-label ">Tipo de gestión:<span class="text-danger">*</span></label>
                        <select id="tipo" class="form-control {{($errors->has('tipo') ? ' is-invalid' : '')}}" name="tipo">
                            <option value="0">Selecciona un tipo de gestión</option>
                            <option value="Cbo.Titular sin subrrogacion">Cbo. Titular sin subrogación</option>
                            <option value="Cbo.Titular con subrogacion">Cbo. Titular con subrogación</option>
                            <option value="Cbo.Domiciliacion bancaria">Cbo. Domiciliación bancaria</option>
                            <option value="Cbo.Potencia">Cbo. Potencia</option>
                            <option value="Duplicado de factura">Duplicado de factura</option>
                            <option value="Otros">Otros</option>
                        </select>
                        {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-12 ">
                        <label for="nota" class="form-label">Nota:<span class="text-danger">*</span></label>
                        <textarea id="nota" class="form-control {{($errors->has('nota') ? ' is-invalid' : '')}}" name="nota" rows="10" cols="30" style="resize: none" maxlength="2500">
                        </textarea>
                        {!! $errors->first('nota', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    @if(Auth::user()->role == 'Administrador')
                    <div class="form-group col-12 col-md-6">
                        <label for="estado" class="form-label">Estado:<span class="text-danger">*</span></label>
                        <select id="estado" class="form-control{{($errors->has('estado') ? ' is-invalid' : '')}}" name="estado">
                            <option value="0">Selecciona un estado</option>
                            <option value="En tramite">En tramite</option>
                            <option value="Incidencia">Incidencia</option>
                            <option value="Tramitado">Tramitado</option>
                        </select>
                        {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    @else
                        <input type="hidden" name="estado" value="En tramite">
                    @endif
                    <div class="form-group col-12 position-relative">
                        <label for="documentos" class="form-label m-0">Documentos:</label>
                        <input type="file" name="documentos[]" class="custom-file-input @if( $errors->has('documentos')) is-invalid' @endif "
                               id="documentos" multiple data-browse="Seleccionar archivo" style="height: 0px">
                        <label class="custom-file-label position-relative w-100" for="documentos" id="documentos-label">Seleccionar
                            archivo</label>
                        {!! $errors->first('documentos', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-success">Enviar solicitud</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('css')
    <style>
        .custom-file-label::after{
            content: "Buscar";
        }
    </style>
@stop
@section('js')
    <script>
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
