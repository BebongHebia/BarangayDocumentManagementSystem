@extends('Users.User.Sidebar')
@section('sidebar')

@include('Components.Transactions.Documents.Attestations.EditAttestationModal')
@include('Components.Transactions.Documents.Attestations.DeleteAttestationModal')
@include('Components.Transactions.Documents.BarCertReg.EditBarCertRegModal')
@include('Components.Transactions.Documents.BarCertReg.DeleteBarCertRegModal')
@include('Components.Transactions.Documents.BarClear.EditBarClearModal')
@include('Components.Transactions.Documents.BarClear.DeleteBarClearModal')
@include('Components.Transactions.Documents.BarClear.ViewBarClearModal')
@include('Components.Transactions.Documents.BarangayIden.DeleteBarIdenModal')
@include('Components.Transactions.Documents.BarangayIden.EditBarIdenModal')
@include('Components.Transactions.Documents.BarIndigent.EditBarIndigentModal')
@include('Components.Transactions.Documents.BarIndigent.DeleteBarIndigentModal')


@include('Components.Transactions.Documents.Attestations.ViewAttestationModal')
@include('Components.Transactions.Documents.BarangayIden.ViewBarIdenModal')
@include('Components.Transactions.Documents.BarCertReg.ViewBarCertModal')
@include('Components.Transactions.Documents.BarIndigent.ViewBarIndigentModal')

<input type="hidden" id="mainUserCode" value="{{ auth()->user()->userCode }}">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Transactions</h1>
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
                            <h5 class="card-title">My Transactions</h5>
                        </div>
                        <div class="card-body">


                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ url('/request-document') }}" type="button" class="btn btn-dark">
                                        <i class="fas fa-plus"></i> Add new transactions
                                    </a>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    @include('Components.Transactions.User.TransactionTable')
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
<script src="{{ asset('assets/Javascripts/Transactions/User/transactions.js') }}"></script>
@endsection
