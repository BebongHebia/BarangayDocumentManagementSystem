function submitAttestation(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/submit-request-document-attestation",
        data: $("#addAttestationForm").serialize(),
        success: function (data) {
            $("#addAttestationForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Request Submitted successfully",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function submitBarCert(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/submit-request-document-bar-cert",
        data: $("#addBarCertForm").serialize(),
        success: function (data) {
            $("#addBarCertForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Request Submitted successfully",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function submitBarClear(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/submit-request-document-bar-clear",
        data: $("#addBerClearForm").serialize(),
        success: function (data) {
            $("#addBerClearForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Request Submitted successfully",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function submitBarIden(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/submit-request-document-bar-iden",
        data: $("#addBarIdenForm").serialize(),
        success: function (data) {
            $("#addBarIdenForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Request Submitted successfully",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}

function submitBarIndigent(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/submit-request-document-bar-indigent",
        data: $("#addBarIndigentForm").serialize(),
        success: function (data) {
            $("#addBarIndigentForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "Request Submitted successfully",
                icon: "success",
            }).then((result) => {
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                }
            });
        },
    });
}
