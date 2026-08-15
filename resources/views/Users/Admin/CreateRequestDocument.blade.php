@extends('Users.Admin.Sidebar')
@section('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Create Request Document</h1>
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

            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title">Request Details - <b>{{ $docType }}</b></div>
                        </div>
                        <div class="card-body">

                            @if($docType == "ATTESTATION")
                            @include('Users.User.Documents.AttestationPanel')
                            @elseif ($docType == "BARANGAY-CERTIFICATION-REGULAR")
                            @include('Users.User.Documents.BarCertPanel')
                            @elseif ($docType == "BARANGAY-CERTIFICATION-FTJS")
                            @include('Users.User.Documents.BarCertPanel')
                            @elseif ($docType == "BARANGAY-CLEARANCE")
                            @include('Users.User.Documents.BarClearPanel')
                            @elseif ($docType == "BARANGAY-IDENTIFICATION")
                            @include('Users.User.Documents.BarIdenPanel')
                            @elseif ($docType == "BARANGAY-INDIGENCY-REGULAR")
                            @include('Users.User.Documents.BarIndigentPanel')
                            @elseif ($docType == "BARANGAY-INDIGENCY-WITH-PATIENT-NAME")
                            @include('Users.User.Documents.BarIndigentPanel')
                            @else
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script src="{{ asset('assets/Javascripts/CreateRequestDocument/createRequestDocument.js') }}"></script>
@endsection
