function confirmPassword() {
    var password = $("#password").val();
    var confirm_password = $("#confirm_password").val();

    if (password === confirm_password && password !== "") {
        $("#passwordMatch").css("display", "block");
        $("#passwordDoNotMatch").css("display", "none");
        $("#addUserButton").prop("disabled", false); // Enable button
    } else {
        $("#passwordDoNotMatch").css("display", "block");
        $("#passwordMatch").css("display", "none");
        $("#addUserButton").prop("disabled", true); // Disable button
    }
}
