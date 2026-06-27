@extends('Users.Kapitan.Sidebar')
@section('sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Reports</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <h5 class="card-title">Report Details</h5>
                        </div>
                        <div class="card-body">

                            <!-- Select2 Dropdown for Report Type -->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="reportType">Select Report Type</label>
                                        <select id="reportType" class="form-control select2" style="width: 100%;">
                                            <option value="transactions">Transactions</option>
                                            <option value="population">Population</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Two Panel Layout -->
                            <div class="row">
                                <!-- Transactions Panel -->
                                <div id="transactionsPanel" class="col-md-12">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Transactions Report</h3>
                                        </div>
                                        <div class="card-body">
                                            <!-- Filter Controls -->
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label for="filterType">Filter By</label>
                                                        <select id="filterType" class="form-control">
                                                            <option value="daily">Daily</option>
                                                            <option value="weekly">Weekly</option>
                                                            <option value="monthly">Monthly</option>
                                                            <option value="yearly">Yearly</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3" id="dateInputContainer">
                                                    <div class="form-group">
                                                        <label for="filterDate">Select Date</label>
                                                        <input type="date" id="filterDate" class="form-control" value="{{ date('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3" id="weekInputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="filterWeek">Select Week</label>
                                                        <input type="week" id="filterWeek" class="form-control" value="{{ date('Y-\WW') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3" id="monthInputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="filterMonth">Select Month</label>
                                                        <input type="month" id="filterMonth" class="form-control" value="{{ date('Y-m') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3" id="yearInputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="filterYear">Select Year</label>
                                                        <input type="number" id="filterYear" class="form-control" value="{{ date('Y') }}" min="2000" max="{{ date('Y') }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button id="applyFilterBtn" class="btn btn-primary form-control">Apply Filter</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Debug Info -->
                                            <div id="debugInfo" class="alert alert-info" style="display: none;"></div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped" id="dataTable">
                                                    <thead class="table-dark">
                                                        <th>Code</th>
                                                        <th>Complete Name</th>
                                                        <th>Type</th>
                                                        <th>Date Request</th>
                                                        <th>OR No.#</th>
                                                        <th>Cedula No.#</th>
                                                        <th>Amount</th>
                                                        <th>Date Issue</th>
                                                    </thead>
                                                    <tbody id="transactionReportTableBody">
                                                        <tr>
                                                            <td colspan="8" class="text-center">Loading...</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-sm-12">
                                                    <button id="printReportBtn" class="btn btn-warning" onclick="getFilterType()">
                                                        <i class="fas fa-print"></i> Proceed to print
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Population Panel -->
                                <div id="populationPanel" class="col-md-12" style="display: none;">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Population Report</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>Population data and statistics will be displayed here.</p>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Category</th>
                                                            <th>Count</th>
                                                            <th>Percentage</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td colspan="3" class="text-center">No population data available</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    </section>
</div>

<script src="{{asset('assets/Javascripts/Reports/reports.js')}}"></script>

<!-- Add this script for debugging -->
<script>
    $(document).ready(function() {
        console.log('Document ready - Reports page loaded');

        // Test if jQuery is working
        if (typeof $ !== 'undefined') {
            console.log('jQuery is loaded');
        } else {
            console.error('jQuery is not loaded!');
        }

        // Check if select2 is working
        if ($.fn.select2) {
            console.log('Select2 is loaded');
        } else {
            console.error('Select2 is not loaded!');
        }
    });

</script>

@endsection
