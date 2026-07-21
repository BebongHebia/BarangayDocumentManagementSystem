<div class="modal fade" id="EditComplainIncidentReport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Complaint & Incident Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editComplainIncidentReportForm">
                    @csrf

                    <input type="hidden" name="userCode" value="{{ Auth::user()->userCode }}">
                    <input type="hidden" name="complainIncidentId" id="editComplainIncidentId">

                    <label>Select Complain Type</label>
                    <select class="form-select select2" name="complainType" id="editComplainType" onchange="loadEditComplaintDescriptions(this.value)">
                        <option value="Public Order & Safety">Public Order & Safety</option>
                        <option value="Property & Neighborhood Disputes">Property & Neighborhood Disputes</option>
                        <option value="Debt & Financial Issues">Debt & Financial Issues</option>
                        <option value="Family & Personal Matters">Family & Personal Matters</option>
                        <option value="Administrative & Official Complaints">Administrative & Official Complaints</option>
                    </select>

                    <label>Description</label>
                    <select class="form-select select2" name="description" id="editDescription">
                    </select>

                    <label>Respondent Name</label>
                    <input type="text" name="respondent" id="editRespondent" class="form-control" placeholder="Please enter the name of the respondent/inirereklamo">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editComplainIncident(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
