<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Add CSRF token -->
    <title>BDMS - Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/dist/css/adminlte.min.css') }}" />
</head>
<body class="container-fluid p-4">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center">BDMS - Master Lists</h2>
            <p class="text-center">Please search and find your membership in this barangay to proceed in create your account</p>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row">
        <div class="col-sm-4">
            <label>Search First name</label>
            <input type="text" id="searchFirstName" class="form-control" placeholder="Please search first name">
        </div>
        <div class="col-sm-4">
            <label>Search Middle name</label>
            <input type="text" id="searchMiddleName" class="form-control" placeholder="Please search middle name">
        </div>
        <div class="col-sm-4">
            <label>Search Last name</label>
            <input type="text" id="searchLastName" class="form-control" placeholder="Please search last name">
        </div>
    </div>

    <!-- Search Buttons -->
    <div class="row mt-3 mb-3">
        <div class="col-sm-12">
            <button type="button" id="searchBtn" class="btn btn-primary">
                <i class="fas fa-search"></i> Search
            </button>
            <button type="button" id="resetBtn" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Reset
            </button>
        </div>
    </div>

    <!-- Results Table -->
    <div class="row mt-2">
        <div class="col-sm-12">
            <table class="table table-hover table-bordered table-striped" id="dataTable">
                <thead class="table table-warning">
                    <tr>
                        <th>No.#</th>
                        <th>Ref. Code</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Account Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="masterListTableBody">
                </tbody>
            </table>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('assets/template/adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/template/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('assets/Javascripts/SearchMasterLists/searchMasterLists.js') }}"></script>
</body>
</html>
