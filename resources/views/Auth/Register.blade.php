<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BDMS - Register</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('assets/CSS/Registration/register.css') }}">
</head>
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ url('/') }}" class="h1"><b>BDMS</b></a>
            </div>
            <div class="card-body">
                <input type="hidden" name="listCode" id="listCode" value="{{ $masterListData->listCode }}">
                <p class="login-box-msg">Create your account</p>
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

                <form action="{{ url('/register') }}" method="post">
                    @csrf
                    <input type="hidden" name="listCode" value="{{ $listCode ?? '' }}">

                    <!-- ===== NEW FORM FIELDS ===== -->
                    <!-- Personal Information -->
                    <div class="form-section-title"><i class="fas fa-user-circle mr-1"></i> Personal Information</div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Middle Name" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-user"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="suffix" id="suffix" placeholder="Suffix (e.g. Jr.)" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-tag"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="birthdate" id="birthdate" placeholder="Birthdate" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="placeOfBirth" id="placeOfBirth" placeholder="Place of Birth" required>
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
                    <div class="form-section-title"><i class="fas fa-address-card mr-1"></i> Contact & Address</div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <select class="form-control" name="purok" id="purok">
                                    <option value="" disabled selected>Sector/Purok</option>
                                    <option value="Sector 1">Sector I</option>
                                    <option value="Sector 2">Sector II</option>
                                    <option value="Sector 3">Sector III</option>
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-home"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="address" id="address" placeholder="Address" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-home"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="citizenship" id="citizenship" placeholder="Citizenship" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-flag"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="religion" id="religion" placeholder="Religion">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-pray"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="profession" id="profession" placeholder="Profession / Occupation">
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact Number" required>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fas fa-phone-alt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email Address" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="form-section-title"><i class="fas fa-info-circle mr-1"></i> Additional Information</div>

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
                    <div class="form-section-title"><i class="fas fa-user-lock mr-1"></i> Account Credentials</div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-user"></span></div>
                        </div>
                    </div>

                    <!-- Password fields -->
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Retype password" oninput="confirmPassword();" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block" id="addUserButton" disabled>Submit Registration</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
    <script src="{{ asset('assets/Javascripts/Registration/register.js') }}"></script>
</body>
</html>
