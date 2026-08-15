<div class="row">
    <div class="col-sm-6">

        <form id="addBarIndigentForm">
            @csrf

            <input type="hidden" name="userCode" value="{{ $userData->userCode }}">

            <div class="row">
                <div class="col-sm-10">
                    <label>Name</label>
                    <input type="text" name="name" id="addName" class="form-control" value="{{ $userData->completeName }}" readonly>
                </div>
                <div class="col-sm-2">
                    <label>Name</label>
                    <input type="text" name="sector" id="addSector" class="form-control" value="{{ $userData->purok }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <label>Authorize / Personal</label>
                    @if($docType == "BARANGAY-INDIGENCY-REGULAR")
                    <input type="text" name="isAuthorized" id="addIsAuthorized" class="form-control" value="Personal" readonly>
                    @elseif ($docType == "BARANGAY-INDIGENCY-WITH-PATIENT-NAME")
                    <input type="text" name="isAuthorized" id="addIsAuthorized" class="form-control" value="With Patient" readonly>
                    @endif
                </div>
                <div class="col-sm-6">
                    <label>Indigent Type</label>
                    @if($docType == "BARANGAY-INDIGENCY-REGULAR")
                    <input type="text" name="indigentType" id="addIndigentType" class="form-control" value="Barangay Indigency - Regular" readonly>
                    @elseif ($docType == "BARANGAY-INDIGENCY-WITH-PATIENT-NAME")
                    <input type="text" name="indigentType" id="addIndigentType" class="form-control" value="Barangay Indigency - Patient Name" readonly>
                    @endif
                </div>
            </div>

            @if ($docType == "BARANGAY-INDIGENCY-REGULAR")

            <input type="hidden" name="authorized" id="addAuthorized" class="form-control" value="N/A" readonly>
            <input type="hidden" name="relation" id="addRelation" class="form-control" value="N/A" readonly>


            @else
            <div class="row">
                <div class="col-sm-6">
                    <label>Authorize By</label>
                    <input type="text" name="authorized" id="addAuthorized" class="form-control">
                </div>
                <div class="col-sm-6">
                    <label>Relation</label>
                    <input type="text" name="relation" id="addRelation" class="form-control">
                </div>
            </div>
            @endif

            <div class="row">
                <div class="col-sm-6">
                    <label>Purpose Type</label>
                    <select class="form-select select2" name="purposeType" style="width:100%;" onchange="loadPurposes(this.value)">
                        <option value="Employment & Career">Employment & Career</option>
                        <option value="Business & Financial">Business & Financial</option>
                        <option value="Government Assistance & Social Services">Government Assistance & Social Services</option>
                        <option value="Government IDs & Clearances">Government IDs & Clearances</option>
                        <option value="Civil, Legal & General Use">Civil, Legal & General Use</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Purpose</label>
                    <select class="form-select select2" name="purpose" style="width:100%;" id="barIndiPur">
                    </select>
                </div>
            </div>



            <div class="row mt-2">
                <div class="col-sm-12">
                    <button class="btn btn-success btn-block" onclick="submitBarIndigent(event)">
                        <i class="fas fa-plus"></i> Submit Request
                    </button>
                </div>
            </div>



        </form>

    </div>
    <div class="col-sm-6">
        <center>
            @if($docType == "BARANGAY-INDIGENCY-REGULAR")
            <img src="{{ asset('assets/images/DocImage/BARANGAY-INDIGENCY-2026-NEW-Copy.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
            @else
            <img src="{{ asset('assets/images/DocImage/BARANGAY-INDIGENCY-2026-WITH-PATIENT-NAME.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
            @endif

        </center>

    </div>
</div>

<script>
    loadPurposes("Employment & Career");

    function loadPurposes(purposeType) {
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
        const purposeDropdown = document.getElementById("barIndiPur");

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
