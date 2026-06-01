<div class="modal fade" id="CreateMasterListsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Master List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMasterListsForm">
                    @csrf


                    <div class="row">
                        <label>List Code</label>
                        <div class="col-sm-12 d-flex">
                            <input type="text" name="listCode" class="form-control" id="listCode" placeholder="Enter Code">
                            <button type="button" class="btn btn-warning" onclick="generateCode()">
                                <i class="fas fa-undo"></i>
                            </button>
                        </div>
                    </div>

                    <label>First Name</label>
                    <input type="text" name="firstName" class="form-control" placeholder="Enter First Name">

                    <label>Middle Name</label>
                    <input type="text" name="middleName" class="form-control" placeholder="Enter Middle Name">

                    <label>Last Name</label>
                    <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name">

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addMasterLists(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
