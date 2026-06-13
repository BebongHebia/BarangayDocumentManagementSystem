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
                        <td>${transactions.purpose}</td>
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

function docImage(docType) {
    var img1 = $("#img1").css("display", "none");
    var img2 = $("#img2").css("display", "none");
    var img3 = $("#img3").css("display", "none");

    if (docType == "Barangay Clearance") {
        img3.css("display", "block");
    } else if (docType == "Certificate of Indigency") {
        img1.css("display", "block");
    } else if (docType == "Barangay Certification") {
        img2.css("display", "block");
    }
}

function openDeleteTransactionModal(transactionId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            $("#deleteTransactionId").val(data.id);
        },
    });
    $("#DeleteTransactionModal").modal("show");
}

function openEditTransactionModal(transactionId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            $("#editTransactionId").val(data.id);
            $("#editType").val(data.type).trigger("change");
            $("#editPurpose").val(data.purpose).trigger("change");
        },
    });
    $("#EditTransactionModal").modal("show");
}

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

function openViewTransactionModal(transactionId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
            // Get badge class based on status
            let badgeClass = getStatusBadgeClass(data.status);

            var age = calculateAge(data.user.bday);
            $("#documentCode").html(data.code);
            $("#docType").html(data.type);
            $("#docPurpose").html(data.purpose);
            $("#docCompleteName").html(data.user.completeName);
            $("#docBday").html(data.user.bday);
            $("#docCivilStatus").html(data.user.civilStatus);
            $("#docAge").html(age);
            $("#docSex").html(data.user.sex);
            $("#docAddress").html(
                data.user.purok + ", " + data.user.currentAddress,
            );

            // Display status with Bootstrap badge
            $("#docStatus").html(
                `<span class="badge ${badgeClass}">${data.status}</span>`,
            );

            docImage(data.type);
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
