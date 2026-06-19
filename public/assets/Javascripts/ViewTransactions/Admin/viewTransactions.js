displayTransactionDetail();
function displayTransactionDetail() {
    var transactionCode = $("#transactionCode").val();

    $.ajax({
        type: "get",
        url: "/get-transactions/transaction-code=" + transactionCode,
        success: function (data) {
            $("#completeName").val(data.user.completeName);
            $("#transactionId").val(data.id);
            $("#bday").val(data.user.bday);
            $("#sex").val(data.user.sex).trigger("change");
            $("#civilStatus").val(data.user.civilStatus).trigger("change");
            $("#placeOfBirth").val(data.user.placeOfBirth);
            $("#citizenship").val(data.user.citizenship);
            $("#profession").val(data.user.profession);
            $("#phone").val(data.user.phone);
            $("#purok").val(data.user.purok);
            $("#currentAddress").val(data.user.currentAddress);
            $("#remarks").val(data.remarks);
            $("#userCode").val(data.user.userCode);
        },
    });
}

function setProcessing(event) {
    $.ajax({
        type: "POST",
        url: baseUrl + "/process-request",
        data: $("#actionTransactionForm").serialize(),
        success: function (data) {
            $("#actionTransactionForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Request Status Updated successfully",
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

function openApproveTransactionModal(transactionCode) {
    console.log(transactionCode);

    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionCode,
        success: function (data) {
            $("#aprTransactionCode").val(data.code);
            $("#aprUserCode").val(data.user.userCode);
        },
    });
    $("#SetApproveModal").modal("show");
}

function openRejectTransactionModal(transactionCode) {
    console.log(transactionCode);

    $.ajax({
        type: "get",
        url: baseUrl + "/get-transactions/transaction-code=" + transactionCode,
        success: function (data) {
            $("#rejTransactionCode").val(data.code);
            $("#rejUserCode").val(data.user.userCode);
        },
    });
    $("#SetRejectModal").modal("show");
}
getLatestCedulaNo();
getLatestORNo();

function getLatestCedulaNo() {
    $.ajax({
        type: "get",
        url: "/get-latest-ced-or-no",
        success: function (data) {
            if (data == null) {
                $("#cedulaNo").val(0);
            } else {
                if (data.cedulaNo == "" || data.cedulaNo == null) {
                    $("#cedulaNo").val(1);
                } else {
                    $("#cedulaNo").val(data.cedulaNo + 1);
                }
            }
        },
    });
}

function getLatestORNo() {
    $.ajax({
        type: "get",
        url: "/get-latest-ced-or-no",
        success: function (data) {
            if (data == null) {
                $("#orNo").val(0);
            } else {
                if (data.orNo == "" || data.orNo == null) {
                    $("#orNo").val(1);
                } else {
                    $("#orNo").val(data.orNo + 1);
                }
            }
        },
    });
}

function approveRequest(event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: baseUrl + "/approve-request",
        data: $("#approveTransactionForm").serialize(),
        success: function (data) {
            $("#approveTransactionForm")[0].reset();
            $("#SetApproveModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Request Approved",
                icon: "success",
            }).then((result) => {
                // Redirect after SweetAlert closes
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function rejectRequest(event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: baseUrl + "/reject-request",
        data: $("#rejectTransactionForm").serialize(),
        success: function (data) {
            $("#rejectTransactionForm")[0].reset();
            $("#SetRejectModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Request Rejected successfully",
                icon: "success",
            }).then((result) => {
                // Redirect after SweetAlert closes
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}
