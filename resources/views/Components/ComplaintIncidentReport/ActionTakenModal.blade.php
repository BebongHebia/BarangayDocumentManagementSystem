<div class="modal fade" id="ActionTakenModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Action of Complaint & Incident Taken</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <h5 class="text-center">Set Status to Action Taken</h5>

                <form id="takenComplainIncidentReportForm">
                    @csrf
                    <input type="hidden" name="complainIncidentId" id="actionComplainIncidentId">
                    <label>Complain Type</label>
                    <input type="text" id="actionComplainType" class="form-control" readonly>

                    <label>Complain Description</label>
                    <input type="text" id="actionDescription" class="form-control" readonly>

                    <label>Respondens</label>
                    <input type="text" id="actionRespondense" class="form-control" readonly>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="actionTakenComplainIncident(event)">
                    <i class="fas fa-save"></i> Action Taken
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
