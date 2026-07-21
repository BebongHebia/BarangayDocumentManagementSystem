function confirmPassword() {
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;
    var matchDiv = document.getElementById("passwordMatch");
    var doNotMatchDiv = document.getElementById("passwordDoNotMatch");
    var submitBtn = document.getElementById("addUserButton");

    if (password === "" || confirm_password === "") {
        matchDiv.style.display = "none";
        doNotMatchDiv.style.display = "none";
        submitBtn.disabled = true;
        return;
    }

    if (password === confirm_password) {
        matchDiv.style.display = "block";
        doNotMatchDiv.style.display = "none";
        submitBtn.disabled = false;
    } else {
        matchDiv.style.display = "none";
        doNotMatchDiv.style.display = "block";
        submitBtn.disabled = true;
    }
}

// initial check (if any values pre-filled)
$(document).ready(function () {
    if ($("#password").val() !== "" || $("#confirm_password").val() !== "") {
        confirmPassword();
    }
});

displayMasterListData();

function displayMasterListData() {
    var listCode = $("#listCode").val();
    console.log(listCode);
    $.ajax({
        type: "GET",
        url: "/get-master-list-details/list-code=" + listCode,
        success: function (data) {
            $("#firstName").val(data.firstName);
            $("#middleName").val(data.middleName);
            $("#lastName").val(data.lastName);
            $("#suffix").val(data.suffix);
            $("#birthdate").val(data.birthdate);
            $("#placeOfBirth").val(data.placeOfBirth);
            $("#sex").val(data.sex).trigger("change");
            $("#bloodType").val(data.bloodType).trigger("change");
            $("#civilStatus").val(data.civilStatus).trigger("change");
            $("#address").val(data.address);
            $("#purok").val(data.purok);
            $("#citizenship").val(data.citizenship);
            $("#religion").val(data.religion);
            $("#profession").val(data.profession);
            $("#contact").val(data.contact);
            $("#email").val(data.email);
            $("#educationalAtt").val(data.educationalAtt);
            $("#completeName").val(data.completeName);
            $("#phone").val(data.phone);
            $("#resType").val(data.resType).trigger("change");
        },
    });
}
