@extends('Users.User.Sidebar')
@section('sidebar')
@include('Components.Transactions.User.CreateTransactionModal')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">View Transaction : <b style="color:blue">{{ $data->type }}</b></h1>
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

                            @if($data->type == "Barangay Indigency")
                            <div class="row">
                                <div class="col-sm-12">
                                    <img src="{{ asset('assets/images/CertificateOfIndigency.jpeg') }}" class="img-fluid">
                                </div>
                            </div>
                            @endif


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
<script src="{{ asset('assets/Javascripts/Transactions/User/transactions.js') }}"></script>
@endsection
