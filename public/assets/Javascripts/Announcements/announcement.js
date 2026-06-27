function addAnnouncement(event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: baseUrl + "/add-announcement",
        data: $("#addAnnouncementForm").serialize(),
        success: function (data) {
            $("#addAnnouncementForm")[0].reset();
            $("#AddAnnouncement").modal("hide");
            displayAnnouncements();
            swal.fire({
                title: "Success",
                text: "Announcement Added successfully",
                icon: "success",
            });
        },
    });
}

displayAnnouncements();
function displayAnnouncements() {
    var userRole = $("#userRole").val();
    $.ajax({
        type: "get",
        url: "/get-announcements",
        success: function (data) {
            let rows = "";
            $.each(data, function (index, announcement) {
                // Determine image URL
                let imageHtml = "";
                if (announcement.image && announcement.image.path) {
                    imageHtml = `<img src="storage/${announcement.image.path}" alt="Announcement Image">`;
                } else {
                    imageHtml = `
                        <div class="no-image">
                            <i class="fas fa-image" style="margin-right: 8px;"></i> No Image
                        </div>
                    `;
                }

                // Check if user is "User" to hide buttons
                const isUser = userRole === "User";

                // Build buttons HTML only if not a User
                let buttonsHtml = "";
                if (!isUser) {
                    buttonsHtml = `
                        <div class="announcementActions">
                            <button class="btn-announcement btn-upload" onclick="event.stopPropagation(); openUploadAnnouncementImageModal(${announcement.id})">
                                <i class="fas fa-upload"></i> Upload
                            </button>
                            <button class="btn-announcement btn-edit" onclick="event.stopPropagation(); openEditAnnouncementModal(${announcement.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn-announcement btn-delete" onclick="event.stopPropagation(); openDeleteAnnouncementModal(${announcement.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    `;
                }

                // For Users: click to view, for others: click to edit (or you can make both view)
                let clickHandler = "";
                if (isUser) {
                    clickHandler = `onclick="openViewAnnouncementModal(${announcement.id})"`;
                } else {
                    // Non-users can also view if you want, or edit
                    clickHandler = `onclick="openViewAnnouncementModal(${announcement.id})"`; // or openEditAnnouncementModal
                }

                rows += `
                    <div class="col-sm-3">
                        <div class="announcementContainer" ${clickHandler} style="cursor: pointer;">
                            <!-- Image Section -->
                            <div class="announcementImage">
                                ${imageHtml}
                            </div>

                            <!-- Description Section -->
                            <div class="announcementBody">
                                <h4>${announcement.title || "Announcement"}</h4>
                                <p>${announcement.description || "No description available"}</p>
                                <p><strong>What:</strong> ${announcement.what}</p>
                                <p><strong>When:</strong> ${announcement.when}</p>
                                <p><strong>Where:</strong> ${announcement.where}</p>
                                <p><strong>How:</strong> ${announcement.how}</p>
                            </div>

                            ${buttonsHtml}
                        </div>
                    </div>
                `;
            });

            $("#announcementPanel").html(rows);
        },
    });
}

function openViewAnnouncementModal(announcementId) {
    // Fetch the specific announcement data using your URL format
    $.ajax({
        type: "get",
        url: baseUrl + "/get-announcement/announcement-id=" + announcementId,
        success: function (data) {
            // Update the image
            let imageHtml = "";
            if (data.image && data.image.path) {
                imageHtml = `<img src="storage/${data.image.path}" alt="Announcement Image" style="width: 100%; height: 100%; object-fit: cover;">`;
            } else {
                imageHtml = `
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #999; font-size: 14px; background: #f9f9f9; border: 2px dashed #ddd; border-radius: 6px;">
                        <i class="fas fa-image" style="margin-right: 8px;"></i> No Image
                    </div>
                `;
            }
            $("#viewAnnouncementImage").html(imageHtml);

            // Update the details
            let detailsHtml = `
                <h3 style="margin-top: 0; color: #333;">${data.title || "Announcement"}</h3>
                <hr>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>Description:</strong><br>
                    ${data.description || "No description available"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>What:</strong> ${data.what || "N/A"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>When:</strong> ${data.when || "N/A"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>Where:</strong> ${data.where || "N/A"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>How:</strong> ${data.how || "N/A"}
                </p>
            `;
            $("#viewAnnouncementDetails").html(detailsHtml);

            // Show the modal
            $("#ViewAnnouncement").modal("show");
        },
        error: function (xhr, status, error) {
            console.error("Error fetching announcement details:", error);
            if (typeof toastr !== "undefined") {
                toastr.error("Failed to load announcement details");
            } else {
                alert("Failed to load announcement details");
            }
        },
    });
}
function openDeleteAnnouncementModal(annId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-announcement/announcement-id=" + annId,
        success: function (data) {
            $("#deleteAnnId").val(data.id);
        },
    });

    $("#DeleteAnnouncement").modal("show");
}

function openEditAnnouncementModal(annId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-announcement/announcement-id=" + annId,
        success: function (data) {
            $("#editAnnId").val(data.id);
            $("#editTitle").val(data.title);
            $("#editDescription").val(data.description);
            $("#editWhat").val(data.what);
            $("#editWhen").val(data.when);
            $("#editWhere").val(data.where);
            $("#editHow").val(data.how);
        },
    });

    $("#EditAnnouncement").modal("show");
}

function deleteAnnouncement(event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: baseUrl + "/delete-announcement",
        data: $("#deleteAnnouncementForm").serialize(),
        success: function (data) {
            $("#deleteAnnouncementForm")[0].reset();
            $("#DeleteAnnouncement").modal("hide");
            displayAnnouncements();
            swal.fire({
                title: "Success",
                text: "Announcement Deleted successfully",
                icon: "success",
            });
        },
    });
}

function editAnnouncement(event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: baseUrl + "/edit-announcement",
        data: $("#editAnnouncementForm").serialize(),
        success: function (data) {
            $("#editAnnouncementForm")[0].reset();
            $("#EditAnnouncement").modal("hide");
            displayAnnouncements();
            swal.fire({
                title: "Success",
                text: "Announcement Edited successfully",
                icon: "success",
            });
        },
    });
}

/** ----------------------------------------- */
// Function to open upload modal
function openUploadAnnouncementImageModal(annId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-announcement/announcement-id=" + annId,
        success: function (data) {
            // Set the announcement code in the hidden field
            $("#annCode").val(data.code);
            $("#announcementId").val(data.id);

            // Load existing image if any
            loadExistingImage(annId);

            // Show the modal
            $("#UploadAnnouncementImage").modal("show");
        },
        error: function () {
            showAlert("error", "Failed to load announcement data");
        },
    });
}

// Function to load existing image
function loadExistingImage(annId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-announcement-image/" + annId,
        success: function (data) {
            if (data.image_exists) {
                // Show existing image with full URL
                const imageUrl = data.image_path;
                $("#imagePreview").html(`
                    <img src="${imageUrl}" style="max-width: 100%; max-height: 200px; border-radius: 5px;">
                    <p style="color: #28a745; margin-top: 5px;">
                        <i class="fas fa-check-circle"></i> Current image
                    </p>
                `);
            } else {
                $("#imagePreview").html(`
                    <i class="fas fa-image" style="font-size: 48px; color: #ccc;"></i>
                    <p style="color: #999; margin-top: 10px;">No image uploaded</p>
                `);
            }
        },
        error: function () {
            $("#imagePreview").html(`
                <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #f0ad4e;"></i>
                <p style="color: #999; margin-top: 10px;">Could not load image</p>
            `);
        },
    });
}

// Function to upload image
function uploadAnnouncementImage() {
    const formData = new FormData();
    const fileInput = document.getElementById("fileInput");
    const annCode = document.getElementById("annCode").value;

    if (fileInput.files.length === 0) {
        showAlert("warning", "Please select an image to upload");
        return;
    }

    // Validate file size (2MB)
    const fileSize = fileInput.files[0].size / 1024 / 1024;
    if (fileSize > 2) {
        showAlert("error", "File size must be less than 2MB");
        return;
    }

    // Validate file type
    const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/jpg"];
    if (!allowedTypes.includes(fileInput.files[0].type)) {
        showAlert("error", "Only JPG, PNG, and GIF files are allowed");
        return;
    }

    formData.append("file", fileInput.files[0]);
    formData.append("annCode", annCode);

    // Disable button and show loading
    const uploadBtn = document.querySelector(
        "#UploadAnnouncementImage .btn-dark",
    );
    uploadBtn.disabled = true;
    uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';

    $.ajax({
        type: "post",
        url: baseUrl + "/upload-announcement-image",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                // Show success message
                $("#uploadStatus").html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> ${response.message}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                `);

                // Update preview with new image
                const imageUrl = baseUrl + "/storage/" + response.image;
                $("#imagePreview").html(`
                    <img src="${imageUrl}" style="max-width: 100%; max-height: 200px; border-radius: 5px;">
                    <p style="color: #28a745; margin-top: 5px;">
                        <i class="fas fa-check-circle"></i> New image uploaded
                    </p>
                `);

                // Refresh announcements
                setTimeout(() => {
                    displayAnnouncements();
                }, 500);

                // Close modal after 2 seconds
                setTimeout(() => {
                    $("#UploadAnnouncementImage").modal("hide");
                    // Reset form
                    $("#uploadAnnouncementImageForm")[0].reset();
                    $("#uploadStatus").html("");
                }, 2000);
            }
        },
        error: function (xhr) {
            let errorMsg = "Failed to upload image";
            if (xhr.responseJSON && xhr.responseJSON.error) {
                errorMsg = xhr.responseJSON.error;
            }
            $("#uploadStatus").html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> ${errorMsg}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);
        },
        complete: function () {
            // Re-enable button
            uploadBtn.disabled = false;
            uploadBtn.innerHTML = '<i class="fas fa-upload"></i> Upload Image';
        },
    });
}

// Helper function to show alerts (if you don't have one)
function showAlert(type, message) {
    const alertClass = type === "error" ? "danger" : type;
    const icon =
        type === "error"
            ? "fa-exclamation-circle"
            : type === "warning"
              ? "fa-exclamation-triangle"
              : "fa-check-circle";

    // You can customize this based on your alert system
    // For bootstrap alerts:
    const alertHtml = `
        <div class="alert alert-${alertClass} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
            <i class="fas ${icon}"></i> ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
    $("body").append(alertHtml);
    setTimeout(() => $(".alert").alert("close"), 3000);
}
