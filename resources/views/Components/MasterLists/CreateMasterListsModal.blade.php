<div class="modal fade" id="CreateMasterListsModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Creating Master List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMasterListsForm">
                    @csrf
                    <div class="row align-items-end">
                        <!-- List Code -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="listCode">List Code</label>
                                <div class="input-group">
                                    <input type="text" name="listCode" class="form-control" id="listCode"
                                        placeholder="Enter Code">
                                    <button type="button" class="btn btn-warning" onclick="generateCode()">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Select Resident Type -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resType">Select Resident Type</label>
                                <select class="form-select select2" name="resType">
                                    <option value="Resident">Resident</option>
                                    <option value="Non-Resident">Non-Resident</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>First Name</label>
                            <input type="text" name="firstName" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="col-sm-3">
                            <label>Middle Name</label>
                            <input type="text" name="middleName" class="form-control" placeholder="Enter Middle Name">
                        </div>
                        <div class="col-sm-3">
                            <label>Last Name</label>
                            <input type="text" name="lastName" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="col-sm-2">
                            <label>Suffix</label>
                            <input type="text" name="suffix" class="form-control" placeholder="Enter Suffix">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <label for="resType">Sex</label>
                            <select class="form-select select2" name="sex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Date of Birth</label>
                            <input type="date" name="birthdate" class="form-control" placeholder="Enter Birthday">
                        </div>
                        <div class="col-sm-3">
                            <label>Place of Birth</label>
                            <input type="text" name="placeOfBirth" class="form-control"
                                placeholder="Enter Place of Birth">
                        </div>
                        <div class="col-sm-3">
                            <label for="resType">Blood Type</label>
                            <select class="form-select select2" name="bloodType">
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="resType">Civil Status</label>
                            <select class="form-select select2" name="civilStatus">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Religion</label>
                            <input type="text" name="religion" class="form-control" placeholder="Enter Religion">
                        </div>
                        <div class="col-sm-4">
                            <label>Citizenship</label>
                            <input type="text" name="citizenship" class="form-control" placeholder="Enter Citizenship">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <label>Sector</label>
                            <select class="form-select select2" name="purok">
                                <option value="Sector I">Sector I</option>
                                <option value="Sector II">Sector II</option>
                                <option value="Sector III">Sector III</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address">
                        </div>
                        <div class="col-sm-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="col-sm-3">
                            <label>Contact No.#</label>
                            <input type="text" name="contact" class="form-control" placeholder="Enter Contact No.#">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <label>Educational Attainment</label>
                            <select class="form-select select2" name="educationalAtt">
                                <option value="Elementary">Elementary</option>
                                <option value="High School">High School</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Profession/Work Description</label>
                            <input type="text" name="profession" class="form-control" placeholder="Enter Profession">
                        </div>
                    </div>



                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addMasterLists(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->