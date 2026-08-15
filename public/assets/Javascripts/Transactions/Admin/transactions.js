displayTransactions();

function addTransaction(event) {
    event.preventDefault();
    $.ajax({
        type: "post",
        url: baseUrl + "/submit-request",
        data: $("#addTransactionForm").serialize(),
        success: function (data) {
            $("#addTransactionForm")[0].reset();
            $("#CreateTransactionModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Transaction Deleted Successfully",
                icon: "success",
            });
        },
    });
}

function displayTransactions() {
    var mainUserCode = $("#mainUserCode").val();
    $.ajax({
        type: "get",
        url: "/get-transactions/user-code=" + mainUserCode,
        success: function (data) {
            let rows = "";
            let counter = 0;
            let statusRow = "";

            let actionBtns = "";

            $.each(data, function (index, transactions) {
                var cusRemarks = truncateString(transactions.remarks, 30);
                if (transactions.status == "Pending") {
                    statusRow = `
                        <span style="padding:3px; border-radius:5px; color:white; background-color: orange"><i class="fas fa-undo"></i> Pending</span>
                    `;

                    actionBtns = `
                        <button class="btn btn-warning btn-sm" onclick="openEditTransactionModal(${transactions.code})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="openDeleteTransactionModal('${transactions.code}')">
                            <i class="fas fa-trash"></i>
                        </button>

                        <a href="/view-transaction/transaction-code=${transactions.code}" class="btn btn-info btn-sm">
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    `;
                } else if (transactions.status == "Processing") {
                    statusRow = `
                        <span style="padding:3px; border-radius:5px; color:white; background-color: blue"><i class="fas fa-spinner"></i> Processing</span>
                    `;
                    actionBtns = `
                        <button class="btn btn-warning btn-sm" onclick="openEditTransactionModal(${transactions.code})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="openDeleteTransactionModal('${transactions.code}')">
                            <i class="fas fa-trash"></i>
                        </button>

                        <a href="/view-transaction/transaction-code=${transactions.code}" class="btn btn-info btn-sm">
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    `;
                } else if (transactions.status == "Approved") {
                    statusRow = `
                        <span style="padding:3px; border-radius:5px; color:white; background-color: green"><i class="fas fa-check"></i> Approved</span>
                    `;
                    actionBtns = `


                        <button class="btn btn-success btn-sm" onclick="openPrintModal(${transactions.code})">
                            <i class="fas fa-arrow-right"></i>
                        </button>

                        <button class="btn btn-dark btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>

                    `;
                } else if (transactions.status == "Completed") {
                    statusRow = `
                        <span style="padding:3px; border-radius:5px; color:white; background-color: green"><i class="fas fa-check"></i> Completed</span>
                    `;
                    actionBtns = `

                        <button class="btn btn-dark btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>

                    `;
                } else {
                    statusRow = `
                        <span style="padding:3px; border-radius:5px; color:white; background-color: red"><i class="fas fa-ban"></i> Rejected</span>
                    `;
                    actionBtns = `


                        <button class="btn btn-dark btn-sm">
                            <i class="fas fa-eye"></i>
                        </button>

                    `;
                }

                counter++;
                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${transactions.code}</td>
                        <td>${transactions.user.completeName}</td>
                        <td>${transactions.type}</td>
                        <td>${transactions.dateCreated}</td>
                        <td>${cusRemarks}</td>
                        <td>${statusRow}</td>
                        <td>
                           ${actionBtns}
                        </td>
                    </tr>

                `;
            });

            $("#TransactionTableBody").html(rows);
        },
    });
}

function loadOrNo() {
    $.ajax({
        type: "get",
        url: baseUrl + "/load-latest-or-no",
        success: function (data) {
            let orNo = data ? data.orNo : "00000";
            $("#orNo").val(orNo + 1);
        },
    });
}

function openPrintModal(transactionId) {
    loadOrNo();
    $.ajax({
        type: "GET",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            $("#adminPrintTransaction_userCode").val(data.user.userCode);
            $("#adminPrintTransaction_transactionCode").val(data.code);
            $("#adminPrintTransaction_dateSched").val(data.dateSched);

            let cedulaNo = data.cedula
                ? data.cedula.cedulaNo
                : "No Cedula/Expired";
            let dateAcquired = data.cedula
                ? data.cedula.dateAcquired
                : "No Cedula / Expired";

            let cedValidity = data.cedula
                ? data.cedula.validity
                : "No Cedula / Expired";

            $("#cedulaNo").val(cedulaNo);
            $("#dateAcquired").val(dateAcquired);
        },
    });

    $("#PrintTransactionModal").modal("show");
}

function payTransaction(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/print-pay-transaction",
        data: $("#payTransactionForm").serialize(),
        success: function (data) {
            $("#payTransactionForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Success Transaction Completed",
                icon: "success",
            }).then((result) => {
                // Redirect after SweetAlert closes
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
            $("#PrintTransactionModal").modal("hide");
        },
        error: function (xhr, status, error) {
            let errorMessage =
                "Invalid Process. Please check input forms and try again";
            swal.fire({
                title: "Error",
                text: errorMessage,
                icon: "error",
                confirmButtonColor: "#d33",
            });
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

function deleteBarIndigent(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-barangay-indigent",
        data: $("#deleteBarIndigentForm").serialize(),
        success: function (data) {
            $("#deleteBarIndigentForm")[0].reset();
            $("#DeleteBarIndigentModal").modal("hide");
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
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
            displayTransactions();
            swal.fire({
                title: "Success",
                text: "Request Removed Successfully",
                icon: "success",
            });
        },
    });
}

function truncateString(str, maxLength, suffix = "...") {
    if (!str) return "";
    if (str.length <= maxLength) return str;
    return str.substring(0, maxLength) + suffix;
}

function loadUsers(docType) {
    event.preventDefault();
    $.ajax({
        type: "get",
        url: baseUrl + "/get-users/user-residents",
        success: function (data) {
            let rows = "";
            $.each(data, function (index, users) {
                rows += `
                    <option value="${users.userCode}">${users.completeName}</option>
                `;
            });

            $("#adminCreateTransactionUserCode").html(rows);
        },
    });

    if (docType == "ATTESTATION") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/ATTESTATION-2026.jpg",
        );
    } else if (docType == "BARANGAY-CERTIFICATION-REGULAR") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/BARANGAY-CERTIFICATION-2026.jpg",
        );
    } else if (docType == "BARANGAY-CERTIFICATION-FTJS") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/BARANGAY-CERTIFICATION-2026-FIRST-TIME-JOB-SEEKER.jpg",
        );
    } else if (docType == "BARANGAY-CLEARANCE") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/BARANGAY-CLEARANCE-2026.jpg",
        );
    } else if (docType == "BARANGAY-IDENTIFICATION") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/BARANGAY-IDENTIFICATION-2026.jpg",
        );
    } else if (docType == "BARANGAY-INDIGENCY-REGULAR") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/BARANGAY-INDIGENCY-2026-NEW-Copy.jpg",
        );
    } else if (docType == "BARANGAY-INDIGENCY-WITH-PATIENT-NAME") {
        $("#adminCreateTransactionResImg").attr(
            "src",
            "assets/images/DocImage/BARANGAY-INDIGENCY-2026-WITH-PATIENT-NAME.jpg",
        );
    }
}

function loadSelectedUserDetails(userCode) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-user/user-code=" + userCode,
        success: function (data) {
            if (data.profile_pic == null) {
                $("#adminSelectedUserImage").attr(
                    "src",
                    "assets/images/dummyLogo.png",
                );
            } else {
                $("#adminSelectedUserImage").attr(
                    "src",
                    "storage/" + data.profile_pic.path,
                );
            }

            $("#adminCreateTransactionSelectedUserUserCode").val(data.userCode);
            $("#adminCreateTransactionSelectedUserName").val(data.completeName);
            $("#adminCreateTransactionSelectedUserSex").val(data.sex);
            $("#adminCreateTransactionSelectedUserBday").val(data.bday);
            $("#adminCreateTransactionSelectedCivilStatus").val(
                data.civilStatus,
            );
            $("#adminCreateTransactionSelectedSector").val(data.purok);
        },
    });
}

function redirectToDocument() {
    var userCode = $("#adminCreateTransactionUserCode").val();
    var documentType = $("#adminCreateTransactionDocType").val();

    console.log(userCode);

    if (!userCode || !documentType) {
        alert("Please select both a resident and a document type.");
        return;
    }
    var url =
        "/request-document/docType=" +
        encodeURIComponent(documentType) +
        "/user-code=" +
        encodeURIComponent(userCode);
    window.location.href = url;
}
