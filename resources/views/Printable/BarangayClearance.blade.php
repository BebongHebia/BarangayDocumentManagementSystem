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
            background-image: url('{{ asset("assets/images/BarangayClearance.jpeg") }}');
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
                    @if($userProfile == null)
                    <img src="{{ asset('assets/images/profile_icon.png') }}" class="img-fluid" style="position: absolute; top: 321px; left: 129px; width:15%; height:10%; border:1px solid black;">
                    @else
                    <img src="{{ asset('storage/' . $userProfile->path) }}" id="profileIcon" class="img-fluid img-circle" style="width:15%; height:10%; border:1px solid black; position: absolute; top: 321px; left: 129px">
                    @endif
                    <h4 class="text-start" style="position: relative; top: 270px; left: 400px" id="displayName">{{ $transaction->user->completeName }}</h4>
                    <h4 class="text-start" style="position: relative; top: 265px; left: 400px" id="displayBirth">{{ $transaction->user->bday }}</h4>
                    <h4 class="text-start" style="position: relative; top: 255px; left: 400px" id="displayStatus">{{ $transaction->user->civilStatus }}</h4>
                    <h4 class="text-start" style="position: relative; top: 250px; left: 400px" id="displayAge">
                        {{ \Carbon\Carbon::parse($transaction->user->bday)->age }}
                    </h4>
                    <h4 class="text-start" style="position: relative; top: 255px; left: 400px" id="displayGender">{{ $transaction->user->sex }}</h4>
                    <h5 class="text-start" style="position: relative; top: 240px; left: 400px" id="displayAddress">{{ $transaction->user->purok }}, {{ $transaction->user->currentAddress }}</h5>
                    <h5 class="text-start" style="position: relative; top: 353px; left: 150px" id="displayCedula">{{ $transaction->payment->cedulaNo }}</h5>
                    <h5 class="text-start" style="position: relative; top: 343px; left: 150px" id="displayCedula">{{ $transaction->payment->cedIssOn }}</h5>
                    <h5 class="text-start" style="position: relative; top: 330px; left: 150px" id="displayCedula">{{ $transaction->payment->cedIssAt }}</h5>
                    <h5 class="text-start" style="position: relative; top: 320px; left: 150px" id="displayCedula">{{ $transaction->payment->cedAmount }}</h5>
                    <h5 class="text-start" style="position: relative; top: 505px; left: 150px" id="displayCedula">{{ $transaction->code }}</h5>
                    <h5 class="text-start" style="position: relative; top: 525px; left: 150px" id="displayCedula">{{ $transaction->payment->orNo }}</h5>
                    <h5 class="text-start" style="position: relative; top: 515px; left: 150px" id="displayCedula">{{ $transaction->payment->orIssOn }}</h5>
                    <p class="text-start" style="position: relative; top: 507px; left: 150px" id="displayCedula">{{ $transaction->payment->orIssAt }}</p>
                    <p class="text-start" style="position: relative; top: 490px; left: 150px" id="displayCedula">{{ $transaction->payment->orAmount }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="btn-container no-print">
        <button class="pdf-btn" id="pdfBtn">📄 Print Document</button>
    </div>

    <!-- Edit section - allows you to change data before printing -->
    <div class="edit-section no-print">
        <button class="edit-toggle" id="toggleEditBtn">✏️ Edit Data</button>
        <div class="edit-panel" id="editPanel">
            <input type="text" id="editName" placeholder="Full Name" value="{{ $transaction->user->completeName }}" />
            <input type="text" id="editBirth" placeholder="Birth Date" value="{{ $transaction->user->bday }}" />
            <input type="text" id="editStatus" placeholder="Civil Status" value="{{ $transaction->user->civilStatus }}" />
            <input type="text" id="editAge" placeholder="Age" value="{{ \Carbon\Carbon::parse($transaction->user->bday)->age }}" />
            <input type="text" id="editGender" placeholder="Gender" value="{{ $transaction->user->sex }}" />
            <input type="text" id="editAddress" placeholder="Address" value="{{ $transaction->user->purok }}, {{ $transaction->user->currentAddress }}" />
            <input type="text" id="editCedulaNo" placeholder="CedulaNo" value="{{ $transaction->payment->cedulaNo }}" />
            <button id="applyEditBtn">Apply Changes</button>
        </div>
    </div>

    <script>
        // Data storage
        let formData = {
            name: 'John Doe Wick'
            , birth: '01/13/1999'
            , status: 'Married'
            , age: '20'
            , gender: 'Male'
            , address: 'Purok 17A, Hagkol, Valencia City'
            , cedulaNo: ''
        , };

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
            document.title = `Barangay_Indigency_${formData.name.replace(/\s/g, '_')}`;

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
