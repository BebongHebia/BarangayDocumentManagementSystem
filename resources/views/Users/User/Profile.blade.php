@extends('Users.User.Sidebar')
@section('sidebar')
@include('Components.Profiles.User.UploadImageModal')
<!-- Content Wrapper. Contains page content -->
<input type="hidden" name="userCode" id="userCode" value="{{ auth()->user()->userCode }}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Profile</h1>
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
                            <h5 class="card-title">Profile Details</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-3">
                                    <center>
                                        @php
                                        $profilePic = App\Models\ProfilePic::where('userCode', auth()->user()->userCode)->first();
                                        @endphp

                                        @if(!$profilePic)
                                        <img src="{{ asset('assets/images/profile_icon.png') }}" id="profileIcon" class="img-fluid img-circle" style="width:50%; border:1px solid black">
                                        @else
                                        <img src="{{ asset('storage/' . $profilePic->path) }}" id="profileIcon" class="img-fluid img-circle" style="width:50%; border:1px solid black">
                                        @endif


                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success btn-block" data-toggle="modal" data-target="#UploadImageModal">
                                                    <i class="fas fa-upload"></i> Upload Image
                                                </button>
                                            </div>
                                        </div>
                                    </center>



                                </div>

                                <div class="col-sm-9">
                                    <form id="editProfileForm">
                                        <input type="hidden" name="userId" value="{{ auth()->user()->id }}">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label>Complete Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="completeName" id="completeName" required>
                                                <div class="invalid-feedback">Please enter complete name</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Sex <span class="text-danger">*</span></label>
                                                <select class="form-select select2" name="sex" id="sex" required style="width:100%">
                                                    <option value="">Select Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                                <div class="invalid-feedback">Please select sex</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Date of Birth <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control" name="bday" id="bday" required>
                                                <div class="invalid-feedback">Please enter date of birth</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Civil Status <span class="text-danger">*</span></label>
                                                <select class="form-select select2" name="civilStatus" id="civilStatus" required style="width:100%">
                                                    <option value="">Select Civil Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Widowed">Widowed</option>
                                                    <option value="Separated">Separated</option>
                                                </select>
                                                <div class="invalid-feedback">Please select civil status</div>
                                            </div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-sm-3">
                                                <label>Place of birth <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="placeOfBirth" id="placeOfBirth" required>
                                                <div class="invalid-feedback">Please enter place of birth</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Citizenship <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="citizenship" id="citizenship" required>
                                                <div class="invalid-feedback">Please enter citizenship</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Phone <span class="text-danger">*</span></label>
                                                <input type="tel" class="form-control" name="phone" id="phone" required pattern="[0-9]{11}">
                                                <div class="invalid-feedback">Please enter valid phone number (11 digits)</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label>Profession <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="profession" id="profession" required>
                                                <div class="invalid-feedback">Please enter profession</div>
                                            </div>
                                        </div>

                                        <h5 class="mt-3">Address</h5>

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label>Sector <span class="text-danger">*</span></label>
                                                <select class="form-select select2" id="purok" name="purok" required style="width:100%">
                                                    <option value="">Select Purok</option>
                                                    <option value="Purok 1">Purok 1</option>
                                                    <option value="Purok 2">Purok 2</option>
                                                    <option value="Purok 3">Purok 3</option>
                                                </select>
                                                <div class="invalid-feedback">Please select purok</div>
                                            </div>
                                            <div class="col-sm-10">
                                                <label>Current Address <span class="text-danger">*</span></label>
                                                <input type="text" name="currentAddress" class="form-control" id="currentAddress" required>
                                                <div class="invalid-feedback">Please enter current address</div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-10">
                                </div>
                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-block" id="editBtn" disabled onclick="editProfile(event)">
                                        <i class="fas fa-save"></i> Save change
                                    </button>
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
<script src="{{ asset('assets/Javascripts/Profiles/Users/profile.js') }}"></script>
@endsection
