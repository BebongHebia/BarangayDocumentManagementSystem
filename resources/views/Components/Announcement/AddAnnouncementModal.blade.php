<div class="modal fade" id="AddAnnouncement">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Add Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addAnnouncementForm">
                    @csrf

                    <label>Announcment</label>
                    <input type="text" name="title" class="form-control">

                    <label>Description</label>
                    <textarea class="form-control" name="description"></textarea>

                    <label>What</label>
                    <input type="text" name="what" class="form-control">

                    <label>When</label>
                    <input type="date" name="when" class="form-control">

                    <label>Where</label>
                    <input type="text" name="where" class="form-control">

                    <label>How</label>
                    <input type="text" name="how" class="form-control">


                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addAnnouncement(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
