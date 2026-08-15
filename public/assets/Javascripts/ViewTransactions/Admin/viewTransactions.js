function getDateDifference(dateStr) {
    const currentDate = new Date();
    currentDate.setHours(0, 0, 0, 0);

    const targetDate = new Date(dateStr);
    targetDate.setHours(0, 0, 0, 0);

    // Calculate difference in milliseconds
    const diffTime = targetDate - currentDate;

    // Convert to days
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

    return diffDays;
}

function openTransactionModal(transactionCode) {
    $.ajax({
        type: "GET",
        url: "/get-transactions/transaction-code=" + transactionCode,
        success: function (data) {
            $("#SetProcessingModal").modal("show");
        },
    });
}

function setRejectTransaction(event) {
    console.log("clicked");
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/set-reject",
        data: $("#setRejectTransactionForm").serialize(),
        success: function (data) {
            $("#setRejectTransactionForm")[0].reset();
            $("#SetRejectModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Request Rejected",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function setProcessTransaction(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/set-process",
        data: $("#setProcessingTransactionForm").serialize(),
        success: function (data) {
            $("#setProcessingTransactionForm")[0].reset();
            $("#SetProcessingModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Transaction Process",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function setApproveTransaction(event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: baseUrl + "/set-approve",
        data: $("#setApproveTransactionForm").serialize(),
        success: function (data) {
            $("#setApproveTransactionForm")[0].reset();
            $("#SetApproveModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Request Approved",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
        error: function (xhr, status, error) {
            // Handle errors here
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
