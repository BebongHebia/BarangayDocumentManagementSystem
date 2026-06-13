@extends('Users.Admin.Sidebar')
@section('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">View Transaction <b>{{ $transaction->code }} - {{ $transaction->type }}</b></h1>
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
                            <h5 class="card-title">Transaction Details</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Complete Name</label>
                                            <input type="text" name="completeName" id="completeName" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Birthdate</label>
                                            <input type="date" name="bday" id="bday" class="form-control">
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Sex</label>
                                            <input type="date" name="bday" id="bday" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    @if($transaction->type == "Certificate of Indigency")
                                    <img src="{{ asset('assets/images/CertificateOfIndigency.jpeg') }}" class="img-fluid">
                                    @elseif ($transaction->type == "Barangay Clearance")
                                    <img src="{{ asset('assets/images/BarangayClearance.jpeg') }}" class="img-fluid">
                                    @elseif ($transaction->type == "Barangay Certificatio")
                                    <img src="{{ asset('assets/images/BarangayCertification.jpeg') }}" class="img-fluid">
                                    @endif
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
@endsection
