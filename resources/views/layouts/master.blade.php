<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Pama - Peminjaman Ruangan">
    <meta property="og:title" content="Pama - Peminjaman Ruangan">
    <meta property="og:description" content="Pama - Peminjaman Ruangan">
    <meta property="og:image" content="https://zenix.dexignzone.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">
    <title>Pama - Peminjaman Ruangan </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://jektvnews.disway.id/upload/caf20b7dd2137cf9ab9ce4a272dc5fae.png">
    <link rel="stylesheet" href="{{ asset('vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <!-- Daterange picker -->
    <link href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{ asset('vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <!-- Pick date -->
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/pickadate/themes/default.date.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('vendor/toastr/css/toastr.min.css')}}">
    <!-- Clockpicker -->
    <link href="{{ asset('vendor/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
    <!-- asColorpicker -->
    <link href="{{ asset('vendor/jquery-asColorPicker/css/asColorPicker.min.css') }}" rel="stylesheet">
    <!-- Material color picker -->
    <link href="{{asset('vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

    <!-- Pick date -->

    <!-- Custom Stylesheet -->
    <link href="{{ asset('vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img width="50" height="50"
                    src="https://jektvnews.disway.id/upload/caf20b7dd2137cf9ab9ce4a272dc5fae.png" alt="Icon"
                    fill="white">
                <h2 class="brand-title" fill="white">Pama</h2>
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Chat box start
        ***********************************-->
        <!--**********************************
            Chat box End
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.header')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        @include('layouts.sidebar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- <div class="form-head" style="background-image:url('images/background/bg3.jpg');background-position: bottom; ">
                <div class="container max d-flex align-items-center mt-0">
                    <h2 class="font-w600 title text-white mb-2 mr-auto ">Dashboard</h2>
                    <div class="weather-btn mb-2">
                        <span class="mr-3 font-w600 text-black"><i class="fa fa-cloud mr-2"></i>21</span>
                        <select class="form-control style-1 default-select  mr-3 ">
                            <option>Medan, IDN</option>
                            <option>Jakarta, IDN</option>
                            <option>Surabaya, IDN</option>
                        </select>
                    </div>
                    <a href="javascript:void(0);" class="btn white-transparent mb-2"><i class="las la-calendar scale5 mr-3"></i>Filter Periode</a>
                </div>
            </div> -->
            @yield('content')

        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        @include('layouts.footer')



        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


        <!--**********************************
        Main wrapper end
    ***********************************-->

        <!--**********************************
        Scripts
    ***********************************-->
        <!-- Required vendors -->
        @stack('add-script')
        <script src="{{ asset('vendor/global/global.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js/custom.min.js') }}"></script>
        <script src="{{ asset('js/deznav-init.js') }}"></script>
        <script src="{{ asset('js/demo.js') }}"></script>
        <script src="{{ asset('js/styleSwitcher.js') }}"></script>
        <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
        <!-- pickdate -->
        <!-- Daterangepicker -->
        <!-- momment js is must -->
        <script src="{{ asset('vendor/moment/moment.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <!-- clockpicker -->
        <script src="{{ asset('vendor/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
        <!-- asColorPicker -->
        <script src="{{ asset('vendor/jquery-asColor/jquery-asColor.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-asGradient/jquery-asGradient.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-asColorPicker/js/jquery-asColorPicker.min.js') }}"></script>
        <!-- Material color picker -->
        <script src="{{ asset('vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
        <!-- pickdate -->
        <script src="{{ asset('vendor/pickadate/picker.js') }}"></script>
        <script src="{{ asset('vendor/pickadate/picker.time.js') }}"></script>
        <script src="{{ asset('vendor/pickadate/picker.date.js') }}"></script>


        <!-- Daterangepicker -->
        <script src="{{ asset('js/plugins-init/bs-daterange-picker-init.js') }}"></script>
        <!-- Material color picker init -->
        <script src="{{ asset('js/plugins-init/material-date-picker-init.js') }}"></script>
        <!-- Pickdate -->
        <script src="{{ asset('js/plugins-init/pickadate-init.js') }}"></script>

        <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> --}}

        <!-- Chart piety plugin files -->
        <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>

        <!-- Apex Chart -->
        <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>

        <!-- Dashboard 1 -->
        <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>

        <script src="{{ asset('js/plugins-init/bs-daterange-picker-init.js') }}"></script>
        <!-- Clockpicker init -->
        <script src="{{ asset('js/plugins-init/clock-picker-init.js') }}"></script>
        <!-- asColorPicker init -->
        <script src="{{ asset('js/plugins-init/jquery-asColorPicker.init.js') }}"></script>
        <!-- Material color picker init -->
        <script src="{{ asset('js/plugins-init/material-date-picker-init.js') }}"></script>
        <!-- Pickdate -->
        <script src="{{ asset('js/plugins-init/pickadate-init.js') }}"></script>


        <script src="{{ asset('vendor/owl-carousel/owl.carousel.js') }}"></script>
        
        <script src="{{asset('vendor/toastr/js/toastr.min.js')}}"></script>

        <!-- All init script -->
        <script src="{{asset('js/plugins-init/toastr-init.js')}}"></script>
	<script src="{{asset('js/dashboard/contact.js')}}"></script>
</body>

</html>
