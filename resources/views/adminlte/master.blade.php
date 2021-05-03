<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ 'WESIM | Technos Studio' }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/adminlte/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- CSS Datatable -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">

    @yield('style')

    @stack('scripts-header')
</head>

<body class="hold-transition sidebar-mini sidebar-closed">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!-- Navbar -->
        @include('adminlte.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('adminlte.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="px-5 py-3">
                <!-- Content Header (Page header) -->
                @yield('content')
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->

        @include('adminlte.partials.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/adminlte/dist/js/demo.js') }}"></script>
    <!-- AdminLTE for dataTables -->
    <script src="{{ asset('/adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/adminlte/dist/js/demo.js') }}"></script>

    @yield('script')

    <!-- page script -->
    <script>
        $(function() {
            $("#datatable_pagination").DataTable({
                "responsive": true,
                "autoWidth": true,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": true,
                "autoWidth": true,
                "responsive": true,
            });
        });

    </script>

    @stack('scripts-footer')

</body>

</html>
