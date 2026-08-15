<div class="modal fade" id="ViewBarClearModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Viewing Barangay Clearance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">

                        <h5 class="text-justify"><b>TO WHOME IT MAY CONCERN :</b> </h5>
                        <p class="text-justify">THIS IS TO CERTIFY that <b><span id="viewBarClearName"></span></b> is a bona fide resident of <b><span id="viewBarClearSector"></span></b> Barangay 08, Malaybalay City.</p>
                        <p class="text-justify">He /She is known to be of <b>GOOD MORAL CHARACTER and a LAW ABIDING citizen</b>, having <b>NO DEREGATORY records</b> of complaint, civil or criminal, filed against him/her and pending in the Barangay 08 office</p>
                        <p class="text-justify">This Barangay Certification is issued as per request of the bearer for <b><span id="viewBarClearPurpose"></span></b>.</p>



                    </div>
                    <div class="col-sm-6">
                        <center>
                            <div id="barClearImageDocType">
                                <img src="{{ asset('assets/images/DocImage/BARANGAY-CLEARANCE-2026.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
                            </div>
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
