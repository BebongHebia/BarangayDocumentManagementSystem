@extends('Users.User.Sidebar')
@section('sidebar')
@include('Components.ComplaintIncidentReport.CreateComplainIncidentReport')
@include('Components.ComplaintIncidentReport.EditComplainIncidentReport')
@include('Components.ComplaintIncidentReport.DeleteComplainIncidentReport')
<input type="hidden" id="mainUserCode" value="{{ Auth::user()->userCode }}">
<input type="hidden" id="userRole" value="{{ Auth::user()->role }}">
<!-- Content Wrapper. Contains page content -->
<style>
    .complainIncidentReportsCard {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 0;
        background: #ffffff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .complainIncidentReportsCard:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .complainIncidentReportsCard .card-header {
        background: #f8f9fa;
        padding: 12px 15px;
        border-bottom: 1px solid #e0e0e0;
        border-radius: 8px 8px 0 0;
        font-weight: 600;
    }

    .complainIncidentReportsCard .card-body {
        padding: 15px;
        flex: 1;
    }

    .complainIncidentReportsCard .card-footer {
        background: #f8f9fa;
        padding: 10px 15px;
        border-top: 1px solid #e0e0e0;
        border-radius: 0 0 8px 8px;
        font-size: 12px;
    }

    .complaint-field {
        margin-bottom: 10px;
        padding-bottom: 8px;
        border-bottom: 1px dashed #f0f0f0;
    }

    .complaint-field:last-of-type {
        border-bottom: none;
        margin-bottom: 0;
    }

    .field-label {
        font-weight: 600;
        color: #555;
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
    }

    .field-value {
        color: #333;
        font-size: 14px;
        display: block;
        word-wrap: break-word;
    }

    .field-value.sms-message {
        background: #f8f9fa;
        padding: 8px;
        border-radius: 4px;
        font-style: italic;
        font-size: 13px;
        margin-top: 3px;
    }

    .complaint-actions {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #e0e0e0;
    }

    .complaint-actions .btn {
        flex: 1;
        min-width: 60px;
        font-size: 12px;
        padding: 5px 8px;
    }

    /* Badge Styles */
    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }

    .badge-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .complainIncidentReportsCard .card-header h6 {
            font-size: 14px;
        }

        .complaint-actions .btn {
            font-size: 11px;
            padding: 4px 6px;
        }
    }

</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Complaints & Incident Report</h1>
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
                            <h5 class="card-title">Create Complaint & Incident Report</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#CreateComplainIncidentReport">
                                        <i class="fas fa-plus"></i> Create Complain & Incident Report
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    @include('Components.ComplaintIncidentReport.ComplainIncidentContainer')
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('assets/Javascripts/ComplainIncidentReport/User/complainIncidentReport.js') }}"></script>
@endsection
