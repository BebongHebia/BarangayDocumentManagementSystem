displayTransactions();

function addTransaction(event) {
    event.preventDefault();
    $.ajax({
        type: "post",
        url: baseUrl + "/submit-request",
        data: $("#addTransactionForm").serialize(),
        success: function (data) {
            $("#addTransactionForm")[0].reset();
            $("#CreateTransactionModal").modal("hide");
            swal.fire({
                title: "Success",
                text: "Transaction Deleted Successfully",
                icon: "success",
            });
        },
    });
}

function displayTransactions() {
    var mainUserCode = $("#mainUserCode").val();
    $.ajax({
        type: "get",
        url: "/get-transactions/user-code=" + mainUserCode,
        success: function (data) {
            let rows = "";
            let counter = 0;
            let statusRow = "";
            $.each(data, function (index, transactions) {
                if (transactions.status == "Pending") {
                    statusRow = `
                        <span style="color:black; background-color:orange; padding:5px; border-radius: 10px;">
                            <b>Pending</b>
                        </span>
                    `;
                } else if (transactions.status == "Processing") {
                    statusRow = `
                        <span style="color:black; background-color:yellow; padding:5px; border-radius: 10px;">
                            <b>Processing</b>
                        </span>
                    `;
                } else {
                    statusRow = `
                        <span style="color:white; background-color:green; padding:5px; border-radius: 10px;">
                            <b>Approved</b>
                        </span>
                    `;
                }

                counter++;
                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${transactions.code}</td>
                        <td>${transactions.user.completeName}</td>
                        <td>${transactions.type}</td>
                        <td>${transactions.purpose}</td>
                        <td>${transactions.dateCreated}</td>
                        <td>${transactions.remarks}</td>
                        <td>${statusRow}</td>
                        <td>
                            <a href="/view-transaction/transaction-code=${transactions.code}" class="btn btn-info btn-sm">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </td>
                    </tr>

                `;
            });

            $("#TransactionTableBody").html(rows);
        },
    });
}
