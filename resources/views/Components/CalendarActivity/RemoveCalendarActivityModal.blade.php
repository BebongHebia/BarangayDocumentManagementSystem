<div class="modal fade" id="RemoveCalendarActivity">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Removing Calendar Activity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="deleteCalendarActivityForm">
                    @csrf
                    <input type="hidden" name="calendarActId" id="deleteCalendarActId">
                    <h5 class="text-center">Are you sure you want to remove this Calendar Activity?</h5>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-danger" onclick="deleteCalendarAct(event)">
                    <i class="fas fa-trash"></i> Confirm
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
