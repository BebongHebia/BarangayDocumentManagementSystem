function generateCode() {
    const characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    let code = "";

    for (let i = 0; i < 5; i++) {
        const randomIndex = Math.floor(Math.random() * characters.length);
        code += characters[randomIndex];
    }

    $("#listCode").val("WS-" + code);
}
displayMasterLists();
function displayMasterLists() {
    $.ajax({
        type: "get",
        url: "/get-masterlists",
        success: function (data) {
            let rows = ``;
            let counter = 0;
            $.each(data, function (index, masterLists) {
                counter++;

                let actBtn = '';
                let accExists = masterLists.user ? 'Yes' : 'No';
                if (masterLists.user == null) {
                    actBtn = `
                            <a href="/masterlists/account-creation/masterlists-id=${masterLists.id}" class="btn btn-primary btn-sm">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            <button class="btn btn-warning btn-sm" onclick="openEditMasterListModal(${masterLists.id})">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm" onclick="openDeleteMasterListModal(${masterLists.id})">
                                <i class="fas fa-trash"></i>
                            </button> 
                            
                            
                        `;
                }else{
                    actBtn = 
                    
                            `
                            <button class="btn btn-warning btn-sm" onclick="openEditMasterListModal(${masterLists.id})">
                                <i class="fas fa-edit"></i>
                            </button>

                            <button class="btn btn-danger btn-sm" onclick="openDeleteMasterListModal(${masterLists.id})">
                                <i class="fas fa-trash"></i>
                            </button>

                            
                            
                            `
                            ;
                }

                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${masterLists.firstName}</td>
                        <td>${masterLists.middleName}</td>
                        <td>${masterLists.lastName}</td>
                        <td>${masterLists.listCode}</td>
                        <td>${accExists}</td>
                        <td>${masterLists.status}</td>

                        <td>
                            ${actBtn}
                        </td>
                    </tr>

                `;
            });

            $("#masterListTableBody").html(rows);
        },
    });
}

function openEditMasterListModal(masterListId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-masterlist/list-id=" + masterListId,
        success: function (data) {
            console.log(data.id);
            $("#editMasterListId").val(data.id);
            $("#editListId").val(data.listCode);
            $("#editResType").val(data.resType).trigger('change');
            $("#editFirstName").val(data.firstName);
            $("#editMiddleName").val(data.middleName);
            $("#editLastName").val(data.lastName);
            $("#editSuffix").val(data.suffix);
            $("#editSex").val(data.sex);
            $("#editBirthdate").val(data.birthdate);
            $("#editPlaceOfBirth").val(data.placeOfBirth);
            $("#editBloodType").val(data.bloodType);
            $("#editCivilStatus").val(data.civilStatus);
            $("#editReligion").val(data.religion);
            $("#editCitizenship").val(data.citizenship);
            $("#editPurok").val(data.purok);
            $("#editAddress").val(data.address);
            $("#editEmail").val(data.email);
            $("#editContact").val(data.contact);
            $("#editEducationalAtt").val(data.educationalAtt);
            $("#editProfession").val(data.profession);
        },
    });
    $("#EditMasterListsModal").modal("show");
}

function openDeleteMasterListModal(masterListId) {
    $.ajax({
        type: "get",
        url: baseUrl + "/get-masterlist/list-id=" + masterListId,
        success: function (data) {
            $("#deleteListId").val(data.id);
        },
    });
    $("#DeleteMasterListsModal").modal("show");
}

function deleteMasterLists(event) {
    event.preventDefault();
    $.ajax({
        type: "post",
        url: baseUrl + "/delete-masterlist",
        data: $("#deleteMasterListsForm").serialize(),
        success: function (data) {
            $("#deleteMasterListsForm")[0].reset();
            $("#DeleteMasterListsModal").modal("hide");
            displayMasterLists();
            swal.fire({
                title: "Success",
                text: "MasterLists deleted successfully",
                icon: "success",
            });
        },
    });
}

function editMasterLists(event) {
    event.preventDefault();
    $.ajax({
        type: "post",
        url: baseUrl + "/edit-masterlist",
        data: $("#editMasterListsForm").serialize(),
        success: function (data) {
            $("#editMasterListsForm")[0].reset();
            $("#EditMasterListsModal").modal("hide");
            displayMasterLists();
            swal.fire({
                title: "Success",
                text: "MasterLists edited successfully",
                icon: "success",
            });
        },
    });
}

function addMasterLists(event) {
    event.preventDefault();
    $.ajax({
        type: "post",
        url: baseUrl + "/add-masterlist",
        data: $("#addMasterListsForm").serialize(),
        success: function (data) {
            $("#addMasterListsForm")[0].reset();
            $("#CreateMasterListsModal").modal("hide");
            displayMasterLists();
            swal.fire({
                title: "Success",
                text: "MasterLists added successfully",
                icon: "success",
            });
        },
    });
}
