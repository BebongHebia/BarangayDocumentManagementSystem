function addCalendarActivity(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/add-calendar-activity",
        data: $("#addCalendarActivityForm").serialize(),
        success: function (data) {
            $("#addCalendarActivityForm")[0].reset();
            $("#CreateCalendarActivity").modal("hide");
            displayCalendarActivity();
            swal.fire({
                title: "success",
                text: "Calendar Activity Added successfully",
                icon: "success",
            });
        },
    });
}
displayCalendarActivity();
function displayCalendarActivity() {
    var userRole = $("#userRole").val();
    $.ajax({
        type: "get",
        url: "/get-calendar-activity",
        success: function (data) {
            let rows = "";

            $.each(data, function (index, activity) {
                // Helper function to get image URL
                function getImageUrl(imageData) {
                    // Default image
                    let defaultImage = "assets/images/galleryIcon.png";

                    if (!imageData) {
                        return defaultImage;
                    }

                    // If it's a string, check if it's a valid URL
                    if (typeof imageData === "string") {
                        return imageData;
                    }

                    // If it's an object
                    if (typeof imageData === "object") {
                        // Check for path property (most common)
                        if (imageData.path) {
                            return imageData.path;
                        }
                        // Check for URL property
                        if (imageData.url) {
                            return imageData.url;
                        }
                        // Check for fileName and build URL
                        if (imageData.fileName) {
                            return `/storage/calendar_activity_images/${imageData.fileName}`;
                        }
                        // Check for full URL in string representation
                        if (
                            imageData.toString &&
                            imageData.toString().startsWith("http")
                        ) {
                            return imageData.toString();
                        }
                    }

                    return defaultImage;
                }

                // Get the image source
                const imgSrc = getImageUrl(activity.get_cal_act_image);

                // Determine status badge color
                let statusBadge = "badge-secondary";
                if (
                    activity.status === "Active" ||
                    activity.status === "Ongoing"
                ) {
                    statusBadge = "badge-success";
                } else if (
                    activity.status === "Completed" ||
                    activity.status === "Done"
                ) {
                    statusBadge = "badge-primary";
                } else if (activity.status === "Cancelled") {
                    statusBadge = "badge-danger";
                }

                // Check if user is "User" to hide buttons
                const isUser = userRole === "User";

                // Build buttons HTML only if not a User
                let buttonsHtml = "";
                if (!isUser) {
                    buttonsHtml = `
                        <div class="btn-group w-100" role="group">
                            <button class="btn btn-warning btn-sm" onclick="event.stopPropagation(); openUploadCalendarActiModal(${activity.id})">
                                <i class="fas fa-image"></i>
                            </button>
                            <button class="btn btn-info btn-sm" onclick="event.stopPropagation(); openEditCalendarActModal(${activity.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="event.stopPropagation(); openDeleteCalendarActModal(${activity.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                }

                // Determine click handler based on user role
                let clickHandler = "";
                if (isUser) {
                    clickHandler = `onclick="openViewCalendarActivityModal(${activity.id})"`;
                } else {
                    // For non-users, clicking opens the edit modal (or you can make it view too)
                    clickHandler = `onclick="openViewCalendarActivityModal(${activity.id})"`;
                }

                rows += `
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="card shadow-sm mb-4" style="border-radius: 10px; overflow: hidden; cursor: pointer;" ${clickHandler}>
                            <div class="card-body p-0">
                                <img src="${imgSrc}" alt="${activity.activity}" 
                                     class="img-fluid" 
                                     style="height: 180px; width: 100%; object-fit: cover;"
                                     onerror="this.onerror=null; this.src='assets/images/galleryIcon.png';">
                                
                                <div class="p-3">
                                    <h5 class="card-title text-truncate"><b>${activity.activity}</b></h5>
                                    <p class="card-text text-muted" style="font-size: 13px; height: 40px; overflow: hidden;">
                                        ${activity.description || "No description"}
                                    </p>
                                    
                                    <div class="mt-2" style="font-size: 12px;">
                                        <p><i class="fas fa-calendar-alt"></i> ${activity.dateStart}</p>
                                        <p><i class="fas fa-calendar-check"></i> ${activity.dateEnd}</p>
                                        <p><span class="badge ${statusBadge}">${activity.status}</span></p>
                                    </div>
                                    
                                    ${buttonsHtml}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $("#calendarActivityPanel").html(rows);
        },
        error: function (xhr, status, error) {
            console.error("Error loading calendar activities:", error);
            if (typeof toastr !== "undefined") {
                toastr.error("Failed to load calendar activities");
            } else {
                alert("Failed to load calendar activities");
            }
        },
    });
}

function deleteCalendarAct(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/delete-calendar-activity",
        data: $("#deleteCalendarActivityForm").serialize(),
        success: function (data) {
            $("#deleteCalendarActivityForm")[0].reset();
            $("#RemoveCalendarActivity").modal("hide");
            displayCalendarActivity();
            swal.fire({
                title: "success",
                text: "Calendar Activity Removed successfully",
                icon: "success",
            });
        },
    });
}

function updateCalendarAct(event) {
    event.preventDefault();
    $.ajax({
        type: "POST",
        url: baseUrl + "/edit-calendar-activity",
        data: $("#editCalendarActivityForm").serialize(),
        success: function (data) {
            $("#editCalendarActivityForm")[0].reset();
            $("#EditCalendarActivity").modal("hide");
            displayCalendarActivity();
            swal.fire({
                title: "success",
                text: "Calendar Activity Edited successfully",
                icon: "success",
            });
        },
    });
}

function openEditCalendarActModal(calendarActId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-calendar-act/act-id=" + calendarActId,
        success: function (data) {
            $("#editCalendarActId").val(data.id);
            $("#editActivity").val(data.activity);
            $("#editDateStart").val(data.dateStart);
            $("#editDateEnd").val(data.dateEnd);
            $("#editDescription").val(data.description);
            $("#editStatus").val(data.status).trigger("change");
        },
    });

    $("#EditCalendarActivity").modal("show");
}

function openDeleteCalendarActModal(calendarActId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-calendar-act/act-id=" + calendarActId,
        success: function (data) {
            $("#deleteCalendarActId").val(data.id);
        },
    });

    $("#RemoveCalendarActivity").modal("show");
}

/** ----------------------------------- */
function openUploadCalendarActiModal(calendarActId) {
    // Store the activity ID for later use
    $("#UploadCalendarActivityImage").data("activity-id", calendarActId);

    // Reset form and hide preview
    $("#uploadImageCalendarForm")[0].reset();
    $("#imagePreview").hide();
    $("#deleteImageBtn").hide();
    $("#deleteImageBtnFooter").hide();

    // Set default image first
    $("#calActImage").attr("src", "assets/images/galleryIcon.png");

    // Get activity data including image
    $.ajax({
        type: "GET",
        url: baseUrl + "/get-calendar-act/act-id=" + calendarActId,
        success: function (data) {
            // Helper function to extract image URL
            function extractImageUrl(imageData) {
                if (!imageData) return null;

                // If it's a string
                if (typeof imageData === "string") {
                    // Check if it's a valid URL or path
                    if (
                        imageData.startsWith("http") ||
                        imageData.startsWith("/") ||
                        imageData.startsWith("assets/")
                    ) {
                        return imageData;
                    }
                    return null;
                }

                // If it's an object
                if (typeof imageData === "object") {
                    // Check for various possible properties
                    const possibleProps = [
                        "path",
                        "url",
                        "image",
                        "src",
                        "filePath",
                        "fullPath",
                        "fileName",
                    ];

                    for (let prop of possibleProps) {
                        if (
                            imageData[prop] &&
                            typeof imageData[prop] === "string"
                        ) {
                            const value = imageData[prop];
                            if (
                                value.startsWith("http") ||
                                value.startsWith("/") ||
                                value.startsWith("assets/")
                            ) {
                                return value;
                            }
                            // If it's just a filename, build the path
                            if (prop === "fileName" && value) {
                                return `/storage/calendar_activity_images/${value}`;
                            }
                        }
                    }

                    // If no property found, try to stringify and check if it's a URL
                    const stringified = JSON.stringify(imageData);
                    if (
                        stringified &&
                        (stringified.includes("http") ||
                            stringified.includes("/storage/"))
                    ) {
                        // Extract URL from the string
                        const urlMatch = stringified.match(
                            /(https?:\/\/[^\s"']+)/,
                        );
                        if (urlMatch) return urlMatch[0];
                    }
                }

                return null;
            }

            // Extract the image URL
            const imageUrl = extractImageUrl(data.get_cal_act_image);

            // Check if we have a valid image URL
            if (imageUrl) {
                // Set the image source to the actual image
                $("#calActImage").attr("src", imageUrl);
                $("#deleteImageBtn").show();
                $("#deleteImageBtnFooter").show();
                console.log("Image loaded successfully:", imageUrl);
            } else {
                // Keep the default image
                $("#calActImage").attr("src", "assets/images/galleryIcon.png");
                $("#deleteImageBtn").hide();
                $("#deleteImageBtnFooter").hide();
                console.log("No valid image found, using default");
            }

            // Set the image code if available
            if (data.code) {
                $("#imgCode").val(data.code);
            } else if (
                data.get_cal_act_image &&
                typeof data.get_cal_act_image === "object"
            ) {
                if (data.get_cal_act_image.code) {
                    $("#imgCode").val(data.get_cal_act_image.code);
                }
            }
        },
        error: function (xhr, status, error) {
            // In case of error, show the default image
            $("#calActImage").attr("src", "assets/images/galleryIcon.png");
            $("#deleteImageBtn").hide();
            $("#deleteImageBtnFooter").hide();
            console.error("Error loading activity data:", {
                status: xhr.status,
                statusText: xhr.statusText,
                error: error,
                response: xhr.responseText,
            });

            if (typeof toastr !== "undefined") {
                toastr.error("Error loading activity data");
            } else {
                alert("Error loading activity data");
            }
        },
    });

    // Show the modal
    $("#UploadCalendarActivityImage").modal("show");
}

// Handle form submission for uploading/updating image
$(document).ready(function () {
    $("#uploadImageCalendarForm").on("submit", function (e) {
        e.preventDefault();

        var activityId = $("#UploadCalendarActivityImage").data("activity-id");
        var formData = new FormData(this);

        // Validate if file is selected
        var file = $("#imageInput")[0].files[0];
        if (!file) {
            toastr.warning("Please select an image to upload");
            return;
        }

        // Show loading state
        var submitBtn = $("#submitImageBtn");
        var originalHtml = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Uploading...');
        submitBtn.prop("disabled", true);

        $.ajax({
            type: "POST",
            url: baseUrl + "/calendar-image/upload/" + activityId,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.success) {
                    // Update the image in the modal
                    $("#calActImage").attr("src", response.image_path);

                    // Show success message
                    toastr.success(
                        response.message || "Image uploaded successfully!",
                    );

                    // Reset form
                    $("#uploadImageCalendarForm")[0].reset();
                    $("#imagePreview").hide();

                    // Show delete button
                    $("#deleteImageBtn").show();

                    // Update the imgCode if provided
                    if (response.image_data && response.image_data.code) {
                        $("#imgCode").val(response.image_data.code);
                    }

                    // Refresh calendar or page data
                    refreshCalendarData();
                } else {
                    toastr.error(response.message || "Failed to upload image");
                }
            },
            error: function (xhr) {
                var errorMsg = "Error uploading image";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if (xhr.status === 422) {
                    // Validation errors
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        errorMsg = Object.values(errors).flat().join(", ");
                    }
                }
                toastr.error(errorMsg);
            },
            complete: function () {
                // Reset button state
                submitBtn.html(originalHtml);
                submitBtn.prop("disabled", false);
            },
        });
    });
});

// Function to delete image
function deleteCalendarImage() {
    var activityId = $("#UploadCalendarActivityImage").data("activity-id");

    if (!confirm("Are you sure you want to delete this image?")) {
        return;
    }

    // Show loading
    var deleteBtn = $("#deleteImageBtn");
    var originalHtml = deleteBtn.html();
    deleteBtn.html('<i class="fas fa-spinner fa-spin"></i>');
    deleteBtn.prop("disabled", true);

    $.ajax({
        type: "DELETE",
        url: baseUrl + "/calendar-image/delete/" + activityId,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            if (response.success) {
                // Set to default image
                $("#calActImage").attr("src", "assets/images/galleryIcon.png");
                $("#deleteImageBtn").hide();
                $("#imgCode").val("");
                toastr.success(
                    response.message || "Image deleted successfully!",
                );
                refreshCalendarData();
            } else {
                toastr.error(response.message || "Failed to delete image");
            }
        },
        error: function (xhr) {
            toastr.error("Error deleting image");
        },
        complete: function () {
            deleteBtn.html(originalHtml);
            deleteBtn.prop("disabled", false);
        },
    });
}

// Function to refresh calendar data
function refreshCalendarData() {
    // If you're using FullCalendar or similar
    if (typeof calendar !== "undefined" && calendar.refetchEvents) {
        calendar.refetchEvents();
    }

    // If you have a function to reload activities
    if (typeof loadCalendarActivities === "function") {
        loadCalendarActivities();
    }

    // Optional: Reload the page after a delay
    // setTimeout(function() {
    //     location.reload();
    // }, 1500);
}

// Image preview functionality
$(document).ready(function () {
    $("#imageInput").on("change", function (e) {
        var file = this.files[0];
        if (file) {
            // Validate file type
            var validTypes = [
                "image/jpeg",
                "image/png",
                "image/jpg",
                "image/gif",
            ];
            if (!validTypes.includes(file.type)) {
                toastr.error(
                    "Please select a valid image file (JPEG, PNG, JPG, GIF)",
                );
                $(this).val("");
                $("#imagePreview").hide();
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                toastr.error("File size must be less than 2MB");
                $(this).val("");
                $("#imagePreview").hide();
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                $("#previewImage").attr("src", e.target.result);
                $("#imagePreview").show();
            };
            reader.readAsDataURL(file);
        } else {
            $("#imagePreview").hide();
        }
    });
});

/** ------------------------------------ */

function openViewCalendarActivityModal(activityId) {
    // Fetch the specific activity data
    $.ajax({
        type: "get",
        url: baseUrl + "/get-calendar-act/act-id=" + activityId,
        success: function (data) {
            // Helper function to get image URL (reuse the same logic)
            function getImageUrl(imageData) {
                let defaultImage = "assets/images/galleryIcon.png";

                if (!imageData) {
                    return defaultImage;
                }

                if (typeof imageData === "string") {
                    return imageData;
                }

                if (typeof imageData === "object") {
                    if (imageData.path) {
                        return imageData.path;
                    }
                    if (imageData.url) {
                        return imageData.url;
                    }
                    if (imageData.fileName) {
                        return `/storage/calendar_activity_images/${imageData.fileName}`;
                    }
                    if (
                        imageData.toString &&
                        imageData.toString().startsWith("http")
                    ) {
                        return imageData.toString();
                    }
                }

                return defaultImage;
            }

            // Get the image source
            const imgSrc = getImageUrl(data.get_cal_act_image);

            // Update the image
            let imageHtml = `
                <img src="${imgSrc}" alt="${data.activity}" 
                     style="width: 100%; height: 100%; object-fit: cover;"
                     onerror="this.onerror=null; this.src='assets/images/galleryIcon.png';">
            `;
            $("#viewActivityImage").html(imageHtml);

            // Determine status badge color
            let statusBadge = "badge-secondary";
            if (data.status === "Active" || data.status === "Ongoing") {
                statusBadge = "badge-success";
            } else if (data.status === "Completed" || data.status === "Done") {
                statusBadge = "badge-primary";
            } else if (data.status === "Cancelled") {
                statusBadge = "badge-danger";
            }

            // Update the details
            let detailsHtml = `
                <h3 style="margin-top: 0; color: #333;">${data.activity || "Activity"}</h3>
                <hr>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>Description:</strong><br>
                    ${data.description || "No description available"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>Start Date:</strong> ${data.dateStart || "N/A"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>End Date:</strong> ${data.dateEnd || "N/A"}
                </p>
                <p style="font-size: 14px; color: #666; line-height: 1.6;">
                    <strong>Status:</strong> <span class="badge ${statusBadge}">${data.status || "N/A"}</span>
                </p>
            `;
            $("#viewActivityDetails").html(detailsHtml);

            // Show the modal
            $("#ViewCalendarOfActivityModal").modal("show");
        },
        error: function (xhr, status, error) {
            console.error("Error fetching activity details:", error);
            if (typeof toastr !== "undefined") {
                toastr.error("Failed to load activity details");
            } else {
                alert("Failed to load activity details");
            }
        },
    });
}
