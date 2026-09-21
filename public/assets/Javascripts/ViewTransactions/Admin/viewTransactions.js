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

function openPrintModal(transactionId) {
    loadOrNo();
    $.ajax({
        type: "GET",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionId,
        success: function (data) {
          const d = new Date();
            const today = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;

            const dateSchedValue = (!data.dateSched || 
                data.dateSched === "N/A" || 
                data.dateSched === "00/00/0000" || 
                data.dateSched === "00/00/00") 
                    ? today 
                    : data.dateSched;



                
            $("#adminPrintTransaction_userCode").val(data.user.userCode);
            $("#adminPrintTransaction_transactionCode").val(data.code);
            $("#adminPrintTransaction_dateSched").val(dateSchedValue);

            
            console.log("dateSched value:", dateSchedValue);


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