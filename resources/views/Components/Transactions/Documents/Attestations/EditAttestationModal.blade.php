<div class="modal fade" id="EditAttestationModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Attestation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editAttestationForm">
                    <input type="hidden" name="attestationId" id="editTransAttestationId">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-10">
                                    <label>Name</label>
                                    <input type="text" name="name" id="editAttestationName" class="form-control" readonly>
                                </div>
                                <div class="col-sm-2">
                                    <label>Age</label>
                                    <input type="text" name="age" id="editAttestationAge" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <select class="form-select select2" id="editAttestationStatus" name="status" style="width:100%">
                                        <option value="In Crisis">In Crisis</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>status Monthly</label>
                                    <select class="form-select select2" name="income" id="editAttestationMonthlyIncome" style="width:100%">
                                        <option value="P5,000.00">P5,000.00</option>
                                        <option value="P5,500.00">P5,500.00</option>
                                        <option value="P6,000.00">P6,000.00</option>
                                        <option value="P6,500.00">P6,500.00</option>
                                        <option value="P7,000.00">P7,000.00</option>
                                        <option value="P7,500.00">P7,500.00</option>
                                        <option value="P8,000.00">P8,000.00</option>
                                        <option value="P8,500.00">P8,500.00</option>
                                        <option value="P9,000.00">P9,000.00</option>
                                        <option value="P9,500.00">P9,500.00</option>
                                        <option value="P10,000.00">P10,000.00</option>
                                        <option value="P10,500.00">P10,500.00</option>
                                        <option value="P11,000.00">P11,000.00</option>
                                        <option value="P11,500.00">P11,500.00</option>
                                        <option value="P12,000.00">P12,000.00</option>
                                        <option value="P12,500.00">P12,500.00</option>
                                        <option value="P13,000.00">P13,000.00</option>
                                        <option value="P13,500.00">P13,500.00</option>
                                        <option value="P14,000.00">P14,000.00</option>
                                        <option value="P14,500.00">P14,500.00</option>
                                        <option value="P15,000.00">P15,000.00</option>
                                        <option value="P15,500.00">P15,500.00</option>
                                        <option value="P16,000.00">P16,000.00</option>
                                        <option value="P16,500.00">P16,500.00</option>
                                        <option value="P17,000.00">P17,000.00</option>
                                        <option value="P17,500.00">P17,500.00</option>
                                        <option value="P18,000.00">P18,000.00</option>
                                        <option value="P18,500.00">P18,500.00</option>
                                        <option value="P19,000.00">P19,000.00</option>
                                        <option value="P19,500.00">P19,500.00</option>
                                        <option value="P20,000.00">P20,000.00</option>
                                        <option value="P20,500.00">P20,500.00</option>
                                        <option value="P21,000.00">P21,000.00</option>
                                        <option value="P21,500.00">P21,500.00</option>
                                        <option value="P22,000.00">P22,000.00</option>
                                        <option value="P22,500.00">P22,500.00</option>
                                        <option value="P23,000.00">P23,000.00</option>
                                        <option value="P23,500.00">P23,500.00</option>
                                        <option value="P24,000.00">P24,000.00</option>
                                        <option value="P24,500.00">P24,500.00</option>
                                        <option value="P25,000.00">P25,000.00</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Assistance Type</label>
                                    <select class="form-select select2" name="typeOfAssistance" id="editAttestationAssistanceType" style="width:100%">
                                        <option value="Financial">Financial</option>
                                        <option value="Medical">Medical</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Total Monthly Household Expense</label>
                                    <input type="text" name="totalMonthlyHousholdExpense" class="form-control" id="editAttestationTotalMonthlyHousholdExpense">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <center>
                                <img src="{{ asset('assets/images/DocImage/ATTESTATION-2026.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
                            </center>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editAttestation(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
