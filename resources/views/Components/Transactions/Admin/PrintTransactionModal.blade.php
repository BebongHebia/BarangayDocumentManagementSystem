<div class="modal fade" id="PrintTransactionModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Paying Transaction</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="payTransactionForm">
                    @csrf

                    <input type="hidden" name="userCode" id="adminPrintTransaction_userCode">
                    <input type="hidden" name="transactionCode" id="adminPrintTransaction_transactionCode">

                    <div class="row">
                        <div class="col-sm-12" style="border:1px solid rgb(160, 160, 160); box-shadow: 2px 2px 2px rgb(172, 172, 172); border-radius: 3px; padding:10px;">
                            <h5 class="text-start">Transaction Details</h5>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Set Validity</label>
                                    <input type="date" name="validity" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date Schedule</label>
                                    <input type="date" name="dateSched" id="adminPrintTransaction_dateSched" class="form-control" readonly>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12" style="border:1px solid rgb(160, 160, 160); box-shadow: 2px 2px 2px rgb(172, 172, 172); border-radius: 3px; padding:10px;">
                            <h5 class="text-start">Cedula Details</h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Cedula No.#</label>
                                    <input type="text" name="cedulaNo" id="cedulaNo" class="form-control" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <label>Cedula Acquired Date</label>
                                    <input type="text" name="cedIssOn" id="dateAcquired" class="form-control" readonly>
                                </div>
                                <div class="col-sm-3">
                                    <label>Cedula Issue At</label>
                                    <input type="text" name="cedIssAt" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <label>Cedula Amount</label>
                                    <input type="text" name="cedAmount" class="form-control">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12" style="border:1px solid rgb(160, 160, 160); box-shadow: 2px 2px 2px rgb(172, 172, 172); border-radius: 3px; padding:10px;">
                            <h5 class="text-start">Payment Details</h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>O.R No.#</label>
                                    <input type="text" name="orNo" id="orNo" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <label>O.R Issue Date</label>
                                    <input type="date" name="orIssOn" id="orIssOn" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <label>O.R Issue At</label>
                                    <input type="text" name="orIssAt" id="orIssAt" class="form-control">
                                </div>
                                <div class="col-sm-3">
                                    <label>O.R Amount</label>
                                    <input type="text" name="orAmount" id="orAmount" class="form-control">
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-12" style="border:1px solid rgb(160, 160, 160); box-shadow: 2px 2px 2px rgb(172, 172, 172); border-radius: 3px; padding:10px;">
                            <h5 class="text-start">Document Details</h5>
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Document Amount</label>
                                    <input type="text" name="docAmount" id="docAmount" class="form-control">
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
                <button type="button" class="btn btn-dark" onclick="payTransaction(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
