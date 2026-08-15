@extends('Users.User.Sidebar')
@section('sidebar')

<link rel="stylesheet" href="{{ asset('assets/CSS/RequestDocument/requestDocument.css') }}">

<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Requesting Documents</h1>
                </div>
            </div>
        </div>
    </div>

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
                                    <label>Please Select Document Type</label>
                                    <select class="form-select select2" id="docType" style="width:100%" onchange="toggleDocumentPanels(this.value)">
                                        <option value="ATTESTATION">ATTESTATION</option>
                                        <option value="BARANGAY CERTIFICATION">BARANGAY CERTIFICATION</option>
                                        <option value="BARANGAY CLEARANCE">BARANGAY CLEARANCE</option>
                                        <option value="BARANGAY IDENTIFICATION">BARANGAY IDENTIFICATION</option>
                                        <option value="BARANGAY INDIGENCY">BARANGAY INDIGENCY</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Attestation Panel -->
                                    <div id="attestationContainer" class="document-panel">
                                        <div class="panel-header">
                                            <div class="icon-circle attestation">
                                                <i class="fas fa-stamp"></i>
                                            </div>
                                            <h5>Attestation</h5>
                                        </div>
                                        <div class="panel-body">
                                            <center>
                                                <img src="{{ asset('assets/images/DocImage/ATTESTATION-2026.jpg') }}" style="max-width: 40%" class="img-fluid">
                                            </center>

                                            <a href="{{ url('/request-document/docType=ATTESTATION/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request">
                                                <i class="fas fa-paper-plane"></i>
                                                Request Attestation
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Barangay Certification Panel -->
                                    <div id="barCertPanel" class="document-panel">
                                        <div class="panel-header">
                                            <div class="icon-circle certification">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                            <h5>Barangay Certification</h5>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label>Select Barangay Certification Type</label>
                                                    <select class="form-select select2" id="barCertType" onchange="toggleBarCertPanels()">
                                                        <option value="Regular">Regular</option>
                                                        <option value="First Time Job-Seeker">First Time Job-Seeker</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Regular Panel -->
                                            <div id="regularCertPanel" class="cert-sub-panel">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <img src="{{ asset('assets/images/DocImage/BARANGAY-CERTIFICATION-2026.jpg') }}" class="doc-image img-fluid" style="max-width: 40%; margin-top: 15px;">
                                                        </center>
                                                        <a href="{{ url('/request-document/docType=BARANGAY-CERTIFICATION-REGULAR/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request mt-3">
                                                            <i class="fas fa-paper-plane"></i>
                                                            Request Regular Certification
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- First Time Job-Seeker Panel -->
                                            <div id="firstTimeJobSeekerPanel" class="cert-sub-panel" style="display: none;">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <img src="{{ asset('assets/images/DocImage/BARANGAY-CERTIFICATION-2026-FIRST-TIME-JOB-SEEKER.jpg') }}" class="doc-image img-fluid" style="max-width: 40%; margin-top: 15px;">
                                                        </center>
                                                        <a href="{{ url('/request-document/docType=BARANGAY-CERTIFICATION-FTJS/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request mt-3">
                                                            <i class="fas fa-paper-plane"></i>
                                                            Request First Time Job-Seeker Certification
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Barangay Clearance Panel -->
                                    <div id="barClerPanel" class="document-panel">
                                        <div class="panel-header">
                                            <div class="icon-circle clearance">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                            <h5>Barangay Clearance</h5>
                                        </div>
                                        <div class="panel-body">
                                            <center>
                                                <img src="{{ asset('assets/images/DocImage/BARANGAY-CLEARANCE-2026.jpg') }}" style="max-width: 40%" class="img-fluid">
                                            </center>
                                            <a href="{{ url('/request-document/docType=BARANGAY-CLEARANCE/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request">
                                                <i class="fas fa-paper-plane"></i>
                                                Request Barangay Clearance
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Barangay Identification Panel -->
                                    <div id="barIdenPanel" class="document-panel">
                                        <div class="panel-header">
                                            <div class="icon-circle identification">
                                                <i class="fas fa-id-card"></i>
                                            </div>
                                            <h5>Barangay Identification</h5>
                                        </div>
                                        <div class="panel-body">
                                            <center>
                                                <img src="{{ asset('assets/images/DocImage/BARANGAY-IDENTIFICATION-2026.jpg') }}" style="max-width: 40%" class="img-fluid">
                                            </center>
                                            <a href="{{ url('/request-document/docType=BARANGAY-IDENTIFICATION/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request">
                                                <i class="fas fa-paper-plane"></i>
                                                Request Barangay ID
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Barangay Indigency Panel -->
                                    <div id="barIndiPanel" class="document-panel">
                                        <div class="panel-header">
                                            <div class="icon-circle indigency">
                                                <i class="fas fa-hand-holding-heart"></i>
                                            </div>
                                            <h5>Barangay Indigency</h5>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label>Select Indigency Type</label>
                                                    <select class="form-select select2" id="barIndiType" onchange="toggleBarIndiPanels()">
                                                        <option value="Regular">Regular</option>
                                                        <option value="With Patient Name">With Patient Name</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Regular Panel -->
                                            <div id="regularIndiPanel" class="cert-sub-panel">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <img src="{{ asset('assets/images/DocImage/BARANGAY-INDIGENCY-2026-NEW-Copy.jpg') }}" style="max-width: 40%" class="img-fluid">
                                                        </center>
                                                        <a href="{{ url('/request-document/docType=BARANGAY-INDIGENCY-REGULAR/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request mt-3">
                                                            <i class="fas fa-paper-plane"></i>
                                                            Request Indigency Certificate
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- With Patient Name Panel -->
                                            <div id="withPatientNamePanel" class="cert-sub-panel" style="display: none;">
                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <center>
                                                            <img src="{{ asset('assets/images/DocImage/BARANGAY-INDIGENCY-2026-WITH-PATIENT-NAME.jpg') }}" style="max-width: 40%" class="img-fluid">
                                                        </center>
                                                        <a href="{{ url('/request-document/docType=BARANGAY-INDIGENCY-WITH-PATIENT-NAME/user-code=' . Auth::user()->userCode) }}" class="btn-submit-request mt-3" onclick="submitWithPatientName()">
                                                            <i class="fas fa-paper-plane"></i>
                                                            Request Indigency with Patient Name
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('assets/Javascripts/RequestDocuments/Users/requestDocuments.js') }}"></script>

@endsection
