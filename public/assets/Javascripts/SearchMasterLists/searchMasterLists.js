// Function to display all master lists
function displayMasterLists() {
    $.ajax({
        type: "get",
        url: "/get-masterlists",
        success: function (data) {
            let rows = ``;
            let counter = 0;
            let accExists = "";
            let accStatus = "";
            let actionBtn = ``;
            $.each(data, function (index, masterLists) {
                counter++;
                accExists = masterLists.user
                    ? masterLists.user.listCode
                    : "N/A";

                if (accExists != "N/A") {
                    accStatus = "Account Exists";
                    actionBtn = `<a href="/" class="btn btn-warning btn-sm"><i class="fas fa-arrow-right"></i> Login</a>`;
                } else {
                    accStatus = "No account";
                    actionBtn = `<a href="/register/list-code=${masterLists.listCode}" class="btn btn-primary btn-sm"><i class="fas fa-arrow-right"></i> Create Account</a>`;
                }
                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${masterLists.listCode}</td>
                        <td>${masterLists.firstName}</td>
                        <td>${masterLists.middleName}</td>
                        <td>${masterLists.lastName}</td>
                        <td>
                        ${accStatus}
                        </td>
                        <td>
                            ${actionBtn}
                        </td>
                    </tr>
                `;
            });
            $("#masterListTableBody").html(rows);
        },
    });
}

// Search function
function searchMasterLists() {
    // Get values from input fields
    let firstName = $("#searchFirstName").val();
    let middleName = $("#searchMiddleName").val();
    let lastName = $("#searchLastName").val();

    // Show loading indicator
    $("#masterListTableBody").html(
        '<tr><td colspan="6" class="text-center">Searching...</td></tr>',
    );

    $.ajax({
        type: "POST",
        url: "/search-masterlists",
        data: {
            firstName: firstName,
            middleName: middleName,
            lastName: lastName,
            _token: $('meta[name="csrf-token"]').attr("content"), // Add CSRF token for Laravel
        },
        success: function (data) {
            let rows = ``;

            if (data.length === 0) {
                rows = `<tr><td colspan="6" class="text-center text-danger">No records found</td></tr>`;
            } else {
                let counter = 0;
                $.each(data, function (index, masterLists) {
                    counter++;
                    rows += `
                        <tr>
                            <td>${counter}</td>
                            <td>${masterLists.listCode}</td>
                            <td>${masterLists.firstName}</td>
                            <td>${masterLists.middleName}</td>
                            <td>${masterLists.lastName}</td>
                            <td>
                                <a href="/register/list-code=${masterLists.listCode}" class="btn btn-success btn-sm"><i class="fas fa-arrow-right"></i> Continue</a>
                            </td>
                        </tr>
                    `;
                });
            }

            $("#masterListTableBody").html(rows);
        },
        error: function (xhr, status, error) {
            console.error("Search error:", error);
            $("#masterListTableBody").html(
                '<tr><td colspan="6" class="text-center text-danger">Error searching records. Please try again.</td></tr>',
            );
        },
    });
}

// Reset/Clear search function
function resetSearch() {
    $("#searchFirstName").val("");
    $("#searchMiddleName").val("");
    $("#searchLastName").val("");
    displayMasterLists(); // Reload all records
}

// Trigger search on button click or Enter key
$(document).ready(function () {
    // Load all records on page load
    displayMasterLists();

    // Search button click event
    $("#searchBtn").on("click", function () {
        searchMasterLists();
    });

    // Reset button click event
    $("#resetBtn").on("click", function () {
        resetSearch();
    });

    // Optional: Search when user presses Enter key in any search field
    $("#searchFirstName, #searchMiddleName, #searchLastName").on(
        "keypress",
        function (e) {
            if (e.which === 13) {
                // Enter key
                searchMasterLists();
            }
        },
    );
});
