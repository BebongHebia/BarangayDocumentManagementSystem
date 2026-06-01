<div class="modal fade" id="EditUserModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    @csrf
                    <input type="hidden" name="userId" id="editUserId">
                    <div class="row">
                        <div class="col-sm-5">
                            <label>Complete Name</label>
                            <input type="text" name="completeName" class="form-control" id="editCompleteName" placeholder="Enter Complete Name" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Sex</label>
                            <select class="form-select select2" name="sex" id="editSex" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Sector</label>
                            <select class="form-select select2" name="purok" id="editPurok" required>
                                <option value="Sector I">Sector I</option>
                                <option value="Sector II">Sector II</option>
                                <option value="Sector III">Sector III</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Birthdate</label>
                            <input type="date" name="bday" class="form-control" id="editBday" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Civil Status</label>
                            <select class="form-select select2" name="civilStatus" id="editCivilStatus" required>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Place of birth</label>
                            <input type="text" name="placeOfBirth" class="form-control" id="editBirthplace" placeholder="Enter Place of birth" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Citizenship</label>
                            <input type="text" name="citizenship" class="form-control" id="editCitizenship" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Current Address</label>
                            <input type="text" name="currentAddress" class="form-control" id="editCurrentAddress" placeholder="Enter Current Address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Profesion</label>
                            <input type="text" name="profession" class="form-control" id="editProfession" placeholder="Enter Profession" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" id="editPhone" placeholder="Enter Phone" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Role</label>
                            <select class="form-select select2" name="role" id="editRole" required>
                                <option value="Punong Barangay">Punong Barangay</option>
                                <option value="Secretary">Secretary</option>
                                <option value="Health Worker">Health Worker</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>User Code</label>
                            <input type="text" name="userCode" class="form-control" id="editUserCode" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Status</label>
                            <select class="form-select select2" name="status" id="editStatus" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editUser(event)">
                    <i class="fas fa-save"></i> Save change
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
