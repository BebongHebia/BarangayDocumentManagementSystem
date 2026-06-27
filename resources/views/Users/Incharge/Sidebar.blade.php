@extends('Layouts.Layout')
@section('layout')


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <form action="{{ url('/logout') }}" method="POSt">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-block">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/template/adminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">BDMS - Barangay Utso</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/template/adminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->completeName }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                <li class="nav-item">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Dashboard</p>
                    </a>
                </li>



                <li class="nav-item">
                    <a href="{{ url('/transactions') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Transactions</p>
                    </a>
                </li>

                <li class="nav-item">s
                    <a href="{{ url('/masterlists') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Accounts
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/masterlists') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Master Lists</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/resident-accounts') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Resident Account</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/staff-officials') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Staffs & Official</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/organization-chart') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Organizational charts</p>
                    </a>
                </li>




                <li class="nav-item">
                    <a href="{{ url('/population') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Populations</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/calendar-of-activities') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Calendar of Activity</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/announcement') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Announcements</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/reports') }}" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>Reports</p>
                    </a>
                </li>




            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@yield('sidebar')

<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021
        <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>


@endsection
