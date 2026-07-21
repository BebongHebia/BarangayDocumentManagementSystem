<div class="modal fade" id="EditCedulaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Cedula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCedulaForm">
                    @csrf
                    <input type="hidden" name="cedId" id="editCedId">

                    <label>Cedula No.#</label>
                    <input type="text" class="form-control" name="cedulaNo" id="editCedNo">

                    <label>Date Acquired</label>
                    <input type="date" class="form-control" name="dateAcquired" id="editDateAcquired">

                    <label>Validity</label>
                    <input type="date" class="form-control" name="validity" id="editValidity">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editCedula(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
