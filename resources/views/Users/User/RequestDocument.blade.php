@extends('Users.User.Sidebar')
@section('sidebar')
<!-- Content Wrapper. Contains page content -->

<style>
    .document-card {
        transition: all 0.3s ease;
        display: none;
    }

    .document-card.active {
        display: block;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .document-card .card {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .document-card .card:hover {
        transform: scale(1.02);
    }

    .preview-image {
        max-height: 400px;
        width: auto;
        margin: 0 auto;
        display: block;
    }

    .info-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 10;
    }

    #noDocumentSelected {
        transition: all 0.3s ease;
    }

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Requesting Documents</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h5 class="card-title">Select Document to request</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form id="addRequestForm">
                                        @csrf
                                        <input type="hidden" name="userCode" id="userCode" value="{{ auth()->user()->userCode }}">
                                        <label>Document Type</label>
                                        <select class="form-control" id="documentType" name="type" style="width:100%">
                                            <option selected disabled>Please Select Document Type</option>
                                            <option value="Certificate Indigency">Certificate of Indigency</option>
                                            <option value="Barangay Clearance">Barangay Clearance</option>
                                            <option value="Barangay Certification">Barangay Certification</option>
                                        </select>

                                        <label>Select Purpose</label>
                                        <select class="form-control" id="purpose" name="purpose" style="width:100%">
                                            <option selected disabled>Please Select Purpose</option>
                                            <option value="Financial Assistance">Medical Assistance</option>
                                        </select>

                                        <div class="row mt-2">
                                            <div class="col-sm-4">
                                                <label>Complete Name</label>
                                                <input type="text" name="completeName" id="completeName" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Birthdate</label>
                                                <input type="date" name="birthdate" id="birthdate" class="form-control">
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Age</label>
                                                <input type="text" name="age" id="age" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Civil Status</label>
                                                <select class="form-control" name="civilStatus" id="civilStatus" style="width:100%">
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label>Sex</label>
                                                <select class="form-control" name="sex" id="sex" style="width:100%">
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                                <label>Address</label>
                                                <input type="text" name="address" id="address" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                            <button class="btn btn-success btn-block" id="submitRequestBtn" onclick="addRequest(event);">
                                                <i class="fas fa-plus"></i> Submit Request
                                            </button>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ url('/profile') }}" class="btn btn-info btn-block">
                                                <i class="fas fa-edit"></i> Edit Profile
                                            </a>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-sm-6">
                                    <!-- Certificate of Indigency Card -->
                                    <div class="document-card" id="cardIndigency" style="display: none;">
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h5 class="card-title">Certificate of Indigency</h5>
                                                <div class="info-badge">
                                                    <span class="badge badge-warning">Selected Document</span>
                                                </div>
                                            </div>
                                            <div class="card-body text-center">
                                                <img src="{{ asset('assets/images/CertificateOfIndigency.jpeg') }}" alt="Certificate of Indigency" class="img-fluid preview-image">
                                                <hr>
                                                <small class="text-muted">Preview of Certificate of Indigency</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Barangay Clearance Card -->
                                    <div class="document-card" id="cardClearance" style="display: none;">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h5 class="card-title">Barangay Clearance</h5>
                                                <div class="info-badge">
                                                    <span class="badge badge-danger">Selected Document</span>
                                                </div>
                                            </div>
                                            <div class="card-body text-center">
                                                <img src="{{ asset('assets/images/BarangayClearance.jpeg') }}" alt="Barangay Clearance" class="img-fluid preview-image">
                                                <hr>
                                                <small class="text-muted">Preview of Barangay Clearance</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Barangay Certification Card -->
                                    <div class="document-card" id="cardCertification" style="display: none;">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h5 class="card-title">Barangay Certification</h5>
                                                <div class="info-badge">
                                                    <span class="badge badge-primary">Selected Document</span>
                                                </div>
                                            </div>
                                            <div class="card-body text-center">
                                                <img src="{{ asset('assets/images/BarangayCertification.jpeg') }}" alt="Barangay Certification" class="img-fluid preview-image">
                                                <hr>
                                                <small class="text-muted">Preview of Barangay Certification</small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- No document selected message -->
                                    <div class="alert alert-info text-center" id="noDocumentSelected">
                                        <i class="fas fa-info-circle"></i> Select a document type from the dropdown to see preview
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="{{ asset('assets/Javascripts/RequestDocuments/Users/requestDocuments.js') }}"></script>


@endsection
