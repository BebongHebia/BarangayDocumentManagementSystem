displayTransaction();

function displayTransaction() {
    var mainUserCode = $("#mainUserCode").val();
    $.ajax({
        type: "get",
        url: "/get-transactions/user-code=" + mainUserCode,
        success: function (data) {
            let rows = "";

            let counter = 0;

            let imgNo = "";

            $.each(data, function (index, transactions) {
                counter++;

                if (transactions.type == "Barangay Clearance") {
                    imgNo = "doc1";
                }

                // Determine which buttons to show based on status
                let actionButtons = "";
                if (transactions.status === "Pending") {
                    // Show all three buttons for Pending status
                    actionButtons = `
                        <button class="btn btn-primary btn-sm" onclick="openViewTransactionModal(${transactions.code});">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm" onclick="openEditTransactionModal(${transactions.code})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="openDeleteTransactionModal(${transactions.code})">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                } else {
                    // Show only view button for other statuses
                    actionButtons = `
                        <button class="btn btn-primary btn-sm" onclick="openViewTransactionModal(${transactions.code})">
                            <i class="fas fa-eye"></i>
                        </button>
                    `;
                }

                // OPTION 1: Using Bootstrap badge with getStatusColor()
                // let statusClass = getStatusColor(transactions.status);
                // let statusDisplay = `<span class="badge ${statusClass}">${transactions.status}</span>`;

                // OPTION 2: Using custom colored badge with getStatusConfig()
                // Uncomment the lines below and comment the line above if you want to use custom colors
                let statusConfig = getStatusConfig(transactions.status);
                let statusDisplay = `<span style="background-color: ${statusConfig.bgColor}; color: ${statusConfig.textColor}; padding: 5px 10px; border-radius: 4px; font-weight: 500;">
                                        ${statusConfig.icon} ${transactions.status}
                                     </span>`;

                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${transactions.code}</td>
                        <td>${transactions.type}</td>
                        <td>${transactions.dateCreated}</td>
                        <td>${statusDisplay}</td>
                        <td>${actionButtons}</td>
                    </tr>
                `;
            });

            $("#transactionTableBody").html(rows);
        },
        error: function (xhr, status, error) {
            console.error("Error fetching transactions:", error);
            $("#transactionTableBody").html(
                '<tr><td colspan="7" class="text-center text-danger">Error loading transactions</td></tr>',
            );
        },
    });
}

function openDeleteTransactionModal(transactionId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            if (data.type == "Attestation") {
                $("#deleteTransAttestationId").val(data.attestation_details.id);
                $("#DeleteAttestationModal").modal("show");
            } else if (
                data.type == "Barangay Certification - Regular" ||
                data.type == "Barangay Certification - First Time Job Seeker"
            ) {
                $("#deleteBarCertRegTransactionId").val(
                    data.bar_cert_reg_details.id,
                );
                $("#DeleteBarCertRegModal").modal("show");
            } else if (data.type == "Barangay Clearance") {
                $("#deleteBarClearId").val(data.bar_clear_details.id);
                $("#DeleteBarClearModal").modal("show");
            } else if (data.type == "Barangay Identification") {
                $("#deleteBarIdenId").val(data.bar_iden_details.id);
                $("#DeleteBarangayIdenModal").modal("show");
            } else if (
                data.type == "Barangay Indigency - Regular" ||
                data.type == "Barangay Indigency - Patient Name"
            ) {
                $("#deleteBarIndigentId").val(data.bar_indigent_details.id);
                $("#DeleteBarIndigentModal").modal("show");
            }
        },
    });
}

function openEditTransactionModal(transactionId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            if (data.type == "Attestation") {
                $("#editTransAttestationId").val(data.attestation_details.id);
                $("#editAttestationName").val(data.user.completeName);
                $("#editAttestationAge").val(data.attestation_details.age);
                $("#editAttestationStatus")
                    .val(data.attestation_details.status)
                    .trigger("change");
                $("#editAttestationMonthlyIncome")
                    .val(data.attestation_details.income)
                    .trigger("change");
                $("#editAttestationAssistanceType")
                    .val(data.attestation_details.typeOfAssistance)
                    .trigger("change");
                $("#editAttestationTotalMonthlyHousholdExpense").val(
                    data.attestation_details.totalMonthlyHousholdExpense,
                );

                $("#EditAttestationModal").modal("show");
            } else if (
                data.type == "Barangay Certification - Regular" ||
                data.type == "Barangay Certification - First Time Job Seeker"
            ) {
                $("#editBarCertRegTransactionId").val(
                    data.bar_cert_reg_details.id,
                );
                $("#editBarCertRegSector")
                    .val(data.bar_cert_reg_details.sector)
                    .trigger("change");

                $("#editBarCertRegResidentYears")
                    .val(data.bar_cert_reg_details.residentYears)
                    .trigger("change");

                $("#editBarCertRegisFirstTimeJobSeeker").val(
                    data.bar_cert_reg_details.isFirstTimeJobSeeker,
                );

                $("#editBarCertRegPurType")
                    .val(data.bar_cert_reg_details.purposeType)
                    .trigger("change");

                loadPurposeBarCertReg(data.bar_cert_reg_details.purposeType);
                $("#editBarCertRegPur")
                    .val(data.bar_cert_reg_details.purpose)
                    .trigger("change");
                $("#EditBarCertRegModal").modal("show");
            } else if (data.type == "Barangay Clearance") {
                $("#editBarClearId").val(data.bar_clear_details.id);
                $("#editBarClearSector").val(data.bar_clear_details.sector);
                $("#editBarClerPurType")
                    .val(data.bar_clear_details.purposeType)
                    .trigger("change");
                loadPurposeBarClear(data.bar_clear_details.purposeType);
                $("#editBarClearPur")
                    .val(data.bar_clear_details.purpose)
                    .trigger("change");

                $("#EditBarClearModal").modal("show");
            } else if (data.type == "Barangay Identification") {
                $("#editName").val(data.user.completeName);
                $("#editSector").val(data.user.purok);
                $("#EditBarIdenModal").modal("show");
            } else if (
                data.type == "Barangay Indigency - Regular" ||
                data.type == "Barangay Indigency - Patient Name"
            ) {
                $("#editBarIndigentId").val(data.bar_indigent_details.id);
                $("#editBarIndigentName").val(data.user.completeName);
                $("#editBarIndigentSector").val(data.user.purok);
                $("#editBarIndigentIsAuthorized").val(
                    data.bar_indigent_details.isAuthorized,
                );
                $("#editBarIndigentType").val(data.type);
                $("#editBarIndigentAuthorized").val(
                    data.bar_indigent_details.authorized,
                );
                $("#editBarIndigentRelation").val(
                    data.bar_indigent_details.relation,
                );

                $("#editBarIndigentPurType")
                    .val(data.bar_indigent_details.purposeType)
                    .trigger("change");

                loadBarIndigentPurposes(data.bar_indigent_details.purposeType);
                $("#editBarIndiPur")
                    .val(data.bar_indigent_details.purpose)
                    .trigger("change");
                $("#EditBarIndigentModal").modal("show");
            }
        },
    });
}

function deleteBarIndigent(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-barangay-indigent",
        data: $("#deleteBarIndigentForm").serialize(),
        success: function (data) {
            $("#deleteBarIndigentForm")[0].reset();
            $("#DeleteBarIndigentModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Removed Successfully",
                icon: "success",
            });
        },
    });
}

function editBarIndigent(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-barangay-indigent",
        data: $("#editBarIndigentForm").serialize(),
        success: function (data) {
            $("#editBarIndigentForm")[0].reset();
            $("#EditBarIndigentModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Edited Successfully",
                icon: "success",
            });
        },
    });
}

function deleteBarIden(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-barangay-identification",
        data: $("#deleteBarangayIdenForm").serialize(),
        success: function (data) {
            $("#deleteBarangayIdenForm")[0].reset();
            $("#DeleteBarangayIdenModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Removed Successfully",
                icon: "success",
            });
        },
    });
}

function deleteBarClear(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-barangay-clearance",
        data: $("#deleteBarClearForm").serialize(),
        success: function (data) {
            $("#deleteBarClearForm")[0].reset();
            $("#DeleteBarClearModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Removed Successfully",
                icon: "success",
            });
        },
    });
}

function editBarClear(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-barangay-clearance",
        data: $("#editBarClearForm").serialize(),
        success: function (data) {
            $("#editBarClearForm")[0].reset();
            $("#EditBarClearModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Edited Successfully",
                icon: "success",
            });
        },
    });
}

function deleteAttestation(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-attestation",
        data: $("#deleteAttestationForm").serialize(),
        success: function (data) {
            $("#deleteAttestationForm")[0].reset();
            $("#DeleteAttestationModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Document Deleted Successfully",
                icon: "success",
            });
        },
    });
}

function editAttestation(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-attestation",
        data: $("#editAttestationForm").serialize(),
        success: function (data) {
            $("#editAttestationForm")[0].reset();
            $("#EditAttestationModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Document Edited Successfully",
                icon: "success",
            });
        },
    });
}

function editBarCertReg(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-bar-cert-reg",
        data: $("#editBarCertRegForm").serialize(),
        success: function (data) {
            $("#editBarCertRegForm")[0].reset();
            $("#EditBarCertRegModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Edited Successfully",
                icon: "success",
            });
        },
    });
}

function deleteBarCertReg(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-bar-cert-reg",
        data: $("#deleteBarCertRegForm").serialize(),
        success: function (data) {
            $("#deleteBarCertRegForm")[0].reset();
            $("#DeleteBarCertRegModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Request Removed Successfully",
                icon: "success",
            });
        },
    });
}
/**
function deleteTransaction(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-transaction",
        data: $("#deleteTransactionForm").serialize(),
        success: function (data) {
            $("#deleteTransactionForm")[0].reset();
            $("#DeleteTransactionModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Transaction Deleted Successfully",
                icon: "success",
            });
        },
    });
}

function editTransaction(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-transaction",
        data: $("#editTransactionForm").serialize(),
        success: function (data) {
            $("#editTransactionForm")[0].reset();
            $("#EditTransactionModal").modal("hide");
            displayTransaction();
            swal.fire({
                title: "Success",
                text: "Transaction Edited Successfully",
                icon: "success",
            });
        },
    });
}

 */

function openViewTransactionModal(transactionId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            if (data.type == "Attestation") {
                $(".viewAttName").html(data.user.completeName);
                $("#viewAttAge").html(data.attestation_details.age);
                $("#viewAttStatus").html(data.attestation_details.status);
                $("#viewAttIncome").html(data.attestation_details.income);
                $("#viewAttTypeOfAssistant").html(
                    data.attestation_details.typeOfAssistance,
                );
                $("#viewAttTotalMonthlyHousholdExpense").html(
                    data.attestation_details.totalMonthlyHousholdExpense,
                );
                $("#ViewAttestationModal").modal("show");
            } else if (data.type == "Barangay Identification") {
                $("#viewBarIdenName").html(data.user.completeName);
                $("#viewBarIdenSector").html(data.bar_iden_details.sector);

                $("#ViewBarIdenModal").modal("show");
            } else if (
                data.type == "Barangay Certification - Regular" ||
                data.type == "Barangay Certification - First Time Job Seeker"
            ) {
                let barCertDocTypeImg = "";
                if (data.type == "Barangay Certification - Regular") {
                    barCertDocTypeImg = `
                        <img src="/assets/images/DocImage/BARANGAY-CERTIFICATION-2026.jpg" class="img-fluid" alt="Barangay Certification - Regular" />
                    `;
                } else if (
                    data.type ==
                    "Barangay Certification - First Time Job Seeker"
                ) {
                    barCertDocTypeImg = `
                        <img src="/assets/images/DocImage/BARANGAY-CERTIFICATION-2026-FIRST-TIME-JOB-SEEKER.jpg" class="img-fluid" alt="Barangay Certification - First Time Job Seeker" />
                    `;
                }

                $("#barCertRegularPanel").css("display", "none");
                $("#barCertFTJSPanel").css("display", "none");

                if (data.type == "Barangay Certification - Regular") {
                    $("#barCertRegularPanel").css("display", "block");
                    $("#viewBarCertRegName").html(data.user.name);
                    $("#viewBarCertRegSector").html(
                        data.bar_cert_reg_details.sector,
                    );
                    $("#viewBarCertRegResidentYears").html(
                        data.bar_cert_reg_details.residentYears,
                    );

                    $("#viewBarCertRegPurpose").html(
                        data.bar_cert_reg_details.purpose,
                    );

                    $("#barBertImageDocType").html(barCertDocTypeImg);
                } else if (
                    data.type ==
                    "Barangay Certification - First Time Job Seeker"
                ) {
                    $("#viewBarCertFTJSName").html(data.user.name);
                    $("#viewBarCertFTJSSector").html(
                        data.bar_cert_reg_details.sector,
                    );
                    $("#viewBarCertFTJSPurpose").html(
                        data.bar_cert_reg_details.purpose,
                    );
                    $("#barCertFTJSPanel").css("display", "block");
                }

                $("#ViewBarCertModal").modal("show");
            } else if (
                data.type == "Barangay Indigency - Regular" ||
                data.type == "Barangay Indigency - Patient Name"
            ) {
                let barIndigentDocTypeImage = "";
                if (data.type == "Barangay Indigency - Regular") {
                    barIndigentDocTypeImage = `
                        <img src="/assets/images/DocImage/BARANGAY-INDIGENCY-2026-NEW-Copy.jpg" class="img-fluid" alt="Barangay Certification - Regular" />
                    `;
                } else if (data.type == "Barangay Indigency - Patient Name") {
                    barIndigentDocTypeImage = `
                        <img src="/assets/images/DocImage/BARANGAY-INDIGENCY-2026-WITH-PATIENT-NAME.jpg" class="img-fluid" alt="Barangay Certification - First Time Job Seeker" />
                    `;
                }
                $("#barIndigetnImageDocType").html(barIndigentDocTypeImage);

                $("#viewBarIndigentRegPanel").css("display", "none");
                $("#viewBarIndigentWPNPanel").css("display", "none");

                if (data.type == "Barangay Indigency - Regular") {
                    //asdasd

                    $(".viewBarIndigentRegName").html(data.user.completeName);
                    $("#viewBarIndigentRegPurpose").html(
                        data.bar_indigent_details.purpose,
                    );
                    $("#viewBarIndigentRegSector").html(
                        data.bar_indigent_details.sector,
                    );

                    $("#viewBarIndigentRegPanel").css("display", "block");
                    $("#ViewBarIndigentModal").modal("show");
                } else if (data.type == "Barangay Indigency - Patient Name") {
                    //asdasdasd
                    $(".viewBarIndigentWPNName").html(data.user.completeName);
                    $("#viewBarIndigentWPNRelation").html(
                        data.bar_indigent_details.relation,
                    );
                    $("#viewBarIndigentWPNAuthorized").html(
                        data.bar_indigent_details.authorized,
                    );
                    $("#viewBarIndigentWPNPurpose").html(
                        data.bar_indigent_details.purpose,
                    );
                    $("#viewBarIndigentWPNSector").html(
                        data.bar_indigent_details.sector,
                    );
                    $("#viewBarIndigentWPNPanel").css("display", "block");
                    $("#ViewBarIndigentModal").modal("show");
                }
            } else if (data.type == "Barangay Clearance") {
                $("#viewBarClearName").html(data.user.completeName);
                $("#viewBarClearSector").html(data.bar_clear_details.sector);
                $("#viewBarClearPurpose").html(data.bar_clear_details.purpose);

                $("#ViewBarClearModal").modal("show");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching transaction:", error);
            alert("Error loading transaction details");
        },
    });

    $("#ViewTransactionModal").modal("show");
}

function getStatusBadgeClass(status) {
    switch (status.toLowerCase()) {
        case "completed":
        case "approved":
        case "success":
            return "badge-success";
        case "pending":
            return "badge-warning";
        case "processing":
            return "badge-info";
        case "cancelled":
        case "rejected":
        case "failed":
            return "badge-danger";
        case "refunded":
            return "badge-secondary";
        default:
            return "badge-primary";
    }
}

// Helper function to determine Bootstrap badge color
function getStatusColor(status) {
    switch (status.toLowerCase()) {
        case "completed":
        case "approved":
        case "success":
            return "badge-success";
        case "pending":
        case "processing":
            return "badge-warning";
        case "cancelled":
        case "rejected":
        case "failed":
            return "badge-danger";
        case "refunded":
            return "badge-info";
        default:
            return "badge-secondary";
    }
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

// Custom status configuration (kept for reference or future use)
function getStatusConfig(status) {
    const statusLower = status.toLowerCase();

    const configs = {
        completed: {
            bgColor: "#d4edda",
            textColor: "#155724",
            icon: "✓",
        },
        approved: {
            bgColor: "#d4edda",
            textColor: "#155724",
            icon: "✓",
        },
        pending: {
            bgColor: "#fff3cd",
            textColor: "#856404",
            icon: "⏳",
        },
        processing: {
            bgColor: "#fff3cd",
            textColor: "#856404",
            icon: "🔄",
        },
        cancelled: {
            bgColor: "#f8d7da",
            textColor: "#721c24",
            icon: "✗",
        },
        rejected: {
            bgColor: "#f8d7da",
            textColor: "#721c24",
            icon: "✗",
        },
        failed: {
            bgColor: "#f8d7da",
            textColor: "#721c24",
            icon: "⚠",
        },
        refunded: {
            bgColor: "#d1ecf1",
            textColor: "#0c5460",
            icon: "↺",
        },
    };

    return (
        configs[statusLower] || {
            bgColor: "#e2e3e5",
            textColor: "#383d41",
            icon: "•",
        }
    );
}
