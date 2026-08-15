<div class="modal fade" id="SetApproveModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Set Approve Requested Document</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="text-center"><b>Set This Request Approve</b></h3>
                    </div>
                </div>

                <hr>

                @php
                $userCedulaDeatils = App\Models\Cedula::where('userCode', $transaction->userCode)->latest()->first();
                @endphp

                <form id="setApproveTransactionForm">
                    @csrf
                    <input type="hidden" name="userCode" class="form-control" value="{{ $transaction->userCode }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="text-center">Transaction Details</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Transaction Code</label>
                                    <input type="text" name="transactionCode" class="form-control" value="{{ $transaction->code }}" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <input type="text" name="status" class="form-control" value="{{ $transaction->status }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Complete Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $transaction->user->completeName }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Docment Type</label>
                                    <input type="text" name="docType" class="form-control" value="{{ $transaction->type }}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Remarks/SMS Message</label>
                                    <textarea class="form-control">Your requested document : {{ $transaction->type }} is now approved. You may claim it from the Barangay Admin Building</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Set Schedule to visit</label>
                                    <input type="date" name="dateSched" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>


                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-success" onclick="setApproveTransaction(event)">
                    <i class="fas fa-save"></i> Set Approve
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
