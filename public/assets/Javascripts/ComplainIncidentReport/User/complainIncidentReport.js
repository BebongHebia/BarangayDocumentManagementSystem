loadComplaintDescriptions("Public Order & Safety");
function loadComplaintDescriptions(complainType) {
    // Define the descriptions for each complaint type
    const complaintData = {
        "Public Order & Safety": [
            "Noise complaints (e.g., loud videoke, unruly gatherings)",
            "Public intoxication and brawls",
            "Curfew violations",
        ],
        "Property & Neighborhood Disputes": [
            "Boundary conflicts and encroachments",
            "Damage to property",
            "Trespassing and illegal cutting of trees",
        ],
        "Debt & Financial Issues": [
            "Unpaid loans and failure to pay financial obligations",
            "Breach of contract",
        ],
        "Family & Personal Matters": [
            "Minor physical altercations or threats (e.g., Sumbong/Gulo)",
            "Domestic or marital disputes (endorsed to the Violence Against Women and Children Desk if applicable)",
        ],
        "Administrative & Official Complaints": [
            "Neglect of duty or abuse of authority by barangay officials",
            "Misuse of public funds",
            "Environmental and sanitation ordinance violations (e.g., improper waste disposal)",
        ],
    };

    // Get the description dropdown element
    const descriptionDropdown = document.getElementById("description");

    // Clear existing options
    descriptionDropdown.innerHTML = "";

    // Add a default disabled option
    const defaultOption = document.createElement("option");
    defaultOption.textContent = "Select Description";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    descriptionDropdown.appendChild(defaultOption);

    // Get the descriptions for the selected type
    const descriptions = complaintData[complainType] || [];

    // Add new options
    descriptions.forEach(function (description) {
        const option = document.createElement("option");
        option.value = description;
        option.textContent = description;
        descriptionDropdown.appendChild(option);
    });
}

function loadEditComplaintDescriptions(complainType) {
    // Define the descriptions for each complaint type
    const complaintData = {
        "Public Order & Safety": [
            "Noise complaints (e.g., loud videoke, unruly gatherings)",
            "Public intoxication and brawls",
            "Curfew violations",
        ],
        "Property & Neighborhood Disputes": [
            "Boundary conflicts and encroachments",
            "Damage to property",
            "Trespassing and illegal cutting of trees",
        ],
        "Debt & Financial Issues": [
            "Unpaid loans and failure to pay financial obligations",
            "Breach of contract",
        ],
        "Family & Personal Matters": [
            "Minor physical altercations or threats (e.g., Sumbong/Gulo)",
            "Domestic or marital disputes (endorsed to the Violence Against Women and Children Desk if applicable)",
        ],
        "Administrative & Official Complaints": [
            "Neglect of duty or abuse of authority by barangay officials",
            "Misuse of public funds",
            "Environmental and sanitation ordinance violations (e.g., improper waste disposal)",
        ],
    };

    // Get the description dropdown element
    const editDescriptionDropDown = document.getElementById("editDescription");

    // Clear existing options
    editDescriptionDropDown.innerHTML = "";

    // Add a default disabled option
    const defaultOption = document.createElement("option");
    defaultOption.textContent = "Select Description";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    editDescriptionDropDown.appendChild(defaultOption);

    // Get the descriptions for the selected type
    const descriptions = complaintData[complainType] || [];

    // Add new options
    descriptions.forEach(function (description) {
        const option = document.createElement("option");
        option.value = description;
        option.textContent = description;
        editDescriptionDropDown.appendChild(option);
    });
}

displayComplaintIncidentReport();
function displayComplaintIncidentReport() {
    var mainUserCode = $("#mainUserCode").val();
    var userRole = $("#userRole").val();
    $.ajax({
        type: "get",
        url: "/get-complain-incident/usercode=" + mainUserCode,
        success: function (data) {
            let rows = ``;

            if (data.length === 0) {
                rows = `
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No complaint reports found.
                        </div>
                    </div>
                `;
            } else {
                $.each(data, function (index, report) {
                    // Determine status badge color
                    let statusBadge = "";
                    switch (report.status) {
                        case "Pending":
                            statusBadge = "badge-warning";
                            break;
                        case "In Progress":
                            statusBadge = "badge-info";
                            break;
                        case "Resolved":
                            statusBadge = "badge-success";
                            break;
                        case "Rejected":
                            statusBadge = "badge-danger";
                            break;
                        default:
                            statusBadge = "badge-secondary";
                    }

                    // SMS status badge
                    let smsBadge =
                        report.smsStatus === "Sent"
                            ? "badge-success"
                            : "badge-secondary";

                    // Build action buttons based on user role
                    let actionButtons = ``;

                    if (userRole === "User") {
                        // User role: Show only Edit and Delete buttons
                        actionButtons = `
                            <button class="btn btn-sm btn-info" onclick="openEditComplainIncident(${report.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="openDeleteComplainIncident(${report.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        `;
                    } else {
                        // Non-User role: Show Edit, Delete, and Action Taken buttons
                        actionButtons = `
                            <button class="btn btn-sm btn-info" onclick="openEditComplainIncident(${report.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="openDeleteComplainIncident(${report.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                            <button class="btn btn-sm btn-success" onclick="openTakeActionModal(${report.id})">
                                <i class="fas fa-check-circle"></i> Action Taken
                            </button>
                        `;
                    }

                    rows += `
                        <div class="col-sm-3 mb-4">
                            <div class="complainIncidentReportsCard">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-file-alt"></i>
                                        Complaint #${index + 1}
                                        <span class="badge ${statusBadge} float-end">${report.status || "N/A"}</span>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <!-- Complaint Type -->
                                    <div class="complaint-field">
                                        <span class="field-label">
                                            <i class="fas fa-tag"></i> Complaint Type:
                                        </span>
                                        <span class="field-value">${report.complainType || "N/A"}</span>
                                    </div>

                                    <!-- Description -->
                                    <div class="complaint-field">
                                        <span class="field-label">
                                            <i class="fas fa-align-left"></i> Description:
                                        </span>
                                        <span class="field-value">${report.description || "N/A"}</span>
                                    </div>

                                    <!-- Respondent -->
                                    <div class="complaint-field">
                                        <span class="field-label">
                                            <i class="fas fa-user"></i> Respondent:
                                        </span>
                                        <span class="field-value">${report.respondent || "N/A"}</span>
                                    </div>

                                    <!-- SMS Status -->
                                    <div class="complaint-field">
                                        <span class="field-label">
                                            <i class="fas fa-sms"></i> SMS Status:
                                        </span>
                                        <span class="badge ${smsBadge}">${report.smsStatus || "Not Sent"}</span>
                                    </div>

                                    <!-- SMS Message (if available) -->
                                    ${
                                        report.smsMessage
                                            ? `
                                    <div class="complaint-field">
                                        <span class="field-label">
                                            <i class="fas fa-envelope"></i> SMS Message:
                                        </span>
                                        <span class="field-value sms-message">${report.smsMessage}</span>
                                    </div>
                                    `
                                            : ""
                                    }

                                    <!-- Action Buttons -->
                                    <div class="complaint-actions mt-3">
                                        ${actionButtons}
                                    </div>
                                </div>
                                <div class="card-footer text-muted">
                                    <small>
                                        <i class="fas fa-clock"></i>
                                        Reported: ${report.created_at ? new Date(report.created_at).toLocaleDateString() : "N/A"}
                                    </small>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            $("#complainIncidentContainer").html(rows);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching complaint reports:", error);
            $("#complainIncidentContainer").html(`
                <div class="col-12 text-center">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        Failed to load complaint reports. Please try again.
                    </div>
                </div>
            `);
        },
    });
}

function actionTakenComplainIncident(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/action-complain-incident-report",
        data: $("#takenComplainIncidentReportForm").serialize(),
        success: function (data) {
            $("#takenComplainIncidentReportForm")[0].reset();
            $("#ActionTakenModal").modal("hide");
            displayComplaintIncidentReport();
            swal.fire({
                title: "Success",
                text: "Complain Action Taken successfully",
                icon: "success",
            });
        },
    });
}

function addComplainIncident(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/add-complain-incident-report",
        data: $("#createComplainIncidentReportForm").serialize(),
        success: function (data) {
            $("#createComplainIncidentReportForm")[0].reset();
            $("#CreateComplainIncidentReport").modal("hide");
            displayComplaintIncidentReport();
            swal.fire({
                title: "Success",
                text: "Complain Added successfully",
                icon: "success",
            });
        },
    });
}

function editComplainIncident(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/edit-complain-incident-report",
        data: $("#editComplainIncidentReportForm").serialize(),
        success: function (data) {
            $("#editComplainIncidentReportForm")[0].reset();
            $("#EditComplainIncidentReport").modal("hide");
            displayComplaintIncidentReport();
            swal.fire({
                title: "Success",
                text: "Complain Edited successfully",
                icon: "success",
            });
        },
    });
}

function deleteComplainIncident(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/delete-complain-incident-report",
        data: $("#deleteComplainIncidentReportForm").serialize(),
        success: function (data) {
            $("#deleteComplainIncidentReportForm")[0].reset();
            $("#DeleteComplainIncidentReport").modal("hide");
            displayComplaintIncidentReport();
            swal.fire({
                title: "Success",
                text: "Complain Removed successfully",
                icon: "success",
            });
        },
    });
}

function openTakeActionModal(complainIncidentId) {
    $.ajax({
        type: "get",
        url:
            baseUrl +
            "/get-complain-incident-report/complaintIncident-id=" +
            complainIncidentId,
        success: function (data) {
            $("#actionComplainIncidentId").val(data.id);
            $("#actionComplainType").val(data.complainType);
            $("#actionDescription").val(data.description);
            $("#actionRespondense").val(data.respondent);
        },
    });

    $("#ActionTakenModal").modal("show");
}

function openDeleteComplainIncident(complainIncidentId) {
    $.ajax({
        type: "get",
        url:
            baseUrl +
            "/get-complain-incident-report/complaintIncident-id=" +
            complainIncidentId,
        success: function (data) {
            $("#deleteComplainIncidentId").val(data.id);
        },
    });

    $("#DeleteComplainIncidentReport").modal("show");
}

function openEditComplainIncident(complainIncidentId) {
    $.ajax({
        type: "get",
        url:
            baseUrl +
            "/get-complain-incident-report/complaintIncident-id=" +
            complainIncidentId,
        success: function (data) {
            $("#editComplainIncidentId").val(data.id);
            $("#editComplainType").val(data.complainType);
            loadEditComplaintDescriptions(data.complainType);
            $("#editDescription").val(data.description).trigger("change");
            $("#editRespondent").val(data.respondent);
        },
    });

    $("#EditComplainIncidentReport").modal("show");
}
