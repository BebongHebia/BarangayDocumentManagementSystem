displayUserDetails();

// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM loaded - script running");

    // Get elements
    const documentTypeSelect = document.getElementById("documentType");
    const cardIndigency = document.getElementById("cardIndigency");
    const cardClearance = document.getElementById("cardClearance");
    const cardCertification = document.getElementById("cardCertification");
    const noDocumentSelected = document.getElementById("noDocumentSelected");

    // Function to hide all document cards
    function hideAllCards() {
        if (cardIndigency) cardIndigency.style.display = "none";
        if (cardClearance) cardClearance.style.display = "none";
        if (cardCertification) cardCertification.style.display = "none";
    }

    // Function to show selected document card
    function showDocumentCard(documentValue) {
        console.log("Showing document:", documentValue);

        // Hide all cards first
        hideAllCards();

        // Hide the "no document selected" message
        if (noDocumentSelected) {
            noDocumentSelected.style.display = "none";
        }

        // Show the selected card
        switch (documentValue) {
            case "Certificate of Indigency":
                if (cardIndigency) {
                    cardIndigency.style.display = "block";
                    console.log("Showing Certificate of Indigency");
                }
                break;
            case "Barangay Clearance":
                if (cardClearance) {
                    cardClearance.style.display = "block";
                    console.log("Showing Barangay Clearance");
                }
                break;
            case "Barangay Certification":
                if (cardCertification) {
                    cardCertification.style.display = "block";
                    console.log("Showing Barangay Certification");
                }
                break;
            default:
                if (noDocumentSelected) {
                    noDocumentSelected.style.display = "block";
                    console.log("No document selected");
                }
                break;
        }
    }

    // Add event listener to document type select
    if (documentTypeSelect) {
        // For regular select change
        documentTypeSelect.addEventListener("change", function (e) {
            console.log("Document type changed to:", this.value);
            showDocumentCard(this.value);
        });

        // Also trigger on page load if there's a value
        if (
            documentTypeSelect.value &&
            documentTypeSelect.value !== "Please Select Document Type"
        ) {
            showDocumentCard(documentTypeSelect.value);
        }
    }

    // Auto-calculate age based on birthdate
    const birthdateInput = document.getElementById("birthdate");
    const ageInput = document.getElementById("age");

    if (birthdateInput && ageInput) {
        birthdateInput.addEventListener("change", function () {
            if (this.value) {
                const birthDate = new Date(this.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();

                if (
                    monthDiff < 0 ||
                    (monthDiff === 0 && today.getDate() < birthDate.getDate())
                ) {
                    age--;
                }

                ageInput.value = age;
            }
        });
    }

    // Submit request button handler
    const submitBtn = document.getElementById("submitRequestBtn");
    if (submitBtn) {
        submitBtn.addEventListener("click", function (e) {
            e.preventDefault();

            const documentType = documentTypeSelect
                ? documentTypeSelect.value
                : "";
            const completeName = document.getElementById("completeName")
                ? document.getElementById("completeName").value
                : "";
            const birthdate = document.getElementById("birthdate")
                ? document.getElementById("birthdate").value
                : "";
            const age = document.getElementById("age")
                ? document.getElementById("age").value
                : "";
            const civilStatus = document.getElementById("civilStatus")
                ? document.getElementById("civilStatus").value
                : "";
            const sex = document.getElementById("sex")
                ? document.getElementById("sex").value
                : "";
            const address = document.getElementById("address")
                ? document.getElementById("address").value
                : "";

            // Validation
            if (
                !documentType ||
                documentType === "Please Select Document Type"
            ) {
                alert("Please select a document type");
                return;
            }

            if (!completeName) {
                alert("Please enter complete name");
                return;
            }

            if (!address) {
                alert("Please enter address");
                return;
            }

            const formData = {
                document_type: documentType,
                complete_name: completeName,
                birthdate: birthdate,
                age: age,
                civil_status: civilStatus,
                sex: sex,
                address: address,
                _token: document.querySelector('input[name="_token"]')
                    ? document.querySelector('input[name="_token"]').value
                    : "",
            };
        });
    }
});

function displayUserDetails() {
    var userCode = $("#userCode").val();

    $.ajax({
        type: "get",
        url: "/get-profile-details/user-code=" + userCode,
        success: function (data) {
            var age = calculateAge(data.bday);
            $("#completeName").val(data.completeName);
            $("#birthdate").val(data.bday);
            $("#civilStatus").val(data.civilStatus).trigger("change");
            $("#sex").val(data.sex).trigger("change");
            $("#age").val(age);
            $("#address").val(data.purok + "," + data.currentAddress);
        },
    });
}

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

function addRequest(event) {
    $.ajax({
        type: "POST",
        url: baseUrl + "/submit-request",
        data: $("#addRequestForm").serialize(),
        success: function (data) {
            $("#addRequestForm")[0].reset();
            swal.fire({
                title: "Success",
                text: data.message || "Request Added successfully",
                icon: "success",
            }).then((result) => {
                // Redirect after SweetAlert closes
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
        error: function (xhr, status, error) {
            swal.fire({
                title: "Error",
                text: "Something went wrong",
                icon: "error",
            });
        },
    });
}

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
