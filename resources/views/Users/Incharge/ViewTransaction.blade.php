@extends('Users.Incharge.Sidebar')
@section('sidebar')
<input type="hidden" id="transactionCode" value="{{ $transaction->code }}">
@include('Components.Transactions.Admin.SetApproveModal')
@include('Components.Transactions.Admin.SetRejectModal')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">View Transaction <b>{{ $transaction->code }} - {{ $transaction->type }}</b></h1>
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
                            <h5 class="card-title">Transaction Details</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <form id="actionTransactionForm">
                                        @csrf
                                        <input type="hidden" name="transactionId" id="transactionId">
                                        <input type="hidden" name="userCode" id="userCode">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Complete Name</label>
                                                <input type="text" name="completeName" id="completeName" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>Birthdate</label>
                                                <input type="date" name="bday" id="bday" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Sex</label>
                                                <select class="form-select select2" name="sex" id="sex" style="width:100%" disabled>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>Civil Status</label>
                                                <select class="form-select select2" name="civilStatus" id="civilStatus" style="width:100%" disabled>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label>Place of birth</label>
                                                <input type="text" name="placeOfBirth" id="placeOfBirth" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Citizenship</label>
                                                <input type="text" name="citizenship" id="citizenship" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Profession</label>
                                                <input type="text" name="profession" id="profession" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Phone</label>
                                                <input type="text" name="phone" id="phone" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>Purok</label>
                                                <input type="text" name="purok" id="purok" class="form-control" readonly>
                                            </div>
                                            <div class="col-sm-10">
                                                <label>Current Address</label>
                                                <input type="text" name="currentAddress" id="currentAddress" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Remarks</label>
                                                <textarea class="form-control" name="remarks" id="remarks" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row mt-2">
                                        <div class="col-sm-4">
                                            <button class="btn btn-success btn-block" onclick="setProcessing(event)">
                                                <i class="fas fa-gavel"></i> Set Processing
                                            </button>
                                        </div>

                                        <div class="col-sm-4">
                                            <button class="btn btn-primary btn-block" onclick="openApproveTransactionModal({{ $transaction->code }})">
                                                <i class="fas fa-gavel"></i> Set Approved
                                            </button>
                                        </div>

                                        <div class="col-sm-4">
                                            <button class="btn btn-danger btn-block" onclick="openRejectTransactionModal({{ $transaction->code }})">
                                                <i class="fas fa-gavel"></i> Set Rejected
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    @if($transaction->type == "Certificate of Indigency")

                                    <img src="{{ asset('assets/images/CertificateOfIndigency.jpeg') }}" class="img-fluid">
                                    @elseif ($transaction->type == "Barangay Clearance")
                                    <img src="{{ asset('assets/images/BarangayClearance.jpeg') }}" class="img-fluid">
                                    @elseif ($transaction->type == "Barangay Certification")
                                    <img src="{{ asset('assets/images/BarangayCertification.jpeg') }}" class="img-fluid">
                                    @endif
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
<script src="{{ asset("assets/Javascripts/ViewTransactions/Admin/viewTransactions.js") }}"></script>
<!-- /.content-wrapper -->
@endsection
