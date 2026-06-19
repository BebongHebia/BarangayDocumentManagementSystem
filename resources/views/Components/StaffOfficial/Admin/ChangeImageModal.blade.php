<div class="modal fade" id="ChangeImageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Changing Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="changeStaffOfficalImage" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="code" id="code">
                    <div class="form-group">
                        <label for="file">Select Image</label>
                        <input type="file" name="file" id="file" class="form-control" accept="image/*" required>
                        <small class="text-muted">Allowed: jpeg, png, jpg, gif (Max: 2MB)</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addStaffOfficialImage(event)">
                    <i class="fas fa-save"></i> Change Image
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
