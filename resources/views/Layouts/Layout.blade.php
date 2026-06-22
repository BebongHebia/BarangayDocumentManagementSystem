<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangay Document Management System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/fontawesome-free/css/all.min.css') }}" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" />

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/jqvmap/jqvmap.min.css') }}" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/dist/css/adminLTE.min.css') }}" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/daterangepicker/daterangepicker.css') }}" />
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/template/adminLTE/plugins/summernote/summernote-bs4.min.css') }}" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @yield('layout')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/template/adminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/template/adminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/template/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script><!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/template/adminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/template/adminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/template/adminLTE/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/template/adminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/template/adminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/template/adminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/template/adminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/template/adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/template/adminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/template/adminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- adminLTE App -->
    <script src="{{ asset('assets/template/adminLTE/dist/js/adminLTE.js') }}"></script>
    <!-- adminLTE for demo purposes -->
    <script>
        $(function() {
            $("#dataTable")
                .DataTable({
                    responsive: true
                    , lengthChange: false
                    , autoWidth: false
                    , buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
                , })
                .buttons()
                .container()
                .appendTo("#dataTable_wrapper .col-md-6:eq(0)");
            $("#example2").DataTable({
                paging: true
                , lengthChange: false
                , searching: false
                , ordering: true
                , info: true
                , autoWidth: false
                , responsive: true
            , });
        });

    </script>
    <script>
        const baseUrl = "{{ url('/') }}";

        $(function() {
            $(".select2").select2();
        });

    </script>

</body>
</html>
