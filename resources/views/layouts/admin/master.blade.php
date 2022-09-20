<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Dashboard Owner PT.MBM')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Datatable CDN -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/date-1.1.2/fh-3.2.4/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.css" />
    <!-- Tailwind Styling -->
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="{{ asset('themes/plugins/bootstrap/css/bootstrap.min.css') }}"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Datatable -->
    <!-- <link href="{{ asset('themes/plugins/datatables/DataTables-1.11.4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> -->


    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/plugins/jquery-ui/jquery-ui.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/dist/css/adminlte.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('themes/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
@yield('custom_css')
<style>
    @font-face {
        font-family: 'Poppins';
        src: url('{{ asset('themes/font/Poppins/Poppins-Regular.ttf') }}');
    }

    aside {
        background: #8199AE;
    }

    body {
        font-family: 'Poppins';
        background-color: #F0F0F0;
    }

    footer {
        bottom: 0;
        position: fixed;
        width: 100%;
    }

    @media screen and (min-width:992px) {
        body {
            font-size: 14px;
        }
    }

    @media screen and (max-width:991px) {
        body {
            font-size: 12px;
        }
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('layouts.admin.sidebar')

        @yield('content')


        @include('layouts.modal.delete')

        <footer class="main-footer tw-bg-prim-blue tw-z-40">
            <span class="tw-font-bold tw-text-prim-white">PT Maju Bersama Motor</span>
            <!-- <span class="float-right"><strong> PT.MBM  &copy; <script>
                document.write(new Date().getFullYear());
            </script> .</strong></span> -->
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('themes/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!--Datatable CDN JS -->
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/date-1.1.2/fh-3.2.4/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/datatables.min.js">
    </script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('themes/plugins/select2/js/select2.min.js') }}"></script>

    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ asset('themes/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- <script src="{{ asset('themes/plugins/datatables/DataTables-1.11.4/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('themes/plugins/datatables/DataTables-1.11.4/js/dataTables.bootstrap4.min.js') }}"></script> -->


    <!-- Slimscroll -->
    {{-- <script src="{{ asset('themes/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script> --}}
    <!-- FastClick -->
    {{-- <script src="{{ asset('themes/plugins/fastclick/fastclick.js') }}"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('themes/dist/js/adminlte.js') }}"></script>

    <!-- Font Awesome -->
    <!-- <script type="text/javascript" src="{{ asset('themes/plugins/fontawesome-free/js/all.min.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    @yield('script')
</body>

</html>
