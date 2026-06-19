// Global flag to track if initial load is complete
var initialLoadComplete = false;

function loadProfileDetails() {
    var userCode = $("#userCode").val();
    $.ajax({
        type: "get",
        url: "/get-profile-details/user-code=" + userCode,
        success: function (data) {
            $("#completeName").val(data.completeName);
            $("#civilStatus").val(data.civilStatus).trigger("change");
            $("#placeOfBirth").val(data.placeOfBirth);
            $("#citizenship").val(data.citizenship);
            $("#phone").val(data.phone);
            $("#bday").val(data.bday);
            $("#profession").val(data.profession);
            $("#currentAddress").val(data.currentAddress);
            $("#sex").val(data.sex).trigger("change");
            $("#purok").val(data.purok).trigger("change");

            // Run validation AFTER all fields are populated
            validation();
            initialLoadComplete = true;
        },
        error: function () {
            console.log("Error loading profile details");
            initialLoadComplete = true;
        },
    });
}

function editProfile(event) {
    event.preventDefault();

    // Run validation before submitting
    if (!validation()) {
        Swal.fire({
            title: "Error",
            text: "Please fill in all required fields correctly",
            icon: "error",
        });
        return false;
    }

    $.ajax({
        type: "post",
        url: baseUrl + "/edit-profile",
        data: $("#editProfileForm").serialize(),
        success: function (data) {
            // Don't reset the form, just show success
            Swal.fire({
                title: "Success",
                text: "Profile Saved Changes",
                icon: "success",
            });
            // Reload profile details to refresh data
            loadProfileDetails();
        },
        error: function (xhr) {
            Swal.fire({
                title: "Error",
                text: xhr.responseJSON?.message || "Failed to save profile",
                icon: "error",
            });
        },
    });
}

function validation() {
    // Get all form values
    var completeName = $("#completeName").val()?.trim() || "";
    var civilStatus = $("#civilStatus").val() || "";
    var placeOfBirth = $("#placeOfBirth").val()?.trim() || "";
    var citizenship = $("#citizenship").val()?.trim() || "";
    var phone = $("#phone").val()?.trim() || "";
    var bday = $("#bday").val() || "";
    var profession = $("#profession").val()?.trim() || "";
    var currentAddress = $("#currentAddress").val()?.trim() || "";
    var sex = $("#sex").val() || "";
    var purok = $("#purok").val() || "";

    // Check if all fields are filled
    var isValid =
        completeName !== "" &&
        civilStatus !== "" &&
        placeOfBirth !== "" &&
        citizenship !== "" &&
        phone !== "" &&
        bday !== "" &&
        profession !== "" &&
        currentAddress !== "" &&
        sex !== "" &&
        purok !== "";

    // Check for "N/A" values
    var isNotNA =
        completeName !== "N/A" &&
        placeOfBirth !== "N/A" &&
        citizenship !== "N/A" &&
        phone !== "N/A" &&
        profession !== "N/A" &&
        currentAddress !== "N/A";

    // Add phone number validation (optional)
    var isValidPhone = true;
    if (phone !== "" && phone !== "N/A") {
        var phoneRegex = /^[0-9]{11}$/;
        isValidPhone = phoneRegex.test(phone);
        if (!isValidPhone) {
            $("#phone").addClass("is-invalid").removeClass("is-valid");
            console.log("- Phone number must be 11 digits");
        } else {
            $("#phone").removeClass("is-invalid").addClass("is-valid");
        }
    }

    // Add visual feedback for each field
    addValidationFeedback(
        "completeName",
        completeName !== "" && completeName !== "N/A",
    );
    addValidationFeedback("civilStatus", civilStatus !== "");
    addValidationFeedback(
        "placeOfBirth",
        placeOfBirth !== "" && placeOfBirth !== "N/A",
    );
    addValidationFeedback(
        "citizenship",
        citizenship !== "" && citizenship !== "N/A",
    );
    addValidationFeedback(
        "phone",
        phone !== "" && phone !== "N/A" && isValidPhone,
    );
    addValidationFeedback("bday", bday !== "");
    addValidationFeedback(
        "profession",
        profession !== "" && profession !== "N/A",
    );
    addValidationFeedback(
        "currentAddress",
        currentAddress !== "" && currentAddress !== "N/A",
    );
    addValidationFeedback("sex", sex !== "");
    addValidationFeedback("purok", purok !== "");

    // Final validation
    var finalValidation = isValid && isNotNA && isValidPhone;

    if (finalValidation) {
        $("#editBtn").prop("disabled", false);
        $("#editBtn").removeClass("btn-secondary").addClass("btn-primary");
        console.log("All fields are valid - button enabled");
    } else {
        $("#editBtn").prop("disabled", true);
        $("#editBtn").removeClass("btn-primary").addClass("btn-secondary");

        // Log which fields are invalid for debugging
        if (!isValid) {
            console.log("Some fields are empty:");
            if (!completeName) console.log("- Complete Name is empty");
            if (!civilStatus) console.log("- Civil Status is empty");
            if (!placeOfBirth) console.log("- Place of Birth is empty");
            if (!citizenship) console.log("- Citizenship is empty");
            if (!phone) console.log("- Phone is empty");
            if (!bday) console.log("- Birthday is empty");
            if (!profession) console.log("- Profession is empty");
            if (!currentAddress) console.log("- Current Address is empty");
            if (!sex) console.log("- Sex is empty");
            if (!purok) console.log("- Purok is empty");
        }

        if (!isNotNA) {
            console.log("Some fields contain 'N/A' which is not allowed");
        }
    }

    return finalValidation;
}

// Helper function to add visual feedback
function addValidationFeedback(fieldId, isValid) {
    var field = $("#" + fieldId);
    if (isValid) {
        field.removeClass("is-invalid").addClass("is-valid");
    } else {
        field.removeClass("is-valid").addClass("is-invalid");
    }
}

// Function to show field-specific error messages
function showFieldError(fieldId, isValid) {
    addValidationFeedback(fieldId, isValid);
}

// Enhanced validation with field-by-field checking
function enhancedValidation() {
    var fields = {
        completeName: $("#completeName").val()?.trim() || "",
        civilStatus: $("#civilStatus").val() || "",
        placeOfBirth: $("#placeOfBirth").val()?.trim() || "",
        citizenship: $("#citizenship").val()?.trim() || "",
        phone: $("#phone").val()?.trim() || "",
        bday: $("#bday").val() || "",
        profession: $("#profession").val()?.trim() || "",
        currentAddress: $("#currentAddress").val()?.trim() || "",
        sex: $("#sex").val() || "",
        purok: $("#purok").val() || "",
    };

    var allValid = true;

    // Validate each field
    for (var key in fields) {
        var value = fields[key];
        var isValid = value !== "" && value !== null && value !== "N/A";

        // Additional phone validation
        if (key === "phone" && isValid) {
            isValid = /^[0-9]{11}$/.test(value);
        }

        if (!isValid) {
            allValid = false;
            $(`#${key}`).addClass("is-invalid").removeClass("is-valid");
        } else {
            $(`#${key}`).addClass("is-valid").removeClass("is-invalid");
        }
    }

    // Enable/disable button
    if (allValid) {
        $("#editBtn").prop("disabled", false);
        $("#editBtn").removeClass("btn-secondary").addClass("btn-primary");
    } else {
        $("#editBtn").prop("disabled", true);
        $("#editBtn").removeClass("btn-primary").addClass("btn-secondary");
    }

    return allValid;
}

// Initialize on page load
$(document).ready(function () {
    // Load profile details first (which will trigger validation after load)
    loadProfileDetails();

    // Add validation to all inputs for real-time checking
    $(document).on(
        "input change",
        "#editProfileForm input, #editProfileForm select",
        function () {
            // Only validate if initial load is complete to prevent premature validation
            if (initialLoadComplete) {
                validation();
            }
        },
    );
});

function addProfilePicWithProgress(event) {
    event.preventDefault();

    var formData = new FormData($("#addProfilePicForm")[0]);
    var fileInput = $("input[name='image']")[0];

    if (!fileInput.files[0]) {
        Swal.fire({
            title: "Error",
            text: "Please select an image file to upload",
            icon: "error",
        });
        return false;
    }

    Swal.fire({
        title: "Confirm Upload",
        text: "Are you sure you want to upload this profile picture?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, upload it!",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Uploading...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: function () {
                    Swal.showLoading();
                },
            });

            $.ajax({
                url: baseUrl + "/upload-image",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content",
                    ),
                },
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener(
                        "progress",
                        function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete =
                                    (evt.loaded / evt.total) * 100;
                                console.log(
                                    "Upload progress: " + percentComplete + "%",
                                );
                            }
                        },
                        false,
                    );
                    return xhr;
                },
                success: function (response) {
                    if (response.success) {
                        $("#UploadImageModal").modal("hide");
                        $("#addProfilePicForm")[0].reset();

                        if (response.path) {
                            var imageUrl =
                                response.path + "?t=" + new Date().getTime();

                            // Update the profile image
                            $(".profile-image").attr("src", imageUrl);

                            // Also update any other profile images if needed
                            $("#profileIcon").attr("src", imageUrl);
                        }

                        // Force refresh profile details
                        if (typeof loadProfileDetails === "function") {
                            loadProfileDetails();
                        }

                        Swal.fire({
                            title: "Success!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function (xhr) {
                    var message = "Upload failed";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire("Error", message, "error");
                },
            });
        }
    });
}
