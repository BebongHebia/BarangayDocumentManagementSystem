function displayTransactions(option, filter) {
    $.ajax({
        type: "GET",
        url:
            "/dashboard-get-transactions/option=" +
            option +
            "/filter=" +
            filter,
        success: function (data) {
            console.log(filter);
            let rows = "";
            let counter = 0;

            $.each(data, function (index, transactions) {
                counter++;

                // Get status badge
                let statusBadge = getStatusBadge(transactions.status);

                let dataOrNo;
                let dataPayment;

                if (transactions.status == "Rejected") {
                    dataOrNo = "Rejected";
                    dataPayment = "Rejected";
                } else {
                    dataOrNo = transactions.payment
                        ? transactions.payment.orNo
                        : "Processing";

                    dataPayment = transactions.payment
                        ? transactions.payment.docAmount
                        : "Processing";
                }

                rows += `
                    <tr>
                        <td>${counter}</td>
                        <td>${transactions.code}</td>
                        <td>${transactions.user.completeName}</td>
                        <td>${transactions.type}</td>
                        <td>${transactions.purpose}</td>
                        <td>${transactions.dateCreated}</td>
                        <td>${dataOrNo}</td>
                        <td>${dataPayment}</td>
                        <td>${statusBadge}</td>
                    </tr>
                `;
            });

            $("#DashboardAdminTransactionTableBody").html(rows);
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
displayTransactions("All", "All");

function getStatusBadge(status) {
    const statusLower = status ? status.toLowerCase() : "";

    const statusMap = {
        pending: "bg-warning text-dark",
        approved: "bg-success",
        processing: "bg-primary",
        rejected: "bg-danger",
    };

    const colorClass = statusMap[statusLower] || "bg-secondary";
    return `<span class="badge ${colorClass}">${status || "N/A"}</span>`;
}

function formatDate(dateString) {
    // Input: 2026-06-12
    // Output: 06-12-2026
    const parts = dateString.split("-");
    const year = parts[0];
    const month = parts[1]; // Keep leading zero
    const day = parts[2]; // Keep leading zero
    return `${month}-${day}-${year}`;
}
