<div class="modal fade " id="modal{{$cliente->id}}" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-left">Eliminar cliente</h1>
                <button type="button" class="btn " data-bs-dismiss="modal"
                        aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body text-left">
                ¿Estás seguro de eliminar el cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary"
                        data-bs-dismiss="modal">No
                </button>
                <button type="submit" class="btn btn-danger">Si</button>
            </div>
        </div>
    </div>
</div>
