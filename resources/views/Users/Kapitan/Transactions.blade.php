@extends('Users.Kapitan.sidebar')
@section('sidebar')
@include('Components.Transactions.Admin.CreateTransactionModal')
<input type="hidden" id="mainUserCode" value="{{ auth()->user()->userCode }}">


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Transactions</h1>
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
                            <h5 class="card-title">Lists of Transactions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-dark" data-toggle="modal" data-target="#CreateTransactionModal">
                                        <i class="fas fa-plus"></i> Create Transactions
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    @include("Components.Transactions.Admin.TransactionTable")
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
<script src="{{ asset('assets/Javascripts/Transactions/Admin/transactions.js') }}"></script>
@endsection
