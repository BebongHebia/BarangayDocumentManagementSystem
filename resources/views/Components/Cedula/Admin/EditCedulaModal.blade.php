<div class="modal fade" id="EditCedulaModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Cedula</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCedulaForm">
                    @csrf
                    <input type="hidden" name="cedId" id="editCed_CedId" class="form-control">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Select Cedula Resident Type</label>
                            <select class="form-select select2" name="cedulaResType" id="editCedulaResType"
                                onchange="changeResTypeToggle(this.value)">
                                <option value="Resident">Resident</option>
                                <option value="Non-Resident">Non-Resident</option>
                            </select>
                        </div>
                    </div>
                    <div class="row" id="edit_userCodeSelect" style="display: none">
                        <div class="col-sm-12">
                            <label>Please Select User (If Resident)</label>
                            <select class="form-select select2" name="userCode" id="editCed_UserCode">
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
                            <input type="text" name="completeName" id="editCed_CompleteName" class="form-control">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Address</label>
                            <input type="text" name="address" id="editCed_Address" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Place of Birth</label>
                            <input type="text" name="placeOfBirth" id="editCed_PlaceOfBirth" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Date of Birth</label>
                            <input type="date" name="dateOfBirth" id="editCed_DateOfBirth" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label>Civil Status</label>
                            <select class="form-select select2" name="civilStatus" id="editCed_CivilStatus">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Height</label>
                                <input type="text" name="height" id="editCed_Height" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <label>Weight</label>
                                <input type="text" name="weight" id="editCed_Weight" class="form-control">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <h4><b>Cedula Details</b></h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <label>Cedula No.#</label>
                            <input type="text" name="cedulaNo" id="editCed_CedulaNo" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Date Acquired</label>
                            <input type="date" name="dateAcquired" id="editCed_dateAcquired" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label>Validity</label>
                            <input type="date" name="validity" id="editCed_Validity" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editCedula(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->