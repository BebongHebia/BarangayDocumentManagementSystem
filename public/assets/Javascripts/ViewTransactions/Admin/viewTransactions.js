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
