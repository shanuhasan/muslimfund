<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    {{-- <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/min/dropzone.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    {{-- <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}
    <div class="wrapper">

        @include('layouts.navbar')
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')

        </div>
        <!-- /.content-wrapper -->

        @include('layouts.footer')
    </div>


    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropzone/min/dropzone.min.js') }}"></script>

    <script type="text/javascript">
        // $(function() {
        //     //Initialize Select2 Elements
        //     $('.select2').select2()

        //     //Initialize Select2 Elements
        //     $('.select2bs4').select2({
        //         theme: 'bootstrap4'
        //     })

        //     //Datemask dd/mm/yyyy
        //     $('#datemask').inputmask('dd/mm/yyyy', {
        //         'placeholder': 'dd/mm/yyyy'
        //     })
        //     //Datemask2 mm/dd/yyyy
        //     $('#datemask2').inputmask('mm/dd/yyyy', {
        //         'placeholder': 'mm/dd/yyyy'
        //     })
        //     //Money Euro
        //     $('[data-mask]').inputmask()

        //     //Date picker
        //     $('#reservationdate').datetimepicker({
        //         format: 'L'
        //     });

        //     //Date and time picker
        //     $('#reservationdatetime').datetimepicker({
        //         icons: {
        //             time: 'far fa-clock'
        //         }
        //     });

        //     //Date range picker
        //     $('#reservation').daterangepicker()
        //     //Date range picker with time picker
        //     $('#reservationtime').daterangepicker({
        //         timePicker: true,
        //         timePickerIncrement: 30,
        //         locale: {
        //             format: 'MM/DD/YYYY hh:mm A'
        //         }
        //     })
        //     //Date range as a button
        //     $('#daterange-btn').daterangepicker({
        //             ranges: {
        //                 'Today': [moment(), moment()],
        //                 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //                 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        //                 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //                 'This Month': [moment().startOf('month'), moment().endOf('month')],
        //                 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
        //                     'month').endOf('month')]
        //             },
        //             startDate: moment().subtract(29, 'days'),
        //             endDate: moment()
        //         },
        //         function(start, end) {
        //             $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
        //                 'MMMM D, YYYY'))
        //         }
        //     )

        //     //Timepicker
        //     $('#timepicker').datetimepicker({
        //         format: 'LT'
        //     })

        //     //Bootstrap Duallistbox
        //     $('.duallistbox').bootstrapDualListbox()

        //     //Colorpicker
        //     $('.my-colorpicker1').colorpicker()
        //     //color picker with addon
        //     $('.my-colorpicker2').colorpicker()

        //     $('.my-colorpicker2').on('colorpickerChange', function(event) {
        //         $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        //     })

        //     $("input[data-bootstrap-switch]").each(function() {
        //         $(this).bootstrapSwitch('state', $(this).prop('checked'));
        //     })

        // })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.summernote').summernote({
                height: '300px'
            });
        });

        $(document).ready(function() {
            $('.js-datetimepicker').datetimepicker({
                // options here
                format: 'Y-m-d H:i:s',
            });

            $('.js-datepicker').datetimepicker({
                // options here
                format: 'Y-m-d',
            });
            $('.js-filterdatepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

    @yield('script')
</body>

</html>
