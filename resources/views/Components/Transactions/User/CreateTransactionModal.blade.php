<div class="modal fade" id="CreateTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Master List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/create-transaction') }}" method="POST">
                    @csrf

                    <input type="hidden" name="code" id="code">
                    <label>Select Document Type</label>
                    <select class="form-select select2" name="type">
                        <option value="Barangay Certificate">Barangay Certificate</option>
                        <option value="Barangay Indigency">Barangay Indigency</option>
                        <option value="Barangay Clearance">Barangay Clearance</option>
                    </select>
                    <label>Select Purpose</label>
                    <select class="form-select select2" name="purpose">
                        <option value="Financial assistance">Financial assistance</option>
                        <option value="Job applications">Job applications</option>
                        <option value="Opening bank accounts">Opening bank accounts</option>
                        <option value="Applying for secondary government IDs">Applying for secondary government IDs</option>
                        <option value="Proof of address">Proof of address</option>
                        <option value="School enrollment">School enrollment</option>
                        <option value="Scholarship">Scholarship</option>
                        <option value="Valid ID applications">Valid ID applications</option>
                        <option value="Free legal assistance">Free legal assistance</option>
                    </select>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-plus"></i> Submit
                </button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
