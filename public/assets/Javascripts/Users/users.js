displayUsers("All", "All");

function displayUsers(option, filter) {
    console.log(option);
    $.ajax({
        type: "get",
        url: "/get-users/option=" + option + "/filter=" + filter,

        success: function (data) {
            let rows = "";
            let counter = 0;
            $.each(data, function (index, users) {
                counter++;
                rows += `

                    <tr>
                        <td>${counter}</td>
                        <td>${users.completeName}</td>
                        <td>${users.phone}</td>
                        <td>${users.userCode}</td>
                        <td>${users.status}</td>
                        <td>

                            <button class="btn btn-warning btn-sm" onclick="openEditUserModal(${users.id})">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm" onclick="openDeleteUserModal(${users.id})">
                                <i class="fas fa-trash"></i>
                            </button>

                        </td>
                    </tr>


                `;
            });

            $("#userTableBody").html(rows);
        },
    });
}

function openDeleteUserModal(userId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-user/user-id=" + userId,
        success: function (data) {
            $("#deleteUserId").val(data.id);
        },
    });
    $("#DeleteUserModal").modal("show");
}

function openEditUserModal(userId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-user/user-id=" + userId,
        success: function (data) {
            $("#editUserId").val(data.id);
            $("#editCompleteName").val(data.completeName);
            $("#editSex").val(data.sex).trigger("change");
            $("#editPurok").val(data.purok);
            $("#editBday").val(data.bday);
            $("#editCivilStatus").val(data.civilStatus);
            $("#editBirthplace").val(data.placeOfBirth);
            $("#editCitizenship").val(data.citizenship).trigger("change");
            $("#editCurrentAddress").val(data.currentAddress);
            $("#editProfession").val(data.profession);
            $("#editPhone").val(data.phone);
            $("#editRole").val(data.role).trigger("change");
            $("#editUserCode").val(data.userCode);
            $("#editStatus").val(data.status).trigger("change");
        },
    });

    $("#EditUserModal").modal("show");
}
function deleteUser(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/delete-user",
        data: $("#deleteUserForm").serialize(),
        success: function (data) {
            $("#deleteUserForm")[0].reset();
            $("#DeleteUserModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "User Deleted successfully",
                icon: "success",
            });
            displayUsers("All", "All");
        },
    });
}

function editUser(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-user",
        data: $("#editUserForm").serialize(),
        success: function (data) {
            $("#editUserForm")[0].reset();
            $("#EditUserModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "User Edited successfully",
                icon: "success",
            });
            displayUsers("All", "All");
        },
    });
}

function addUser(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/add-user",
        data: $("#addUserForm").serialize(),
        success: function (data) {
            $("#addUserForm")[0].reset();
            $("#CreateUserModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "User added successfully",
                icon: "success",
            });
            displayUsers("All", "All");
            $("#addUserButton").prop("disabled", false);
        },
    });
}

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
