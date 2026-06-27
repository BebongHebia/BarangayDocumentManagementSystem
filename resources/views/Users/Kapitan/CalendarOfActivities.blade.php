@extends('Users.Kapitan.Sidebar')
@section('sidebar')
@include('Components.CalendarActivity.CreateCalendarActivity')
@include('Components.CalendarActivity.EditCalendarActivityModal')
@include('Components.CalendarActivity.RemoveCalendarActivityModal')
@include('Components.CalendarActivity.UploadCalendarActivityImage')
<style>
    #calendarActContainer {
        width: 100%;
        border: 1px solid rgb(172, 172, 172);
        box-shadow: 3px 3px 3px gray;
        border-radius: 5px;
        padding: 5px;
    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Calendar of Activities</h1>
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
            <input type="hidden" id="userRole" value="{{Auth::user()->role}}">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h5 class="card-title">Calendar of Activities Details</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-dark" data-toggle="modal" data-target="#CreateCalendarActivity">
                                        <i class="fas fa-plus"></i> Add Calendar Activity
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-2" id="calendarActivityPanel">
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
<script src="{{ asset('assets/Javascripts/CalendarActivity/calendarActivity.js') }}"></script>
@endsection
