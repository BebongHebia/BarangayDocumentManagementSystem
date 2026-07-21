displayMyTransactions();
function displayMyTransactions() {
    var userCode = $("#userCode").val();
    $.ajax({
        type: "get",
        url: "/get-transactions/user-code=" + userCode,
        success: function (data) {
            let counter = 0;
            let rows = ``;

            $.each(data, function (index, transaction) {
                let dataOrNo;
                let dataPayment;
                let statusBadge = getStatusBadge(transaction.status);
                if (transaction.status == "Rejected") {
                    dataOrNo = "Rejected";
                    dataPayment = "Rejected";
                } else {
                    dataOrNo = transaction.payment
                        ? transaction.payment.orNo
                        : "Processing";

                    dataPayment = transaction.payment
                        ? transaction.payment.docAmount
                        : "Processing";
                }
                counter++;
                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${transaction.code}</td>
                        <td>${transaction.type}</td>
                        <td>${transaction.purpose}</td>
                        <td>${transaction.dateCreated}</td>
                        <td>${dataOrNo}</td>
                        <td>${dataPayment}</td>
                        <td>${statusBadge}</td>
                    </tr>

                `;
            });

            $("#dashboardTransactionTableBody").html(rows);
        },
    });
}

// Simple status badge function
function getStatusBadge(status) {
    // Convert to lowercase for comparison
    const statusLower = status ? status.toLowerCase() : "";

    // Define colors for each status
    let badgeClass = "badge bg-secondary"; // default
    let displayText = status || "N/A";

    if (statusLower === "pending") {
        badgeClass = "badge bg-warning text-dark";
    } else if (statusLower === "approved") {
        badgeClass = "badge bg-success";
    } else if (statusLower === "processing") {
        badgeClass = "badge bg-primary";
    } else if (statusLower === "rejected") {
        badgeClass = "badge bg-danger";
    }

    return `<span class="${badgeClass}">${displayText}</span>`;
}
