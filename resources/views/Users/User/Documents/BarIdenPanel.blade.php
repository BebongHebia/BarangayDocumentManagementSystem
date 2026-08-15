<div class="row">
    <div class="col-sm-6">

        <form id="addBarIdenForm">
            @csrf
            <input type="hidden" name="userCode" value="{{ $userData->userCode }}">
            <div class="row">
                <div class="col-sm-4">
                    <label>Name</label>
                    <input type="text" id="name" class="form-control" value="{{ $userData->completeName }}" readonly>
                </div>
                <div class="col-sm-4">
                    <label>Sector</label>
                    <input type="text" id="sector" name="sector" class="form-control" value="{{ $userData->purok }}" readonly>
                </div>
            </div>


            <div class="row mt-2">
                <div class="col-sm-12">
                    <button class="btn btn-success btn-block" onclick="submitBarIden(event)">
                        <i class="fas fa-plus"></i> Submit Request
                    </button>
                </div>
            </div>



        </form>

    </div>
    <div class="col-sm-6">
        <center>
            <img src="{{ asset('assets/images/DocImage/BARANGAY-IDENTIFICATION-2026.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
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
        const purposeDropdown = document.getElementById("barClearPur");

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
