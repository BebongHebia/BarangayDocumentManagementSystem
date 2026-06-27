@extends('Users.Kapitan.Sidebar')
@section('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Resident Account</h1>
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
                            <h5 class="card-title">Lists of Resident Accounts</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    @include("Components.ResidentsAccount.ResidentsAccountTable")
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
<script src="{{ asset('assets/Javascripts/ResidentsAccount/residentAccount.js') }}"></script>
@endsection
