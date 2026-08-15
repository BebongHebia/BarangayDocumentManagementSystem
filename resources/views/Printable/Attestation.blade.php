<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Barangay Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        #mainPage {
            width: 800px;
            height: 1240px;
            margin: auto;
            background-image: url('{{ asset("assets/images/DocImage/ATTESTATION-2026.png") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* Print styles - centered on page */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .no-print {
                display: none !important;
            }

            #mainPage {
                margin: 0 auto;
                page-break-after: avoid;
                break-inside: avoid;
                position: relative;
                left: auto;
                right: auto;
            }

            @page {
                size: portrait;
                margin: auto;
            }

            /* Force background to print */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            /* Ensure the container centers properly */
            .container-fluid,
            .row,
            .col-sm-12 {
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container-fluid {
                min-height: 100vh;
            }
        }

        /* Additional centering for screen view */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f0f0f0;
        }

        .btn-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .pdf-btn {
            background-color: #1e466e;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .pdf-btn:hover {
            background-color: #0d2b48;
        }

        /* Edit panel styles */
        .edit-section {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .edit-toggle {
            background: #4a627a;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-panel {
            display: none;
            margin-top: 10px;
        }

        .edit-panel input {
            display: block;
            width: 250px;
            margin-bottom: 10px;
            padding: 5px;
        }

        .edit-panel button {
            margin-top: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div id="mainPage">
                    @php
                    $userProfile = App\Models\ProfilePic::where('userCode', $transaction->user->userCode)->get()->first();
                    @endphp
                    <p class="text-justify" style="position: relative; top: 290px; left: 90px; width:80%; text-align: justify;" id="displayName">This is to certify that Mr. /Ms. <span><b>{{ $transaction->user->completeName }}</b></span>, <span><b>{{ $transaction->attestation_details->age }}</b></span> YEARS OLD residing at BARANGAY 8, MALAYBALAY CITY, BUKIDNON, is currently <span><b>{{ $transaction->attestation_details->status }}</b></span> earning <span><b>{{ $transaction->attestation_details->income }}</b></span> Php per month.
                        <br><br>Following a thorough assessment and validation of the client’s socio-economic profile conducted by the Barangay Captain/Barangay Kagawad, it has been determined that Mr. /Ms <span><b>{{ $transaction->user->completeName }}</b></span>, is an individual receiving income below the regional minimum wage and is facing significant financial challenges because of the effects of inflation, like the rising prices of goods and services. The above-mentioned income remains insufficient to meet the unforeseen expenses for <span><b>Plain</b></span> ASSISTANCE on top of the family’s monthly household expenses amounting to Php <span><b>{{ $transaction->attestation_details->totalMonthlyHousholdExpense }}</b></span>, thus further straining their limited financial resources.
                        <br><br>This certification is issued upon the request of the above-named person for whatever legal purposes it may serve
                        Issued on <span><b>{{ $transaction->payment->created_at->format('l, M j, Y') }}</b></span>, 2026 at Malaybalay City, Bukidnon.</p>

                </div>
            </div>
        </div>
    </div>

    <div class="btn-container no-print">
        <button class="pdf-btn" id="pdfBtn">📄 Print Document</button>
    </div>


    <script>
        // Display elements
        const displayName = document.getElementById('displayName');
        const displayBirth = document.getElementById('displayBirth');
        const displayStatus = document.getElementById('displayStatus');
        const displayAge = document.getElementById('displayAge');
        const displayGender = document.getElementById('displayGender');
        const displayAddress = document.getElementById('displayAddress');
        const displayCedula = document.getElementById('displayCedula');

        // Update display function
        function updateDisplay() {
            displayName.textContent = formData.name;
            displayBirth.textContent = formData.birth;
            displayStatus.textContent = formData.status;
            displayAge.textContent = formData.age;
            displayGender.textContent = formData.gender;
            displayAddress.textContent = formData.address;
            displayCedula.textContent = formData.cedulaNo;
        }

        // PDF Generation using browser print (NO SECURITY ERRORS!)
        document.getElementById('pdfBtn').addEventListener('click', function() {
            // Save original title
            const originalTitle = document.title;
            document.title = `Barangay_Document_${formData.name.replace(/\s/g, '_')}`;

            // Trigger browser print dialog
            window.print();

            // Restore title
            setTimeout(() => {
                document.title = originalTitle;
            }, 500);
        });

        // Edit functionality
        const toggleBtn = document.getElementById('toggleEditBtn');
        const editPanel = document.getElementById('editPanel');
        const applyBtn = document.getElementById('applyEditBtn');

        const editName = document.getElementById('editName');
        const editBirth = document.getElementById('editBirth');
        const editStatus = document.getElementById('editStatus');
        const editAge = document.getElementById('editAge');
        const editGender = document.getElementById('editGender');
        const editAddress = document.getElementById('editAddress');
        const editCedulaNo = document.getElementById('editCedulaNo');

        let panelVisible = false;

        toggleBtn.addEventListener('click', function() {
            panelVisible = !panelVisible;
            editPanel.style.display = panelVisible ? 'block' : 'none';

            // Update input fields with current values
            if (panelVisible) {
                editName.value = formData.name;
                editBirth.value = formData.birth;
                editStatus.value = formData.status;
                editAge.value = formData.age;
                editGender.value = formData.gender;
                editAddress.value = formData.address;
                editCedulaNo.value = formData.cedulaNo;
            }
        });

        applyBtn.addEventListener('click', function() {
            formData.name = editName.value.trim() || formData.name;
            formData.birth = editBirth.value.trim() || formData.birth;
            formData.status = editStatus.value.trim() || formData.status;
            formData.age = editAge.value.trim() || formData.age;
            formData.gender = editGender.value.trim() || formData.gender;
            formData.address = editAddress.value.trim() || formData.address;
            formData.cedulaNo = editCedulaNo.value.trim() || formData.cedulaNo;

            updateDisplay();

            // Close panel
            panelVisible = false;
            editPanel.style.display = 'none';

            // Show confirmation
            alert('Certificate data updated!');
        });

    </script>
</body>
</html>
