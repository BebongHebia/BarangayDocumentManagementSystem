<div class="modal fade" id="AddCedulaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Add Cedula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="addCedulaForm">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Select Cedula Resident Type</label>
                            <select class="form-select select2" name="cedulaResType" id="addCedulaResType"
                                onchange="changeResTypeToggle(this.value)">
                                <option value="Resident">Resident</option>
                                <option value="Non-Resident">Non-Resident</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Please Select User (If Resident)</label>
                            <select class="form-select select2" name="userCode" id="addCed_UserCode"
                                onchange="loadUserDetails(this.value)">
                                @php
                                    $users = App\Models\User::where('role', 'User')->orderBy('CompleteName', 'ASC')->get();
                                @endphp
                                @foreach ($users as $item_users)
                                    <option value="{{ $item_users->userCode }}">{{ $item_users->completeName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Complete Name</label>
                            <input type="text" name="completeName" id="addCed_CompleteName" class="form-control"
                                readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Address</label>
                            <input type="text" name="address" id="addCed_Address" class="form-control" readonly>
                        </div>
                        <div class="col-sm-4">
                            <label>Place of Birth</label>
                            <input type="text" name="placeOfBirth" id="addCed_PlaceOfBirth" class="form-control"
                                readonly>
                        </div>
                        <div class="col-sm-4">
                            <label>Date of Birth</label>
                            <input type="date" name="dateOfBirth" id="addCed_DateOfBirth" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Civil Status</label>
                            <select class="form-select select2" name="civilStatus" id="addCed_CivilStatus" readonly>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Height</label>
                                <input type="text" name="height" id="addCed_Height" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label>Weight</label>
                                <input type="text" name="weight" id="addCed_Weight" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <h4><b>Cedula Details</b></h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Cedula No.#</label>
                            <input type="text" name="cedulaNo" id="addCed_CedulaNo" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Date Acquired</label>
                            <input type="date" name="dateAcquired" id="addCed_CedulaNo" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Validity</label>
                            <input type="date" name="validity" id="addCed_CedulaNo" class="form-control">
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="addCedula(event)">
                    <i class="fas fa-plus"></i> Submit
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->