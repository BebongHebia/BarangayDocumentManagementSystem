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

function openTakePicModal() {
    $("#UploadImageModal").modal("hide");
    $("#TakePictureModal").modal("show");
}

/** *------------------------------------ */

// Global variables
let stream = null;
let capturedFile = null; // Store as File object instead of data URL

// Start Camera
function startCamera() {
    const video = document.getElementById("video");
    const startBtn = document.getElementById("startCameraBtn");
    const captureBtn = document.getElementById("captureBtn");

    // Check if browser supports getUserMedia
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices
            .getUserMedia({
                video: {
                    facingMode: "user",
                    width: { ideal: 640 },
                    height: { ideal: 480 },
                },
                audio: false,
            })
            .then(function (mediaStream) {
                stream = mediaStream;
                video.srcObject = stream;
                video.play();

                // Update buttons
                startBtn.style.display = "none";
                captureBtn.style.display = "inline-block";

                // Hide any previous captured image
                document.getElementById("capturedImagePreview").style.display =
                    "none";
                document.getElementById("submitPhotoBtn").style.display =
                    "none";
            })
            .catch(function (err) {
                console.error("Error accessing camera: ", err);
                Swal.fire({
                    title: "Camera Error",
                    text: "Unable to access camera. Please check permissions or use file upload instead.",
                    icon: "error",
                });
            });
    } else {
        Swal.fire({
            title: "Not Supported",
            text: "Your browser doesn't support camera access.",
            icon: "error",
        });
    }
}

// Capture Photo
function capturePhoto() {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const capturedImage = document.getElementById("capturedImage");
    const capturedPreview = document.getElementById("capturedImagePreview");
    const captureBtn = document.getElementById("captureBtn");
    const retakeBtn = document.getElementById("retakeBtn");
    const submitBtn = document.getElementById("submitPhotoBtn");

    // Set canvas dimensions to match video
    canvas.width = video.videoWidth || 640;
    canvas.height = video.videoHeight || 480;

    // Draw video frame to canvas
    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Convert canvas to Blob (JPEG format)
    canvas.toBlob(
        function (blob) {
            // Create a File object from the blob
            const fileName = "camera_capture_" + Date.now() + ".jpg";
            capturedFile = new File([blob], fileName, { type: "image/jpeg" });

            // Create data URL for preview
            const reader = new FileReader();
            reader.onload = function (e) {
                capturedImage.src = e.target.result;
                capturedPreview.style.display = "block";
            };
            reader.readAsDataURL(capturedFile);

            // Update buttons
            captureBtn.style.display = "none";
            retakeBtn.style.display = "inline-block";
            submitBtn.style.display = "inline-block";
        },
        "image/jpeg",
        0.9,
    ); // 90% quality
}

// Retake Photo
function retakePhoto() {
    // Reset UI
    document.getElementById("capturedImagePreview").style.display = "none";
    document.getElementById("captureBtn").style.display = "inline-block";
    document.getElementById("retakeBtn").style.display = "none";
    document.getElementById("submitPhotoBtn").style.display = "none";
    capturedFile = null;
}

// Submit Captured Photo
function submitCapturedPhoto(event) {
    event.preventDefault();

    if (!capturedFile) {
        Swal.fire({
            title: "Error",
            text: "No photo captured. Please capture a photo first.",
            icon: "error",
        });
        return;
    }

    Swal.fire({
        title: "Confirm Upload",
        text: "Are you sure you want to upload this photo?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, upload it!",
    }).then((result) => {
        if (result.isConfirmed) {
            uploadCapturedPhoto();
        }
    });
}

// Upload captured photo
function uploadCapturedPhoto() {
    Swal.fire({
        title: "Uploading...",
        text: "Please wait",
        allowOutsideClick: false,
        didOpen: function () {
            Swal.showLoading();
        },
    });

    // Create FormData with the File object
    const formData = new FormData();
    formData.append("image", capturedFile);
    formData.append("userCode", $("input[name='userCode']").val());

    $.ajax({
        url: baseUrl + "/upload-image",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener(
                "progress",
                function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
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
                // Stop camera
                stopCamera();

                // Close modal
                $("#TakePictureModal").modal("hide");

                // Update profile image
                if (response.path) {
                    var imageUrl = response.path + "?t=" + new Date().getTime();
                    $(".profile-image").attr("src", imageUrl);
                    $("#profileIcon").attr("src", imageUrl);
                }

                // Reset form
                resetCameraForm();

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

// Stop camera
function stopCamera() {
    if (stream) {
        stream.getTracks().forEach((track) => {
            track.stop();
        });
        stream = null;
    }

    const video = document.getElementById("video");
    if (video.srcObject) {
        video.srcObject = null;
    }
}

// Reset camera form
function resetCameraForm() {
    document.getElementById("startCameraBtn").style.display = "inline-block";
    document.getElementById("captureBtn").style.display = "none";
    document.getElementById("retakeBtn").style.display = "none";
    document.getElementById("submitPhotoBtn").style.display = "none";
    document.getElementById("capturedImagePreview").style.display = "none";
    capturedFile = null;
}

// Clean up when modal is closed
$("#TakePictureModal").on("hidden.bs.modal", function () {
    stopCamera();
    resetCameraForm();
});

// Open Take Picture Modal from Upload Modal
function openTakePicModal() {
    $("#UploadImageModal").modal("hide");
    $("#TakePictureModal").modal("show");
}
displayProfileDetails();
function displayProfileDetails() {
    var userCode = $("#userCode").val();
    $.ajax({
        type: "get",
        url: "/get-profile-details/user-code=" + userCode,
        success: function (data) {
            $("#completeName").val(data.completeName);
            $("#sex").val(data.sex).trigger("change");
            $("#bday").val(data.bday);
            $("#placeOfBirth").val(data.placeOfBirth);
            $("#civilStatus").val(data.civilStatus).trigger("change");
            $("#citizenship").val(data.citizenship);
            $("#phone").val(data.phone);
            $("#profession").val(data.profession);
            $("#status").val(data.status).trigger("change");
            $("#purok").val(data.purok);
            $("#currentAddress").val(data.currentAddress);
        },
    });
}

/** ------------------------------------ */

$(document).ready(function () {
    // Initialize Select2
    $(".select2").select2();

    // Load user data when page loads
    loadUserData();

    // Real-time validation on input change
    $("#editResidentAccountForm input, #editResidentAccountForm select").on(
        "change keyup",
        function () {
            validateField($(this));
        },
    );
});

// Load user data
function loadUserData() {
    const userCode = $("#userCode").val();

    $.ajax({
        url: baseUrl + "/get-profile-details/user-code=" + userCode,
        type: "GET",
        data: { userCode: userCode },
        success: function (response) {
            if (response.success) {
                const data = response.data;
                $("#completeName").val(data.completeName || "");
                $("#sex")
                    .val(data.sex || "")
                    .trigger("change");
                $("#bday").val(data.bday || "");
                $("#placeOfBirth").val(data.placeOfBirth || "");
                $("#civilStatus")
                    .val(data.civilStatus || "")
                    .trigger("change");
                $("#phone").val(data.phone || "");
                $("#profession").val(data.profession || "");
                $("#status")
                    .val(data.status || "")
                    .trigger("change");
                $("#purok").val(data.purok || "");
                $("#currentAddress").val(data.currentAddress || "");
            }
        },
        error: function (xhr) {
            console.error("Error loading user data:", xhr);
        },
    });
}

// Validate single field
function validateField(field) {
    const value = field.val().trim();
    const required = field.prop("required");

    if (required) {
        if (field.is("select")) {
            if (!value || value === "") {
                field.addClass("is-invalid");
                return false;
            } else {
                field.removeClass("is-invalid");
                field.addClass("is-valid");
                return true;
            }
        } else {
            if (!value || value === "") {
                field.addClass("is-invalid");
                return false;
            } else {
                field.removeClass("is-invalid");
                field.addClass("is-valid");
                return true;
            }
        }
    }
    return true;
}

// Validate all fields
function validateForm() {
    let isValid = true;
    const fields = $("#editResidentAccountForm").find(
        "input[required], select[required]",
    );

    fields.each(function () {
        if (!validateField($(this))) {
            isValid = false;
        }
    });

    // Additional custom validations
    // Phone number validation (only numbers)
    const phone = $("#phone").val().trim();
    if (phone && !/^[0-9+\-\s()]+$/.test(phone)) {
        $("#phone").addClass("is-invalid");
        $("#phone")
            .siblings(".invalid-feedback")
            .text("Please enter a valid phone number.");
        isValid = false;
    } else {
        $("#phone").removeClass("is-invalid");
        $("#phone").addClass("is-valid");
    }

    // Birthday validation (not future date)
    const bday = $("#bday").val();
    if (bday) {
        const birthDate = new Date(bday);
        const today = new Date();
        if (birthDate > today) {
            $("#bday").addClass("is-invalid");
            $("#bday")
                .siblings(".invalid-feedback")
                .text("Birthday cannot be in the future.");
            isValid = false;
        }
    }

    return isValid;
}

// Validate and Submit
function validateAndSubmit(event) {
    event.preventDefault();

    // Reset all validation states
    $(
        "#editResidentAccountForm input, #editResidentAccountForm select",
    ).removeClass("is-valid is-invalid");
    $("#validationMessage").hide();

    // Validate form
    if (!validateForm()) {
        // Show error message
        $("#validationMessage").show();

        // Scroll to the first error field
        const firstError = $(".is-invalid:first");
        if (firstError.length) {
            $("html, body").animate(
                {
                    scrollTop: firstError.offset().top - 100,
                },
                500,
            );
            firstError.focus();
        }

        Swal.fire({
            title: "Validation Error",
            text: "Please fill in all required fields correctly.",
            icon: "error",
            timer: 3000,
            showConfirmButton: true,
        });
        return false;
    }

    // If validation passes, submit the form
    submitForm();
}

// Submit form
function submitForm() {
    const formData = new FormData($("#editResidentAccountForm")[0]);

    Swal.fire({
        title: "Confirm Update",
        text: "Are you sure you want to update this account?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, update it!",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Updating...",
                text: "Please wait",
                allowOutsideClick: false,
                didOpen: function () {
                    Swal.showLoading();
                },
            });

            $.ajax({
                url: baseUrl + "/edit-profile",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content",
                    ),
                },
                success: function (response) {
                    if (response.success) {
                        // Reset validation states
                        $(
                            "#editResidentAccountForm input, #editResidentAccountForm select",
                        ).removeClass("is-valid");

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
                    let message = "Update failed. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire("Error", message, "error");
                },
            });
        }
    });
}

// Additional validation for phone number formatting
$("#phone").on("input", function () {
    // Remove non-numeric characters except + - ( ) space
    this.value = this.value.replace(/[^0-9+\-\s()]/g, "");
});

// Auto-format birthday to prevent future dates
$("#bday").on("change", function () {
    const birthDate = new Date(this.value);
    const today = new Date();
    if (birthDate > today) {
        $(this).addClass("is-invalid");
        $(this)
            .siblings(".invalid-feedback")
            .text("Birthday cannot be in the future.");
    } else {
        $(this).removeClass("is-invalid");
    }
});
