<div class="modal fade" id="EditCalendarActivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Calendar Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCalendarActivityForm">
                    @csrf
                    <input type="hidden" name="calendarActId" id="editCalendarActId">
                    <div class="row">
                        <div class="col-sm-12">

                            <label>Activity Title</label>
                            <input type="text" class="form-control" name="activity" id="editActivity">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date Start</label>
                                    <input type="date" class="form-control" name="dateStart" id="editDateStart">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date End</label>
                                    <input type="date" class="form-control" name="dateEnd" id="editDateEnd">
                                </div>
                            </div>
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="editDescription"></textarea>
                            <label>Status</label>
                            <select class="form-select select2" name="status" id="editStatus">
                                <option value="Upcoming">Upcoming</option>
                                <option value="Ongoing">Ongoing</option>
                                <option value="Finished">Finished</option>
                            </select>
                        </div>
                    </div>



                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="updateCalendarAct(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
