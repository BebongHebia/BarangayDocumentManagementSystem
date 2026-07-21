@extends('Users.Kapitan.Sidebar')
@section('sidebar')
<style>
    .badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

</style>
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
                                $totalUsers = App\Models\User::where('role', 'User')->count();
                                @endphp
                                {{ $totalUsers }}

                            </h3>

                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
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
                                $totalActiveUser = App\Models\User::where('role', 'User')->where('status', 'Active')->count();
                                @endphp
                                {{ $totalActiveUser }}

                            </h3>

                            <p>Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>

                                @php
                                $pendingTransactions = App\Models\Transaction::where('status', 'Pending')->count();
                                @endphp
                                {{ $pendingTransactions }}

                            </h3>

                            <p>Pending Transactions</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-loop"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                @php
                                use App\Models\Payment;
                                $totalAmount = Payment::whereDate('created_at', today())->sum('docAmount');
                                @endphp
                                {{ $totalAmount }}
                            </h3>

                            <p>Total Amount Today {{ date("Y/m/d, D") }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
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
                            <h5 class="card-title">
                                Lists of All Transacitons
                            </h5>
                        </div>
                        <div class="card-body">


                            <div class="card card-info">
                                <div class="card-header">
                                    <h5 class="card-title">Filter Transaction</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <label>Type</label>
                                            <select class="form-select select2" id="filterType" style="width:100%" onchange="displayTransactions('Type', this.value)">
                                                <option value="Barangay Certification">Barangay Certification</option>
                                                <option value="Certificate of Indigency">Certificate of Indigency</option>
                                                <option value="Barangay Clearance">Barangay Clearance</option>
                                            </select>

                                        </div>
                                        <div class="col-sm-4">
                                            <label>Purpose</label>
                                            <select class="form-select select2" style="width:100%" onchange="displayTransactions('Purpose', this.value)">
                                                <option value="Financial Assistance">Financial Assistance</option>
                                                <option value="Medical Assistance">Medical Assistance</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>Date Transact</label>
                                            <input type="date" class="form-control" onchange="displayTransactions('Date', formatDate(this.value))">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-12">
                                            <button class="btn btn-info" onclick="displayTransactions('All', 'All');">
                                                <i class="fas fa-undo"></i> Reset Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    @include('Components.Dashboard.Admin.DashboardTransactionTable')
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
<script src="{{ asset('assets/Javascripts/Dashboard/Admin/dashboard.js') }}">

</script>
@endsection
