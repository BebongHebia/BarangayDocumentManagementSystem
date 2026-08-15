<div class="modal fade" id="SetProcessingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Set Processing Requested Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="setProcessingTransactionForm">
                    @csrf
                    <input type="hidden" name="userCode" value="{{ $transaction->user->userCode }}" class="form-control" readonly>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $transaction->user->completeName }}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Transaction Code</label>
                            <input type="text" name="transactionCode" value="{{ $transaction->code }}" class="form-control" readonly>
                        </div>
                        <div class="col-sm-6">
                            <label>Status</label>
                            <input type="text" name="status" value="{{ $transaction->status }}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Transaction Code</label>
                            <input type="text" name="type" value="{{ $transaction->type }}" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="setProcessTransaction(event)">
                    <i class="fas fa-save"></i> Set Process
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
