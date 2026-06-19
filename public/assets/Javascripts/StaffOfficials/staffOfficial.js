function addStaffOfficial(event) {
    event.preventDefault();

    $.ajax({
        type: "post",
        url: baseUrl + "/add-staff-official",
        data: $("#addStaffOfficialForm").serialize(),
        dataType: "json", // Important: expect JSON response
        success: function (data) {
            // Close loading
            Swal.close();

            // Check if there's a message (meaning it's not a success)
            if (data.message) {
                // Show warning/error message from server
                Swal.fire({
                    title: "Warning",
                    text: data.message,
                    icon: "warning",
                    confirmButtonColor: "#d33",
                });
            } else {
                // Success - no message means everything went well
                $("#addStaffOfficialForm")[0].reset();
                $("#CreateStaffOfficial").modal("hide");
                Swal.fire({
                    title: "Success",
                    text: "Staff/Official added successfully",
                    icon: "success",
                    timer: 2000,
                }).then(() => {
                    // Optional: Reload table or update UI
                    location.reload(); // or call your refresh function
                });
            }
        },
        error: function (xhr, status, error) {
            Swal.close();
            // Handle server errors
            Swal.fire({
                title: "Error",
                text: "An error occurred while adding the staff/official. Please try again.",
                icon: "error",
            });
            console.error("Error:", error);
            console.log("Response:", xhr.responseText);
        },
    });
}

/** ----------------------------------------------------- */
displayStaffOfficial();

function displayStaffOfficial() {
    $.ajax({
        type: "get",
        url: "/get-staff-officials",
        success: function (data) {
            let rows = "";
            $.each(data, function (index, staffOfficial) {
                let imageUrl = "assets/images/sampleProfile.jpg";

                let statusButton = `<button class="btn btn-dark btn-sm" onclick="openChangeStatusModal('${staffOfficial.code}')"><i class="fas fa-user"></i> Change Status</button>`;

                if (staffOfficial.status == "Active") {
                    statusButton = `<button class="btn btn-success btn-sm" onclick="openChangeStatusModal('${staffOfficial.code}')"><i class="fas fa-user"></i> Change Status</button>`;
                }

                if (
                    staffOfficial.staff_image &&
                    staffOfficial.staff_image.path
                ) {
                    imageUrl = "/storage/" + staffOfficial.staff_image.path;
                }

                rows += `
                    <div class="col-sm-3 mt-2">
                        <div id="soContainer">
                            <div id="soHeader">
                                <img id="staffImage" src="${imageUrl}"
                                     onerror="this.src='assets/images/sampleProfile.jpg'"
                                     alt="${staffOfficial.completeName}">
                            </div>
                            <div id="soBody">
                                <h4 class="text-start">${staffOfficial.completeName} - ${staffOfficial.position}</h4>
                                <hr>
                                <p class="text-start">Sex : ${staffOfficial.sex}</p>
                                <p class="text-start">Birthday : ${staffOfficial.bday}</p>
                                <p class="text-start">Birthplace : ${staffOfficial.birthPlace}</p>
                                <p class="text-start">Civil Status : ${staffOfficial.civilStatus}</p>
                                <p class="text-start">Status : ${staffOfficial.status}</p>
                                <div class="d-flex justify-content-around">
                                    <button class="btn btn-warning btn-sm" onclick="openChangeImageModal('${staffOfficial.code}')">
                                        <i class="fas fa-image"></i> Change Image
                                    </button>
                                    ${statusButton}
                                    <button class="btn btn-danger" onclick="openRemoveStaffOfficialModal('${staffOfficial.code}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $("#staffOfficalDisplayPanel").html(rows);
        },
        error: function () {
            swal.fire({
                title: "Error",
                text: "There is no staff Official",
                icon: "warning",
            });
        },
    });
}

function addStaffOfficialImage(event) {
    event.preventDefault();

    // Get the form data
    var form = document.getElementById("changeStaffOfficalImage");
    var formData = new FormData(form);

    // Show loading state
    var button = event.target;
    var originalHtml = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
    button.disabled = true;

    $.ajax({
        type: "POST",
        url: "/upload-staff-image",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                // Close the modal
                $("#ChangeImageModal").modal("hide");

                // Refresh the display with updated images
                displayStaffOfficial();

                // Show success message
                Swal.fire({
                    title: "success",
                    text: "Image Uploaded successfully",
                    icon: "success",
                });
            }
        },
        error: function (xhr) {
            var errorMessage = "An error occurred while uploading";
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            toastr.error(errorMessage);
        },
        complete: function () {
            // Reset button state
            button.innerHTML = originalHtml;
            button.disabled = false;

            // Reset form
            document.getElementById("changeStaffOfficalImage").reset();
        },
    });
}

function staffOfficialChangeStatus() {
    // Show loading state
    Swal.fire({
        title: "Processing...",
        text: "Please wait while we update the status",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });

    $.ajax({
        type: "POST",
        url: baseUrl + "/edit-staff-official-status",
        data: $("#changeStaffOfficialStatusForm").serialize(),
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            // Close any SweetAlert
            Swal.close();

            if (response.success) {
                // Success notification
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                }).then(() => {
                    // Reset form and close modal
                    $("#changeStaffOfficialStatusForm")[0].reset();
                    $("#ChangeStaffOfficialStatus").modal("hide");
                    displayStaffOfficial();
                });
            } else {
                // Error notification from server
                Swal.fire({
                    title: "Error!",
                    text:
                        response.message ||
                        "An error occurred while updating status",
                    icon: "error",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK",
                });
            }
        },
        error: function (xhr) {
            Swal.close();

            let errorMessage = "An error occurred while updating the status";

            // Check if there's a JSON response with error message
            if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON.error) {
                    errorMessage = xhr.responseJSON.error;
                }
            } else if (xhr.status === 400) {
                errorMessage = "Invalid request. Please check your input.";
            } else if (xhr.status === 404) {
                errorMessage = "Staff member not found.";
            } else if (xhr.status === 500) {
                errorMessage = "Server error. Please try again later.";
            }

            Swal.fire({
                title: "Error!",
                text: errorMessage,
                icon: "error",
                confirmButtonColor: "#d33",
                confirmButtonText: "OK",
            });
        },
    });
}

function removeStaffOfficial() {
    $.ajax({
        type: "post",
        url: baseUrl + "/remove-staff-official",
        data: $("#removeStaffOfficialForm").serialize(),
        success: function (data) {
            $("#removeStaffOfficialForm")[0].reset();
            $("#DeleteStaffOfficial").modal("hide");
            displayStaffOfficial();
            swal.fire({
                title: "Success",
                text: "Status Removed successfully",
                icon: "success",
            });
        },
    });
}

function openChangeImageModal(code) {
    // Set the code in the hidden input
    document.getElementById("code").value = code;

    // Open the modal
    $("#ChangeImageModal").modal("show");
}

function openChangeStatusModal(code) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-staff-official/code=" + code,
        success: function (data) {
            $("#staffId").val(data.id);
            $("#nameSpan").html(data.completeName);
            $("#status").val(data.status).trigger("change");
        },
    });

    $("#ChangeStaffOfficialStatus").modal("show");
}

function openRemoveStaffOfficialModal(code) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-staff-official/code=" + code,
        success: function (data) {
            $("#deleteStaffId").val(data.id);
        },
    });

    $("#DeleteStaffOfficial").modal("show");
}
