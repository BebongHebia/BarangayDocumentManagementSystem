<div class="modal fade" id="AddCedulaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Add Cedula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCedulaForm">
                    @csrf
                    @php
                        $residents = \App\Models\User::where('role', 'User')->get();

                    @endphp
                    <label>Select Residents</label>
                    <select class="form-select select2" name="userCode">
                        <option value="">Select Residents</option>

                        @foreach ($residents as $residentItems)
                            <option value="{{ $residentItems->userCode }}">{{ $residentItems->completeName }}</option>
                        @endforeach
                    </select>
                    <label>Cedula No.#</label>
                    <input type="text" class="form-control" name="cedulaNo">

                    <label>Date Acquired</label>
                    <input type="date" class="form-control" name="dateAcquired">

                    <label>Validity</label>
                    <input type="date" class="form-control" name="validity">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addCedula(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->