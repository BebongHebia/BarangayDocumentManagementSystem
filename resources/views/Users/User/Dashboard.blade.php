@extends('Users.User.Sidebar')
@section('sidebar')
<input type="hidden" id="userCode" value="{{ Auth::user()->userCode }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Dashboard</h1>
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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                @php
                                $myTotalRequest = App\Models\Transaction::where('userCode', Auth::user()->userCode)->count();
                                @endphp
                                {{ $myTotalRequest }}
                            </h3>

                            <p>My Total Request</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                @php
                                $myTotalPendingRequest = App\Models\Transaction::where('userCode', Auth::user()->userCode)->where('status', 'Pending')->count();
                                @endphp
                                {{ $myTotalPendingRequest }}
                            </h3>

                            <p>Pending Request</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-loop"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->

            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h5 class="card-title">List of my Transactions</h5>
                        </div>
                        <div class="card-body">
                            @include('Components.Dashboard.User.TransactionTable')
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
<script src="{{ asset('assets/Javascripts/Dashboard/User/dashboard.js') }}"></script>
@endsection
