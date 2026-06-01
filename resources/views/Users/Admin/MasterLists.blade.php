@extends('Users.Admin.Sidebar')
@section('sidebar')
@include('Components.MasterLists.CreateMasterListsModal')
@include('Components.MasterLists.EditMasterListModal')
@include('Components.MasterLists.DeleteMasterListsModal')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Master List</h1>
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
                            <h5 class="card-title">Lists of Residents</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#CreateMasterListsModal">
                                        <i class="fas fa-plus"></i> Add new resident
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    @include('Components.MasterLists.MasterListTable')
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
<script src="{{ asset('assets/Javascripts/MasterLists/masterLists.js') }}"></script>
@endsection
