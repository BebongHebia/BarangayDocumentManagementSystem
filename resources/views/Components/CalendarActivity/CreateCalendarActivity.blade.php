<div class="modal fade" id="CreateCalendarActivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Calendar Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCalendarActivityForm">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12">

                            <label>Activity Title</label>
                            <input type="text" class="form-control" name="activity">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Date Start</label>
                                    <input type="date" class="form-control" name="dateStart">
                                </div>
                                <div class="col-sm-6">
                                    <label>Date End</label>
                                    <input type="date" class="form-control" name="dateEnd">
                                </div>
                            </div>
                            <label>Description</label>
                            <textarea class="form-control" name="description"></textarea>

                        </div>
                    </div>



                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addCalendarActivity(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
