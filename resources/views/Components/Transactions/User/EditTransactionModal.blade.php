<div class="modal fade" id="EditTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Transactions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editTransactionForm">
                    <input type="hidden" name="transactionId" id="editTransactionId">
                    <label>Document Type</label>
                    <select class="form-select select2" name="type" id="editType">
                        <option value="Certificate of Indigency">Certificate of Indigency</option>
                        <option value="Barangay Clearance">Barangay Clearance</option>
                        <option value="Barangay Certification">Barangay Certification</option>
                    </select>
                    <label>Purpose</label>
                    <select class="form-control" id="editPurpose" name="purpose" style="width:100%">
                        <option value="Financial Assistance">Financial Assistance</option>
                        <option value="Medical Assistance">Medical Assistance</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editTransaction(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
