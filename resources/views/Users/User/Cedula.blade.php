@extends('Users.User.Sidebar')
@section('sidebar')
@include('Components.Cedula.User.AddCedulaModal')
@include('Components.Cedula.User.EditCedulaModal')
@include('Components.Cedula.User.DeleteCedulaModal')
<input type="hidden" id="userCode" value="{{ Auth::user()->userCode }}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Cedula</h1>
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



            <div class="row mt-2">
                <div class="col-sm-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title">Cedula Details</div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-dark" data-toggle="modal" data-target="#AddCedulaModal">
                                        <i class="fas fa-plus"></i> Add Cedula
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    @include('Components.Cedula.User.CedulaTable')
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<script src="{{ asset('assets/Javascripts/Cedula/User/cedula.js') }}"></script>
@endsection
