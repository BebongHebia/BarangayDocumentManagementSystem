// In your reports.js file
$(document).ready(function () {
    console.log("reports.js loaded");

    // Initialize Select2
    $(".select2").select2({
        theme: "bootstrap4",
        placeholder: "Select a report type",
        allowClear: false,
    });

    // Handle report type change
    $("#reportType").on("change", function () {
        const selectedValue = $(this).val();
        console.log("Report type changed to:", selectedValue);

        if (selectedValue === "transactions") {
            $("#transactionsPanel").show();
            $("#populationPanel").hide();
        } else if (selectedValue === "population") {
            $("#transactionsPanel").hide();
            $("#populationPanel").show();
        }
    });

    $("#reportType").trigger("change");

    // Handle filter type change
    $("#filterType").on("change", function () {
        const filterType = $(this).val();
        console.log("Filter type changed to:", filterType);

        hideAllFilterInputs();

        if (filterType === "daily") {
            $("#dateInputContainer").show();
        } else if (filterType === "weekly") {
            $("#weekInputContainer").show();
        } else if (filterType === "monthly") {
            $("#monthInputContainer").show();
        } else if (filterType === "yearly") {
            $("#yearInputContainer").show();
        }
    });

    // Initialize with daily filter
    $("#filterType").trigger("change");

    // Apply filter button click
    $("#applyFilterBtn").on("click", function () {
        console.log("Apply filter button clicked");
        displayReports();
    });

    // Also load on page load
    console.log("Calling displayReports on page load");
    displayReports();
});

function hideAllFilterInputs() {
    console.log("Hiding all filter inputs");
    $("#dateInputContainer").hide();
    $("#weekInputContainer").hide();
    $("#monthInputContainer").hide();
    $("#yearInputContainer").hide();
}

function displayReports() {
    console.log("displayReports function called");

    const filterType = $("#filterType").val();
    console.log("Current filter type:", filterType);

    let url = "/get-transaction-reports";
    let params = [];
    let filterInfo = "";

    if (filterType === "daily") {
        const date = $("#filterDate").val();
        console.log("Daily date value:", date);
        if (date) {
            params.push("filter_type=daily");
            params.push("date=" + date);
            filterInfo = "Daily filter for date: " + date;
        }
    } else if (filterType === "weekly") {
        const week = $("#filterWeek").val();
        console.log("Weekly value:", week);
        if (week) {
            params.push("filter_type=weekly");
            params.push("week=" + week);
            filterInfo = "Weekly filter for week: " + week;
        }
    } else if (filterType === "monthly") {
        const month = $("#filterMonth").val();
        console.log("Monthly value:", month);
        if (month) {
            params.push("filter_type=monthly");
            params.push("month=" + month);
            filterInfo = "Monthly filter for month: " + month;
        }
    } else if (filterType === "yearly") {
        const year = $("#filterYear").val();
        console.log("Yearly value:", year);
        if (year) {
            params.push("filter_type=yearly");
            params.push("year=" + year);
            filterInfo = "Yearly filter for year: " + year;
        }
    }

    if (params.length > 0) {
        url += "?" + params.join("&");
    }

    console.log("Request URL:", url);
    console.log("Filter info:", filterInfo);

    // Show debug info
    $("#debugInfo")
        .show()
        .html("Fetching data: " + filterInfo);

    // Show loading
    $("#transactionReportTableBody").html(
        '<tr><td colspan="8" class="text-center">Loading...</td></tr>',
    );

    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function (data) {
            console.log("AJAX Success - Data received:", data);
            console.log("Number of records:", data.length);

            let rows = "";
            let counter = 0;

            if (data.length === 0) {
                console.log("No data found");
                rows = `
                    <tr>
                        <td colspan="8" class="text-center text-warning">No transactions found for the selected period</td>
                    </tr>
                `;
                $("#debugInfo").html(
                    "No transactions found for: " + filterInfo,
                );
            } else {
                console.log("Processing data...");
                $.each(data, function (index, report) {
                    counter++;
                    console.log("Processing record " + counter + ":", report);

                    // Check if relationships exist
                    if (!report.user) {
                        console.warn(
                            "User relationship missing for record:",
                            report,
                        );
                    }
                    if (!report.payment) {
                        console.warn(
                            "Payment relationship missing for record:",
                            report,
                        );
                    }

                    rows += `
                        <tr>
                            <td>${counter}</td>
                            <td>${report.user ? report.user.completeName : "N/A"}</td>
                            <td>${report.type || "N/A"}</td>
                            <td>${report.dateCreated || "N/A"}</td>
                            <td>${report.payment ? report.payment.orNo : "N/A"}</td>
                            <td>${report.payment ? report.payment.cedulaNo : "N/A"}</td>
                            <td>${report.payment ? report.payment.docAmount : "N/A"}</td>
                            <td>${report.payment ? report.payment.cedIssOn : "N/A"}</td>
                        </tr>
                    `;
                });
                $("#debugInfo").html(
                    "Found " + counter + " transactions for: " + filterInfo,
                );
            }

            $("#transactionReportTableBody").html(rows);
            console.log("Table updated with " + counter + " rows");
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
            console.error("Status:", status);
            console.error("Response:", xhr.responseText);

            let errorMessage = "Error loading transactions: " + error;
            if (xhr.responseText) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.message) {
                        errorMessage = response.message;
                    }
                } catch (e) {
                    errorMessage = xhr.responseText.substring(0, 200);
                }
            }

            $("#transactionReportTableBody").html(`
                <tr>
                    <td colspan="8" class="text-center text-danger">${errorMessage}</td>
                </tr>
            `);
            $("#debugInfo")
                .html("Error: " + errorMessage)
                .addClass("alert-danger");
        },
        complete: function () {
            console.log("AJAX request completed");
        },
    });
}

function getFilterType() {
    var filterType = $("#filterType").val();
    var filterDate;
    if (filterType == "daily") {
        filterDate = $("#filterDate").val();
    }

    console.log(filterDate);
}
