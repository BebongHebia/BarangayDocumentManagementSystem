<div class="modal fade" id="SetApproveModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Approving Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="approveTransactionForm">
                    @csrf

                    <input type="hidden" name="transactionCode" id="aprTransactionCode">
                    <input type="hidden" name="userCode" id="aprUserCode">

                    <label>Set Schedule</label>
                    <input type="date" name="dateSched" class="form-control">
                    <label>Validity</label>
                    <input type="date" name="validity" class="form-control">

                    <label>Cedula No.#</label>
                    <input type="number" name="cedulaNo" class="form-control" id="cedulaNo">

                    <label>Cedula Issued On</label>
                    <input type="date" name="cedIssOn" class="form-control">

                    <label>Cedula Issued At</label>
                    <select class="form-select select2" name="cedIssAt">
                        <option value="Administration Building, Barangay Utso, Malaybalay City, Bukidnon">Administration Building, Barangay Utso, Malaybalay City, Bukidnon</option>
                    </select>

                    <label>Cedula Amount</label>
                    <select class="form-select select2" name="cedAmount">
                        <option value="120">P120.00</option>
                        <option value="80">P80.00</option>
                    </select>

                    <label>O.R No.#</label>
                    <input type="number" name="orNo" class="form-control" id="orNo">

                    <label>O.R Issued On</label>
                    <input type="date" name="orIssOn" class="form-control">

                    <label>O.R Issued At</label>
                    <select class="form-select select2" name="orIssAt">
                        <option value="Administration Building, Barangay Utso, Malaybalay City, Bukidnon">Administration Building, Barangay Utso, Malaybalay City, Bukidnon</option>
                    </select>

                    <label>OR Amount</label>
                    <select class="form-select select2" name="orAmount">
                        <option value="120">P120.00</option>
                        <option value="80">P80.00</option>
                    </select>

                    <label>Document Amount</label>
                    <select class="form-select select2" name="docAmount">
                        <option value="120">P120.00</option>
                        <option value="80">P80.00</option>
                    </select>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="approveRequest(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
