<div class="modal fade" id="CreateStaffOfficial">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Staff/Official</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStaffOfficialForm">
                    @csrf

                    <div class="row">
                        <div class="col-sm-10">
                            <label>Complete Name</label>
                            <input type="text" name="completeName" id="completeName" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label>Sex</label>
                            <select class="form-select select2" name="sex" id="sex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <label>Birthdate</label>
                            <input type="date" name="bday" id="bday" class="form-control">
                        </div>

                        <div class="col-sm-3">
                            <label>Place of Birth</label>
                            <input type="text" name="birthPlace" id="birthPlace" class="form-control">
                        </div>

                        <div class="col-sm-3">
                            <label>Civil Status</label>
                            <select class="form-select select2" name="civilStatus" id="civilStatus">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>

                        <div class="col-sm-3">
                            <label>Position</label>
                            <select class="form-select select2" name="position" id="position">
                                <option value="Punong Barangay">Punong Barangay</option>
                                <option value="Kagawad">Kagawad</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Treasurer">Treasurer</option>
                            </select>
                        </div>
                    </div>




                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addStaffOfficial(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
