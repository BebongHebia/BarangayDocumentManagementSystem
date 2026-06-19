@extends('Users.Admin.Sidebar')
@section('sidebar')
@include("Components.Profiles.Admin.UploadImageModal")
@include("Components.Profiles.Admin.TakePictureModal")
<link rel="stylesheet" href="{{ asset("assets/CSS/ViewResidentAccounts/viewResidentAccount.css") }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">View Account</h1>
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
                            <h5 class="card-title">Account Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <center>
                                        <div class="profile-image-container">
                                            @php
                                            $profilePic = App\Models\ProfilePic::where('userCode', $user->userCode)->first();
                                            @endphp

                                            <div class="profile-image-wrapper">
                                                @if(!$profilePic)
                                                <img src="{{ asset('assets/images/profile_icon.png') }}" id="profileIcon" class="profile-image" alt="Profile Picture">
                                                @else
                                                <img src="{{ asset('storage/' . $profilePic->path) }}" id="profileIcon" class="profile-image" alt="Profile Picture">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-sm-12">
                                                <button class="btn btn-info btn-block" data-toggle="modal" data-target="#UploadImageModal">
                                                    <i class="fas fa-upload"></i> Upload Image
                                                </button>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                                <div class="col-sm-9">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h5 class="card-title">User Code : {{ $user->userCode }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="editResidentAccountForm" novalidate>
                                                @csrf
                                                <input type="hidden" name="userCode" id="userCode" value="{{ $user->userCode }}">
                                                <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <label>Complete Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="completeName" id="completeName" required>
                                                        <div class="invalid-feedback">Please enter complete name.</div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label>Sex <span class="text-danger">*</span></label>
                                                        <select class="form-select select2" name="sex" id="sex" style="width:100%" required>
                                                            <option value="">Select Sex</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select sex.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label>Birthday <span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" name="bday" id="bday" required>
                                                        <div class="invalid-feedback">Please enter birthday.</div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Place of Birth <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="placeOfBirth" id="placeOfBirth" required>
                                                        <div class="invalid-feedback">Please enter place of birth.</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Civil Status <span class="text-danger">*</span></label>
                                                        <select class="form-select select2" name="civilStatus" id="civilStatus" style="width:100%" required>
                                                            <option value="">Select Civil Status</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widowed">Widowed</option>
                                                            <option value="Separated">Separated</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select civil status.</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Phone No.# <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="phone" id="phone" required>
                                                        <div class="invalid-feedback">Please enter phone number.</div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label>Profession <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="profession" id="profession" required>
                                                        <div class="invalid-feedback">Please enter profession.</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Status <span class="text-danger">*</span></label>
                                                        <select class="form-select select2" name="status" id="status" style="width:100%" required>
                                                            <option value="">Select Status</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select status.</div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Citizenship <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="citizenship" id="citizenship" required>
                                                        <div class="invalid-feedback">Please enter profession.</div>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <label>Current Address <span class="text-danger">*</span></label>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" name="purok" id="purok" placeholder="Purok" required>
                                                                <div class="invalid-feedback">Please enter purok.</div>
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="currentAddress" id="currentAddress" placeholder="Street/Barangay" required>
                                                                <div class="invalid-feedback">Please enter current address.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row mt-2">
                                                <div class="col-sm-10">
                                                    <div id="validationMessage" style="display: none;" class="alert alert-danger">
                                                        <i class="fas fa-exclamation-circle"></i> Please fill in all required fields.
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-block btn-info" onclick="validateAndSubmit(event)">
                                                        <i class="fas fa-save"></i> Save changes
                                                    </button>
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
<script src="{{ asset('assets/Javascripts/ViewResidentAccount/viewResidentAccount.js') }}"></script>
@endsection
