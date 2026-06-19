displayResidentAccount();
function displayResidentAccount() {
    $.ajax({
        type: "get",
        url: "/get-resident-accounts",
        success: function (data) {
            let rows = "";
            let counter = 0;
            $.each(data, function (index, accounts) {
                counter++;
                rows += `

                    <tr>
                        <td>${counter}</td>
                        <td>${accounts.userCode}</td>
                        <td>${accounts.completeName}</td>
                        <td>${accounts.sex}</td>
                        <td>${accounts.phone}</td>
                        <td>${accounts.purok}, ${accounts.currentAddress}</td>
                        <td>${accounts.status}</td>
                        <td>
                            <center>
                                <a href="/resident-accounts/view-account/user-code=${accounts.userCode}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-user"></i>
                                </a>
                            </center>
                        </td>
                    </tr>

                `;
            });

            $("#residentTableBody").html(rows);
        },
    });
}
