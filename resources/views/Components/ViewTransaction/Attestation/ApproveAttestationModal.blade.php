<div class="modal fade" id="ApproveAttestationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Set Approve Attestation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="approveAttestationForm">
                    @csrf
                    <input type="hidden" name="transactionCode" id="transactionCode">

                    <label>Select Approving Kagawad</label>
                    <select class="form-select select2" name="staffOfficial">
                        @php
                            $staffOffs = App\Models\StaffOfficial::where('status', 'active')->get();
                        @endphp
                        @foreach($staffOffs as $staffOff)
                            <option value="{{ $staffOff->code }}">{{ $staffOff->completeName }} - {{ $staffOff->position }}
                            </option>
                        @endforeach
                    </select>

                </form>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-success" onclick="setPrintAttestation()">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->