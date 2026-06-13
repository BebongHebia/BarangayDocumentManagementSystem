<div class="modal fade" id="CreateTransactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addTransactionForm">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Select Resident</label>
                            <select class="form-select select2" name="userCode">
                                @php
                                $user = App\Models\User::where('role', 'User')->get();
                                @endphp
                                @foreach ($user as $item_user)
                                <option value="{{ $item_user->userCode }}">{{ $item_user->completeName }}</option>
                                @endforeach
                            </select>
                            <label>Select Type</label>
                            <select class="form-select select2" name="type">
                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                <option value="Barangay Clearance">Barangay Clearance</option>
                                <option value="Barangay Certification">Barangay Certification</option>
                            </select>
                            <label>Select Purpose</label>
                            <select class="form-select select2" name="purpose">
                                <option value="Financial Assistance">Financial Assistance</option>
                                <option value="Medical Assistance">Medical Assistance</option>
                            </select>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addTransaction(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
