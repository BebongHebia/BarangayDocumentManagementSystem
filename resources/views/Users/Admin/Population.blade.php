@extends('Users.Admin.Sidebar')
@section('sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Population</h1>
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
                            <h5 class="card-title">Population Details</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Map here -->
                                    <div style="width: 100%; height: 500px;">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7890.784290794043!2d125.1296014!3d8.1533746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32ffaa288fd8a759%3A0x95e16b230d9904bf!2sBarangay%208%2C%20Malaybalay%20City%2C%20Bukidnon!5e0!3m2!1sen!2sph!4v1710000000000" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                        </iframe>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="card card-dark">
                                        <div class="card-header">
                                            <h5 class="card-title">Population Breakdown</h5>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <label>Filter Sector</label>
                                                    <select class="form-select select2" name="filterSector" id="filterSector" onchange="displayPopulation('Sector', this.value)" style="width:100%;">
                                                        <option value="Sector I">Sector I</option>
                                                        <option value="Sector II">Sector II</option>
                                                        <option value="Sector III">Sector III</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Filter Status</label>
                                                    <select class="form-select select2" name="filterStatus" id="filterStatus" onchange="displayPopulation('Status', this.value)" style="width:100%;">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Filter Sex</label>
                                                    <select class="form-select select2" name="filterSex" id="filterSex" onchange="displayPopulation('Sex', this.value)" style="width:100%;">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label>Civil Status</label>
                                                    <select class="form-select select2" name="filterCivilStatus" id="filterCivilStatus" onchange="displayPopulation('Status', this.value)" style="width:100%;">
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Separated">Separated</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">
                                                    @include('Components.Population.PopulationTable')
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-sm-12">




                                                    <div class="col-sm-3">
                                                        <div class="card card-dark">
                                                            <div class="card-header">
                                                                <h5 class="card-title">Total Status Details</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        @php
                                                                        $totalActiveStatus = App\Models\User::where("status", "Active")->where('role', "!=", "Admin")->count();
                                                                        @endphp
                                                                        <h2 class="text-center">
                                                                            {{ $totalActiveStatus }}
                                                                        </h2>
                                                                        <p class="text-center">Acive</p>
                                                                    </div>

                                                                    <div class="col-sm-6">
                                                                        @php
                                                                        $totalActiveStatus = App\Models\User::where("status", "Inactive")->where('role', "!=", "Admin")->count();
                                                                        @endphp
                                                                        <h2 class="text-center">
                                                                            {{ $totalActiveStatus }}
                                                                        </h2>
                                                                        <p class="text-center">Inactive</p>
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
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="{{ asset('assets/Javascripts/Population/population.js') }}"></script>
@endsection
