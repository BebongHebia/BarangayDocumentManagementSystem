<div class="modal fade" id="DeleteAnnouncement">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Delete Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteAnnouncementForm">
                    @csrf
                    <input type="hidden" name="annId" class="form-control" id="deleteAnnId">
                    <h5 class="text-center">Are you sure you want to remove this announcement??</h5>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteAnnouncement(event)">
                    <i class="fas fa-trash"></i> Confirm
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
