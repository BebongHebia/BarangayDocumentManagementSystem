function adminCreateUserAccount(){
    $.ajax({
        type: "post",
        url: baseUrl + "/admin-create-user-account",
        data: $("#adminAccountCreationForm").serialize(),
        success: function (data) {
            $("#adminAccountCreationForm")[0].reset();
            swal.fire({
                title: "Success",
                text: "User account created successfully. Do you want to proceed to transactions?",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Proceed to Transaction",
                cancelButtonText: "No, go to Masterlists",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#6c757d",
                allowOutsideClick: false,
                allowEscapeKey: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // User clicked "Proceed to Transaction"
                    window.location.href = baseUrl + "/transactions";
                } else {
                    // User clicked "No, go to Masterlists" or dismissed
                    window.location.href = baseUrl + "/masterlists";
                }
            });
        }
    });
}