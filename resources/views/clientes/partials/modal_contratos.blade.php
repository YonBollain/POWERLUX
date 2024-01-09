<div class="modal fade " id="modal_contratos{{$cliente->id}}" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-left">Contratos</h1>
                <button type="button" class="btn " data-bs-dismiss="modal"
                        aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body text-left ">
                <div class="table-responsive tabla-modal ">
                <table id="tabla-contratos" class="table table-striped table-bordered ">
                    <thead class="thead-light">
                    <tr>
                        <th>Identificador</th>
                        <th>Tipo</th>
                        <th>CUPS</th>
                        <th>Estado</th>
                        <th>Dirección</th>
                        <th>Finalización</th>
                        <th>Acciones</th>

                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('contratos.create')}}" class="btn btn-success">Crear contrato</a>
            </div>
        </div>
    </div>
</div>
