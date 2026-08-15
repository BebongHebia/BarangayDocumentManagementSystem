<div class="row">
    <div class="col-sm-6">

        <form id="addBarCertForm">
            @csrf
            @if($docType == "BARANGAY-CERTIFICATION-REGULAR")
            <input type="hidden" name="isType" value="Barangay Certification - Regular">
            @else
            <input type="hidden" name="isType" value="Barangay Certification - First Time Job Seeker">

            @endif
            <input type="hidden" name="userCode" value="{{ $userData->userCode }}">

            <div class="row">
                <div class="col-sm-3">
                    <label>Sector</label>
                    <select class="form-select select2" name="sector" style="width:100%">
                        <option value="Sector 1">Sector 1</option>
                        <option value="Sector 2">Sector 2</option>
                        <option value="Sector 3">Sector 3</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label>No.# Years Resident</label>
                    <select class="form-select select2" name="residentYears" style="width:100%">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="10">20</option>
                    </select>
                </div>
                <div class="col-sm-5">
                    <label>Type of Certification Class</label>
                    @if($docType == "BARANGAY-CERTIFICATION-REGULAR")
                    <input type="text" name="isFirstTimeJobSeeker" class="form-control" value="Regular" readonly>
                    @else
                    <input type="text" name="isFirstTimeJobSeeker" class="form-control" value="First-Time Job Seeker" readonly>
                    @endif

                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label>Purpose Type</label>
                    <select class="form-select select2" style="width:100%" name="purposeType" id="barCertRegPurType" onchange="loadPurposes(this.value)">
                        <option value="Employment & Career">Employment & Career</option>
                        <option value="Business & Financial">Business & Financial</option>
                        <option value="Government Assistance & Social Services">Government Assistance & Social Services</option>
                        <option value="Government IDs & Clearances">Government IDs & Clearances</option>
                        <option value="Civil, Legal & General Use">Civil, Legal & General Use</option>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label>Purpose</label>
                    <select class="form-select select2" style="width: 100%" name="purpose" id="barCertRegPur">
                    </select>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-sm-12">
                    <button class="btn btn-success btn-block" onclick="submitBarCert(event)">
                        <i class="fas fa-plus"></i> Submit Request
                    </button>
                </div>
            </div>



        </form>

    </div>
    <div class="col-sm-6">
        <center>
            @if($docType == "BARANGAY-CERTIFICATION-REGULAR")
            <img src="{{ asset('assets/images/DocImage/BARANGAY-CERTIFICATION-2026.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
            @elseif($docType == "BARANGAY-CERTIFICATION-FTJS")
            <img src="{{ asset('assets/images/DocImage/BARANGAY-CERTIFICATION-2026-FIRST-TIME-JOB-SEEKER.jpg') }}" style="max-width: 60%; border:1px solid black" class="img-fluid">
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
        const purposeDropdown = document.getElementById("barCertRegPur");

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
