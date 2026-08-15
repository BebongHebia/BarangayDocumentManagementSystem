<div class="modal fade" id="EditBarClearModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Editing Barangay Clearance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-sm-6">
                        <form id="editBarClearForm">

                            <input type="hidden" name="barClearId" id="editBarClearId">

                            <div class="row">
                                <div class="col-sm-3">
                                    <label>Sector</label>
                                    <input type="text" name="sector" class="form-control" id="editBarClearSector" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Purpose Type</label>
                                    <select class="form-select select2" style="width:100%" name="purposeType" id="editBarClerPurType" onchange="loadPurposeBarClear(this.value)">
                                        <option value="Employment & Career">Employment & Career</option>
                                        <option value="Business & Financial">Business & Financial</option>
                                        <option value="Government Assistance & Social Services">Government Assistance & Social Services</option>
                                        <option value="Government IDs & Clearances">Government IDs & Clearances</option>
                                        <option value="Civil, Legal & General Use">Civil, Legal & General Use</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Purpose</label>
                                    <select class="form-select select2" style="width: 100%" name="purpose" id="editBarClearPur">
                                    </select>
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="col-sm-6">
                        <center>
                            <img src="{{ asset('assets/images/DocImage/BARANGAY-CLEARANCE-2026.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
                        </center>
                    </div>
                </div>


            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-dark" onclick="editBarClear(event)">
                    <i class="fas fa-save"></i> Save changes
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    loadPurposeBarClear("Employment & Career");

    function loadPurposeBarClear(purposeType) {
        // Define the purposes for each category
        const purposeData = {
            "Employment & Career": [
                "Local job applications"
                , "First-time job seekers (under RA 11261 for free government services)"
                , "Overseas employment (OFW requirements)"
                , "Professional regulation commission (PRC) exam or licensing"
            , ]
            , "Business & Financial": [
                "New business permit application (Barangay Business Clearance)"
                , "Annual business permit renewal"
                , "Microfinance or commercial bank loan applications"
                , "Opening a personal or corporate bank account"
            , ]
            , "Government Assistance & Social Services": [
                "Medical financial assistance (for DSWD, PCSO, or Malasakit Centers)"
                , "Educational financial assistance, scholarships, or tuition waivers"
                , "Burial or funeral assistance"
                , "Local social welfare and emergency relief programs"
            , ]
            , "Government IDs & Clearances": [
                "National Police Clearance application"
                , "NBI Clearance application"
                , "Philippine Passport application (DFA)"
                , "Establishing residency for Voter's Registration"
            , ]
            , "Civil, Legal & General Use": [
                "Proof of residency for utility connections (water, electricity, internet)"
                , "Proof of residency for purchasing a vehicle or property"
                , "Marriage license application"
                , "Local construction or building permit (Certificate of No Objection)"
                , "Certificate of Good Moral Character for school or legal matters"
            , ]
        , };

        // Get the purpose dropdown element
        const purposeDropdown = document.getElementById("editBarClearPur");

        // Clear existing options
        purposeDropdown.innerHTML = "";

        // Add a default disabled option
        const defaultOption = document.createElement("option");
        defaultOption.textContent = "Select Purpose";
        defaultOption.disabled = true;
        defaultOption.selected = true;
        purposeDropdown.appendChild(defaultOption);

        // Get the purposes for the selected type
        const purposes = purposeData[purposeType] || [];

        // Add new options
        purposes.forEach(function(purpose) {
            const option = document.createElement("option");
            option.value = purpose;
            option.textContent = purpose;
            purposeDropdown.appendChild(option);
        });
    }

</script>
