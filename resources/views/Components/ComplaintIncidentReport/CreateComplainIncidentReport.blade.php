<div class="modal fade" id="CreateComplainIncidentReport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Complaint & Incident Report</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createComplainIncidentReportForm">
                    @csrf

                    <input type="hidden" name="userCode" value="{{ Auth::user()->userCode }}">

                    <label>Select Complain Type</label>
                    <select class="form-select select2" name="complainType" onchange="loadComplaintDescriptions(this.value)">
                        <option value="Public Order & Safety">Public Order & Safety</option>
                        <option value="Property & Neighborhood Disputes">Property & Neighborhood Disputes</option>
                        <option value="Debt & Financial Issues">Debt & Financial Issues</option>
                        <option value="Family & Personal Matters">Family & Personal Matters</option>
                        <option value="Administrative & Official Complaints">Administrative & Official Complaints</option>
                    </select>

                    <label>Description</label>
                    <select class="form-select select2" name="description" id="description">
                    </select>

                    <label>Respondent Name</label>
                    <input type="text" name="respondent" class="form-control" placeholder="Please enter the name of the respondent/inirereklamo">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addComplainIncident(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
