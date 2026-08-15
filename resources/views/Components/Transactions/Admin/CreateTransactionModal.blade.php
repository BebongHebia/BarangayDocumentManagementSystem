<div class="modal fade" id="CreateTransactionModal">
    <div class="modal-dialog modal-xl   ">
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
                        <div class="col-sm-6">
                            <label>Please Select Document To Process</label>
                            <select class="form-select select2" name="type" id="adminCreateTransactionDocType" onchange="loadUsers(this.value)">
                                <option disabled selected>Select Document</option>
                                <option value="ATTESTATION">ATTESTATION</option>
                                <option value="BARANGAY-CERTIFICATION-REGULAR">BARANGAY-CERTIFICATION-REGULAR</option>
                                <option value="BARANGAY-CERTIFICATION-FTJS">BARANGAY-CERTIFICATION-FTJS</option>
                                <option value="BARANGAY-CLEARANCE">BARANGAY-CLEARANCE</option>
                                <option value="BARANGAY-IDENTIFICATION">BARANGAY-IDENTIFICATION</option>
                                <option value="BARANGAY-INDIGENCY-REGULAR">BARANGAY-INDIGENCY-REGULAR</option>
                                <option value="BARANGAY-INDIGENCY-WITH-PATIENT-NAME">BARANGAY-INDIGENCY-WITH-PATIENT-NAME</option>
                            </select>

                            <label>Select Resident</label>
                            <select class="form-select select2" name="userCode" id="adminCreateTransactionUserCode" onchange="loadSelectedUserDetails(this.value)">

                            </select>

                            <h5 class="text-start">Resident Profile</h5>
                            <div class="row">
                                <div class="col-sm-4">
                                    <center>
                                        <div style="width: 50%; aspect-ratio: 1/1; border-radius: 50%; overflow: hidden;">
                                            <img src="{{ asset('assets/images/dummyLogo.png') }}" id="adminSelectedUserImage" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </center>
                                </div>
                                <div class="col-sm-8">
                                    <label>User Code</label>
                                    <input type="text" id="adminCreateTransactionSelectedUserUserCode" class="form-control" readonly>
                                    <label>Name</label>
                                    <input type="text" id="adminCreateTransactionSelectedUserName" class="form-control" readonly style="width:100%">
                                    <label>Sex</label>
                                    <input type="text" id="adminCreateTransactionSelectedUserSex" class="form-control" readonly style="width:100%">
                                    <label>Birthday</label>
                                    <input type="text" id="adminCreateTransactionSelectedUserBday" class="form-control" readonly style="width:100%">
                                    <label>Civil Status</label>
                                    <input type="text" id="adminCreateTransactionSelectedCivilStatus" class="form-control" readonly style="width:100%">
                                    <label>Sector</label>
                                    <input type="text" id="adminCreateTransactionSelectedSector" class="form-control" readonly style="width:100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="adminCreateTransactionsUserProfile">
                                <center>
                                    <img src="{{ asset('assets/images/dummyLogo.png') }}" class="img-fluid" id="adminCreateTransactionResImg" style="width:50%">
                                </center>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="redirectToDocument()">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
