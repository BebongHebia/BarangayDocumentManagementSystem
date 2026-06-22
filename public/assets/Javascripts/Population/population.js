function displayPopulation(option, filter) {
    $.ajax({
        type: "GET",
        url: "/get-population/option=" + option + "/filter=" + filter,
        success: function (data) {
            let rows = "";
            let counter = 0;
            $.each(data, function (index, users) {
                counter++;
                rows += `

                    <tr>
                        <td>${counter}</td>
                        <td>${users.userCode}</td>
                        <td>${users.completeName}</td>
                        <td>${users.sex}</td>
                        <td>${users.bday}</td>
                        <td>${users.placeOfBirth}</td>
                        <td>${users.citizenship}</td>
                        <td>${users.phone}</td>
                        <td>${users.civilStatus}</td>
                        <td>${users.purok}, ${users.currentAddress}</td>
                    </tr>
                
                `;
            });

            $("#populationTableBody").html(rows);
        },
    });
}
displayPopulation("All", "All");
