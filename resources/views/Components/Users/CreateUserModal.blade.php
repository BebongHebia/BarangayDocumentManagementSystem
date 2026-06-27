<div class="modal fade" id="CreateUserModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    @csrf

                    <div class="row" style="display: none" id="passwordDoNotMatch">
                        <div class="col-sm-12">
                            <div class="alert alert-danger">
                                <h5 class="text-center">Password does not match</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="display: none" id="passwordMatch">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <h5 class="text-center">Password match</h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <label>Complete Name</label>
                            <input type="text" name="completeName" class="form-control" placeholder="Enter Complete Name" required>
                        </div>
                        <div class="col-sm-2">
                            <label>Sex</label>
                            <select class="form-select select2" name="sex" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label>Sector</label>
                            <select class="form-select select2" name="purok" required>
                                <option value="Sector I">Sector I</option>
                                <option value="Sector II">Sector II</option>
                                <option value="Sector III">Sector III</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Birthdate</label>
                            <input type="date" name="bday" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Civil Status</label>
                            <select class="form-select select2" name="civilStatus" required>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Place of birth</label>
                            <input type="text" name="placeOfBirth" class="form-control" placeholder="Enter Place of birth" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Citizenship</label>
                            <input type="text" name="citizenship" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Current Address</label>
                            <input type="text" name="currentAddress" class="form-control" placeholder="Enter Current Address" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Profesion</label>
                            <input type="text" name="profession" class="form-control" placeholder="Enter Profession" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Role</label>
                            <select class="form-select select2" name="role" required>
                                <option value="Punong Barangay">Punong Barangay</option>
                                <option value="Incharge">Incharge</option>
                                <option value="Health Worker">Health Worker</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter Username" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" placeholder="Enter Password" id="password" required>
                        </div>
                        <div class="col-sm-4">
                            <label>Confrim Password</label>
                            <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Confirm Password" required oninput="confirmPassword();">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" id="addUserButton" onclick="addUser(event)" disabled>
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
