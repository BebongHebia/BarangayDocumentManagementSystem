<div class="modal fade" id="EditMasterListsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Master List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMasterListsForm">
                    @csrf
                    <input type="hidden" name="listId" id="editListId" class="form-control" placeholder="Enter First Name">
                    <div class="row">
                        <label>List Code</label>
                        <div class="col-sm-12 d-flex">
                            <input type="text" name="listCode" class="form-control" id="editListCode" placeholder="Enter Code">
                        </div>
                    </div>
                    <label>First Name</label>
                    <input type="text" name="firstName" id="editFirstName" class="form-control" placeholder="Enter First Name">

                    <label>Middle Name</label>
                    <input type="text" name="middleName" id="editMiddleName" class="form-control" placeholder="Enter Middle Name">

                    <label>Last Name</label>
                    <input type="text" name="lastName" id="editLastName" class="form-control" placeholder="Enter Last Name">

                    <label>Status</label>
                    <select class="form-select select2" name="status" id="editStatus">
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editMasterLists(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
