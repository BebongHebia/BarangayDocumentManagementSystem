// Toggle Barangay Indigency Panels
function toggleBarIndiPanels() {
    var selectedType = document.getElementById("barIndiType").value;
    var regularPanel = document.getElementById("regularIndiPanel");
    var withPatientPanel = document.getElementById("withPatientNamePanel");

    // Hide both panels
    regularPanel.style.display = "none";
    withPatientPanel.style.display = "none";

    // Show the selected panel
    if (selectedType === "Regular") {
        regularPanel.style.display = "block";
    } else if (selectedType === "With Patient Name") {
        withPatientPanel.style.display = "block";
    }
}

// Submit functions
function submitRegularIndigency() {
    alert("Requesting Regular Indigency Certificate");
    // Add your form submission logic here
}

function submitWithPatientName() {
    var patientName = document.getElementById("patientName").value;
    var patientAge = document.getElementById("patientAge").value;
    var relationship = document.getElementById("patientRelationship").value;
    var medicalCondition = document.getElementById("medicalCondition").value;

    if (!patientName || !patientAge || !medicalCondition) {
        alert("Please fill in all required fields");
        return;
    }

    alert(
        "Requesting Indigency with Patient Name:\n" +
            "Patient: " +
            patientName +
            "\n" +
            "Age: " +
            patientAge +
            "\n" +
            "Relationship: " +
            relationship +
            "\n" +
            "Condition: " +
            medicalCondition,
    );
    // Add your form submission logic here
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", function () {
    toggleBarIndiPanels();
});

// Toggle Barangay Certification Panels
function toggleBarCertPanels() {
    var selectedType = document.getElementById("barCertType").value;
    var regularPanel = document.getElementById("regularCertPanel");
    var jobSeekerPanel = document.getElementById("firstTimeJobSeekerPanel");

    // Hide both panels
    regularPanel.style.display = "none";
    jobSeekerPanel.style.display = "none";

    // Show the selected panel
    if (selectedType === "Regular") {
        regularPanel.style.display = "block";
    } else if (selectedType === "First Time Job-Seeker") {
        jobSeekerPanel.style.display = "block";
    }
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", function () {
    toggleBarCertPanels();
});

// Initialize on page load
document.addEventListener("DOMContentLoaded", function () {
    toggleBarCertPanels();
});
// Function to calculate age
function calculateAge(birthdate) {
    if (!birthdate) return "";

    var birthDate = new Date(birthdate);
    var today = new Date();

    var age = today.getFullYear() - birthDate.getFullYear();
    var monthDiff = today.getMonth() - birthDate.getMonth();

    // If birthday hasn't occurred yet this year, subtract 1
    if (
        monthDiff < 0 ||
        (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
        age--;
    }

    return age;
}

function toggleDocumentPanels(selectedType) {
    // Hide all panels
    document.getElementById("attestationContainer").style.display = "none";
    document.getElementById("barCertPanel").style.display = "none";
    document.getElementById("barClerPanel").style.display = "none";
    document.getElementById("barIdenPanel").style.display = "none";
    document.getElementById("barIndiPanel").style.display = "none";

    // Show selected panel
    switch (selectedType) {
        case "ATTESTATION":
            document.getElementById("attestationContainer").style.display =
                "block";
            break;
        case "BARANGAY CERTIFICATION":
            document.getElementById("barCertPanel").style.display = "block";
            break;
        case "BARANGAY CLEARANCE":
            document.getElementById("barClerPanel").style.display = "block";
            break;
        case "BARANGAY IDENTIFICATION":
            document.getElementById("barIdenPanel").style.display = "block";
            break;
        case "BARANGAY INDIGENCY":
            document.getElementById("barIndiPanel").style.display = "block";
            break;
    }
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", function () {
    var docTypeSelect = document.getElementById("docType");

    // Set initial selection
    toggleDocumentPanels(docTypeSelect.value);

    // Add change event
    docTypeSelect.addEventListener("change", function () {
        toggleDocumentPanels(this.value);
    });
});

function loadPurposes(purposeType) {
    // Define the purposes for each category
    const purposeData = {
        "Employment & Career": [
            "Local job applications",
            "First-time job seekers (under RA 11261 for free government services)",
            "Overseas employment (OFW requirements)",
            "Professional regulation commission (PRC) exam or licensing",
        ],
        "Business & Financial": [
            "New business permit application (Barangay Business Clearance)",
            "Annual business permit renewal",
            "Microfinance or commercial bank loan applications",
            "Opening a personal or corporate bank account",
        ],
        "Government Assistance & Social Services": [
            "Medical financial assistance (for DSWD, PCSO, or Malasakit Centers)",
            "Educational financial assistance, scholarships, or tuition waivers",
            "Burial or funeral assistance",
            "Local social welfare and emergency relief programs",
        ],
        "Government IDs & Clearances": [
            "National Police Clearance application",
            "NBI Clearance application",
            "Philippine Passport application (DFA)",
            "Establishing residency for Voter's Registration",
        ],
        "Civil, Legal & General Use": [
            "Proof of residency for utility connections (water, electricity, internet)",
            "Proof of residency for purchasing a vehicle or property",
            "Marriage license application",
            "Local construction or building permit (Certificate of No Objection)",
            "Certificate of Good Moral Character for school or legal matters",
        ],
    };

    // Get the purpose dropdown element
    const purposeDropdown = document.getElementById("purpose");

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
    purposes.forEach(function (purpose) {
        const option = document.createElement("option");
        option.value = purpose;
        option.textContent = purpose;
        purposeDropdown.appendChild(option);
    });
}
