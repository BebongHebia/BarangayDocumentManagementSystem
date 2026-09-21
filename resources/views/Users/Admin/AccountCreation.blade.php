@extends('Users.Admin.Sidebar')
@section('sidebar')
    <link rel="stylesheet" href="{{ asset('assets/CSS/Registration/register.css') }}">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Account Creation - Master lists</h1>
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

                <div style="width:80%; margin:auto;">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title">
                                Account Creation Form for Master List: {{ $masterListsData->firstName }}
                                {{ $masterListsData->lastName }}
                            </div>

                        </div>
                        <div class="card-body">
                            <!-- ===== NEW FORM FIELDS ===== -->
                            <!-- Personal Information -->


                            <form id="adminAccountCreationForm">
                                <input type="hidden" name="listCode" id="listCode" value="{{ $masterListsData->listCode }}">
                                @csrf
                                <div class="row" style="display: none" id="passwordDoNotMatch">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            <h5 class="text-center">Password does not match</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display: none" id="passwordMatch">
                                    <div class="col-sm-12">
                                        <div class="alert alert-success">
                                            <h5 class="text-center">Password match</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-section-title"><i class="fas fa-user-circle mr-1"></i> Personal Information
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="firstName" id="firstName"
                                                placeholder="First Name" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="middleName" id="middleName"
                                                placeholder="Middle Name" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="lastName" id="lastName"
                                                placeholder="Last Name" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-user"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="suffix" id="suffix"
                                                placeholder="Suffix (e.g. Jr.)" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-tag"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control" name="birthdate" id="birthdate"
                                                placeholder="Birthdate" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="placeOfBirth" id="placeOfBirth"
                                                placeholder="Place of Birth" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-map-pin"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="sex" id="sex" required>
                                                <option value="">Sex</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-venus-mars"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="bloodType" id="bloodType" required>
                                                <option value="">Blood Type</option>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-tint"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="civilStatus" id="civilStatus" required>
                                                <option value="">Civil Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Divorced">Divorced</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Separated">Separated</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-ring"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact & Address -->
                                <div class="form-section-title"><i class="fas fa-address-card mr-1"></i> Contact & Address
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="purok" id="purok">
                                                <option value="" disabled selected>Sector/Purok</option>
                                                <option value="Sector I">Sector I</option>
                                                <option value="Sector II">Sector II</option>
                                                <option value="Sector III">Sector III</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-home"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="address" id="address"
                                                placeholder="Address" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-home"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="citizenship" id="citizenship"
                                                placeholder="Citizenship" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-flag"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="religion" id="religion"
                                                placeholder="Religion">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-pray"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="profession" id="profession"
                                                placeholder="Profession / Occupation">
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="contact" id="contact"
                                                placeholder="Contact Number" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" id="email" placeholder="Email Address"
                                        required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                    </div>
                                </div>

                                <!-- Additional Info -->
                                <div class="form-section-title"><i class="fas fa-info-circle mr-1"></i> Additional
                                    Information
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="educationalAtt" id="educationalAtt">
                                                <option value="" disabled selected>Educational Attainment</option>
                                                <option value="Elementary">Elementary</option>
                                                <option value="High School">High School</option>
                                                <option value="College">College</option>
                                                <option value="POST Grad">POST Grad</option>
                                                <option value="Vocational">Vocational</option>
                                                <option value="Under Grad">Under Grad</option>
                                                <option value="Graduate">Graduate</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-graduation-cap"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="resType" id="resType" required>
                                                <option value="">Resident Type</option>
                                                <option value="Resident">Resident</option>
                                                <option value="Non-Resident">Non-Resident</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text"><i class="fas fa-id-card"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Account Credentials (existing fields) -->
                                <div class="form-section-title"><i class="fas fa-user-lock mr-1"></i> Account Credentials
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="username" id="username"
                                        placeholder="Username" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                </div>

                                <!-- Password fields -->
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Password" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="confirm_password"
                                        id="confirm_password" placeholder="Retype password" oninput="confirmPassword();"
                                        required>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary btn-block" id="addUserButton"
                                            onclick="adminCreateUserAccount()" disabled>Submit
                                            Registration</button>
                                    </div>
                                </div>


                            </form>


                        </div>
                    </div>
                </div>


            </div>


        </section>
    </div>
    <!-- /.content-wrapper -->

    </script>
    <script src="{{ asset('assets/Javascripts/Registration/register.js') }}"></script>
    <script src="{{ asset('assets/Javascripts/AccountCreation/accountCreation.js') }}"></script>
@endsection