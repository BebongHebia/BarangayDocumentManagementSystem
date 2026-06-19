@extends('Users.Admin.Sidebar')
@section('sidebar')
@include("Components.StaffOfficial.Admin.CreateStaffOfficialModal")
@include("Components.StaffOfficial.Admin.ChangeImageModal")
@include("Components.StaffOfficial.Admin.ChangeStaffOfficialStatusModal")
@include("Components.StaffOfficial.Admin.DeleteStaffOfficialModal")


<style>
    #soContainer {
        width: 100%;
        border: 1px solid rgb(204, 203, 203);
        box-shadow: 3px 3px 3px rgb(236, 204, 204);
        border-radius: 10px;
    }

    #soBody {
        width: 100%;
        padding: 10px;

    }

    #staffImage {
        width: 100%;
        height: 250px;
        /* Fixed height */
        object-fit: cover;
        object-position: center;
        display: block;
        margin: 0 auto;
    }

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Staff & Official</h1>
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
                            <h5 class="card-title">Staff & Officials Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-dark" data-toggle="modal" data-target="#CreateStaffOfficial">
                                        <i class="fas fa-plus"></i> Add new Staff/Officials
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-3" id="staffOfficalDisplayPanel">
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

<!-- Include JavaScript -->
<script src="{{ asset('assets/Javascripts/StaffOfficials/staffOfficial.js') }}"></script>
@endsection
