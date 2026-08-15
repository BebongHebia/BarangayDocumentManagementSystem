<div class="modal fade" id="ViewAttestationModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Viewing Attestation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-center"><b>CERTIFICATION OF ATTESTATION</b></h3>
                        <p class="text-justify">This is to certify that Mr. /Ms. <b><span class="viewAttName"></span></b>, <b><span id="viewAttAge"></span></b> YEARS OLD residing at <b>BARANGAY 8, MALAYBALAY CITY, BUKIDNON,</b> is currently <b><span id="viewAttStatus"></span></b> earning Php <b><span id="viewAttIncome"></span></b> per month.</p>
                        <p class="text-justify">Following a thorough assessment and validation of the client’s socio-economic profile conducted by the Barangay Captain/Barangay Kagawad, it has been determined that Mr. /Ms_<b><span class="viewAttName"></span></b>, is an individual receiving income below the regional minimum wage and is facing significant financial challenges because of the effects of inflation, like the rising prices of goods and services. The above-mentioned income remains insufficient to meet the unforeseen expenses for <b><span id="viewAttTypeOfAssistant"></span> ASSISTANCE</b> on top of the family’s monthly household expenses amounting to Php <b><span id="viewAttTotalMonthlyHousholdExpense"></span></b>, thus further straining their limited financial resources.</p>
                        <p class="text-justify">This certification is issued upon the request of the above-named person for whatever legal purposes it may serve</p>
                    </div>
                    <div class="col-sm-6">
                        <center>
                            <img src="{{ asset('assets/images/DocImage/ATTESTATION-2026.jpg') }}" class="img-fluid">
                        </center>

                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
