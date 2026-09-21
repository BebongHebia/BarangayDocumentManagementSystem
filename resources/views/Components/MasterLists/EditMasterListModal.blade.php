<div class="modal fade" id="EditMasterListsModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Master List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMasterListsForm">
                    @csrf

                    <input type="hidden" name="masterListId" id="editMasterListId">
                    <div class="row align-items-end">
                        <!-- List Code -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="listCode">List Code</label>
                                <div class="input-group">
                                    <input type="text" name="listCode" class="form-control" id="editListId"
                                        placeholder="Enter Code">
                                </div>
                            </div>
                        </div>

                        <!-- Select Resident Type -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="resType">Select Resident Type</label>
                                <select class="form-select select2" name="resType" id="editResType">
                                    <option value="Resident">Resident</option>
                                    <option value="Non-Resident">Non-Resident</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>First Name</label>
                            <input type="text" name="firstName" id="editFirstName" class="form-control"
                                placeholder="Enter First Name">
                        </div>
                        <div class="col-sm-3">
                            <label>Middle Name</label>
                            <input type="text" name="middleName" id="editMiddleName" class="form-control"
                                placeholder="Enter Middle Name">
                        </div>
                        <div class="col-sm-3">
                            <label>Last Name</label>
                            <input type="text" name="lastName" id="editLastName" class="form-control"
                                placeholder="Enter Last Name">
                        </div>
                        <div class="col-sm-2">
                            <label>Suffix</label>
                            <input type="text" name="suffix" id="editSuffix" class="form-control"
                                placeholder="Enter Suffix">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <label for="resType">Sex</label>
                            <select class="form-select select2" name="sex" id="editSex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Date of Birth</label>
                            <input type="date" name="birthdate" id="editBirthdate" class="form-control"
                                placeholder="Enter Birthday">
                        </div>
                        <div class="col-sm-3">
                            <label>Place of Birth</label>
                            <input type="text" name="placeOfBirth" id="editPlaceOfBirth" class="form-control"
                                placeholder="Enter Place of Birth">
                        </div>
                        <div class="col-sm-3">
                            <label for="resType">Blood Type</label>
                            <select class="form-select select2" name="bloodType" id="editBloodType">
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
                            <select class="form-select select2" name="civilStatus" id="editCivilStatus">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label>Religion</label>
                            <input type="text" name="religion" id="editReligion" class="form-control"
                                placeholder="Enter Religion">
                        </div>
                        <div class="col-sm-4">
                            <label>Citizenship</label>
                            <input type="text" name="citizenship" id="editCitizenship" class="form-control"
                                placeholder="Enter Citizenship">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <label>Sector</label>
                            <select class="form-select select2" name="purok" id="editPurok">
                                <option value="Sector I">Sector I</option>
                                <option value="Sector II">Sector II</option>
                                <option value="Sector III">Sector III</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" id="editAddress"
                                placeholder="Enter Address">
                        </div>
                        <div class="col-sm-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="editEmail"
                                placeholder="Enter Email">
                        </div>
                        <div class="col-sm-3">
                            <label>Contact No.#</label>
                            <input type="text" name="contact" class="form-control" id="editContact"
                                placeholder="Enter Contact No.#">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <label>Educational Attainment</label>
                            <select class="form-select select2" name="educationalAtt" id="editEducationalAtt">
                                <option value="Elementary">Elementary</option>
                                <option value="High School">High School</option>
                                <option value="College">College</option>
                                <option value="Graduate Studies">Graduate Studies</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label>Profession/Work Description</label>
                            <input type="text" name="profession" class="form-control" id="editProfession"
                                placeholder="Enter Profession">
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editMasterLists(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->