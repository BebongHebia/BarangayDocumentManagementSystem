<div class="modal fade" id="ViewTransactionModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Viewing Transactions</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="text-start">Document Code : <b><span id="documentCode"></span></b></h4>
                        <h4 class="text-start">Type : <b><span id="docType"></span></b></h4>
                        <h4 class="text-start">Purpose : <b><span id="docPurpose"></span></b></h4>
                        <h4 class="text-start">Complete Name : <b><span id="docCompleteName"></span></b></h4>
                        <h4 class="text-start">Birthdate : <b><span id="docBday"></span></b></h4>
                        <h4 class="text-start">Civil Status : <b><span id="docCivilStatus"></span></b></h4>
                        <h4 class="text-start">Age : <b><span id="docAge"></span></b></h4>
                        <h4 class="text-start">Sex : <b><span id="docSex"></span></b></h4>
                        <h4 class="text-start">Address : <b><span id="docAddress"></span></b></h4>
                        <h4 class="text-start">Status : <b><span id="docStatus"></span></b></h4>

                    </div>
                    <div class="col-sm-6">

                        <img src="{{ asset('assets/images/CertificateOfIndigency.jpeg') }}" class="img-fluid" id="img1" style="display: none;">
                        <img src="{{ asset('assets/images/BarangayCertification.jpeg') }}" class="img-fluid" id="img2" style="display: none;">
                        <img src="{{ asset('assets/images/BarangayClearance.jpeg') }}" class="img-fluid" id="img3" style="display: none;">

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
