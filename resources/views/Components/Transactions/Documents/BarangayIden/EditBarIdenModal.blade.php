<div class="modal fade" id="EditBarIdenModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Barangay Identification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">
                        <form id="editBarIdenform">

                            <input type="hidden" name="barIdenId" id="editBarIdenId">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Name</label>
                                    <input type="text" id="editName" class="form-control" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label>Sector</label>
                                    <input type="text" id="editSector" name="sector" class="form-control" readonly>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-sm-6">
                        <center>
                            <img src="{{ asset('assets/images/DocImage/BARANGAY-IDENTIFICATION-2026.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
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
