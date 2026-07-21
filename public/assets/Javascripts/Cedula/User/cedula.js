function addCedula(event) {
    event.preventDefault();

    $.ajax({
        url: "/add-cedula",
        method: "POST",
        data: $("#addCedulaForm").serialize(),
        success: function (data) {
            $("#addCedulaForm")[0].reset();
            $("#AddCedulaModal").modal("hide");
            displayCedula();
            swal.fire({
                title: "Success",
                text: "Cedula Added successfully",
                icon: "success",
            });
        },
    });
}

function editCedula(event) {
    event.preventDefault();

    $.ajax({
        url: "/edit-cedula",
        method: "POST",
        data: $("#editCedulaForm").serialize(),
        success: function (data) {
            $("#editCedulaForm")[0].reset();
            $("#EditCedulaModal").modal("hide");
            displayCedula();
            swal.fire({
                title: "Success",
                text: "Cedula Edited successfully",
                icon: "success",
            });
        },
    });
}

function deleteCedula(event) {
    event.preventDefault();
    $.ajax({
        url: "/delete-cedula",
        method: "POST",
        data: $("#deleteCedulaForm").serialize(),
        success: function (data) {
            $("#deleteCedulaForm")[0].reset();
            $("#DeleteCedulaModal").modal("hide");
            displayCedula();
            swal.fire({
                title: "Success",
                text: "Cedula Deleted successfully",
                icon: "success",
            });
        },
    });
}

displayCedula();
function displayCedula() {
    var userCode = $("#userCode").val();
    $.ajax({
        url: "/get-cedula/userCode=" + userCode,
        method: "GET",
        success: function (data) {
            let rows = ``;
            let counter = 0;

            $.each(data, function (index, cedula) {
                let dataDateAcquired = formatDateFromDatabase(
                    cedula.dateAcquired,
                );
                let dataValidity = formatDateFromDatabase(cedula.validity);
                counter++;
                rows += `

                    <tr>
                        <td>${counter}</td>
                        <td>${cedula.cedulaNo}</td>
                        <td>${dataDateAcquired}</td>
                        <td>${dataValidity}</td>
                        <td>
                            <button class="btn btn-warning" onclick="openEditCedulaModal(${cedula.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger" onclick="openDeleteCedulaModal(${cedula.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                `;
            });

            $("#cedulaTableBody").html(rows);
        },
    });
}

function openDeleteCedulaModal(cedId) {
    $.ajax({
        url: "/get-cedula/ced-id=" + cedId,
        method: "GET",
        success: function (data) {
            $("#deleteCedId").val(data.id);
        },
    });
    $("#DeleteCedulaModal").modal("show");
}

function openEditCedulaModal(cedId) {
    $.ajax({
        url: "/get-cedula/ced-id=" + cedId,
        method: "GET",
        success: function (data) {
            $("#editCedId").val(data.id);
            $("#editCedNo").val(data.cedulaNo);
            $("#editDateAcquired").val(data.dateAcquired);
            $("#editValidity").val(data.validity);
        },
    });
    $("#EditCedulaModal").modal("show");
}

function formatDateFromDatabase(dateStr) {
    if (!dateStr) return "";

    try {
        // Check if it's a valid date format
        const regex = /^\d{4}-\d{2}-\d{2}$/;
        if (!regex.test(dateStr)) return dateStr;

        const parts = dateStr.split("-");
        const year = parseInt(parts[0]);
        const month = parseInt(parts[1]);
        const day = parseInt(parts[2]);

        // Validate the date values
        if (month < 1 || month > 12 || day < 1 || day > 31) return dateStr;

        // Return in MM-DD-YYYY format
        const monthStr = String(month).padStart(2, "0");
        const dayStr = String(day).padStart(2, "0");
        return `${monthStr}-${dayStr}-${year}`;
    } catch (e) {
        return dateStr;
    }
}
