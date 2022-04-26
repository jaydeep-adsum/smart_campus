<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('public/favicon.ico') }}" type="image/png">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/assets/css/ionicons.min.css')}}">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/fullcalendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/cdn/buttons.dataTables.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/select2/css/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/assets/css/dist/adminlte.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/iCheck/flat/blue.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/iCheck/all.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/morris/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('public/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('public/assets/css/fonts/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/pnotify.custom.min.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <!--sweetalert2  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/sweetalert.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('public/assets/plugins/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css')}}">
    <link href="{{asset('public/assets/izitoast/css/iziToast.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/inttel/css/intlTelInput.css') }}">
    <style>
        .card-head-div{
            display: flex;
            justify-content: end;
        }
        .main-header{
            position: fixed;
            top: 0;
            left: 0;
            width: calc(100% - 260px);
        }
        input[type='file'] {
            display:none;
        }
        .file-label {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
        }
        .content-wrapper .header-div{
            top: 57px;
            position: fixed;
            z-index: 1;
        }
        .content-wrapper>.content {
            padding: 120px 0rem 0;
        }
        .campus-sidebar{
            height: 100vh;
        }
        .footer{
            bottom: 0;
            position: sticky;
            width: 100%;
        }
        .alert{
            background: #D94B09 !important;
            border-color: #D94B09 !important;
            font-weight: bold;
        }
        .mandatory{
            color: #ff0000;
            font-weight: bold;
        }
    </style>
    @yield("extra_css")
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
@include('layouts.header')
<!-- /.navbar -->

    <aside class="main-sidebar">
    @include('layouts.sidebar')
    <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
        <div class="content-header p-0">
            <div class="container-fluid bg-white py-3 header-div">
                    <h3 class="card-title m-0 p-0 pl-4">@yield('title')</h3>
            </div>
        </div>
        <section class="content mt-4">
            <div class="container-fluid px-5">
                @yield('content')
            </div>
{{--            <div class="footer bg-white p-3">--}}
{{--                <div class="text-dark">--}}
{{--                    <span class="">All Rights Reserved ©2022</span>--}}
{{--                    <a href="#" target="_blank" class="text-gray-800 text-hover-primary">Smart Campus</a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </section>
    </div>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
</div>

@yield('script2')

<script src="{{asset('public/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{ asset('public/assets/js/inttel/js/intlTelInput.min.js') }}"></script>
<script src="{{ asset('public/assets/js/inttel/js/utils.min.js') }}"></script>
<script>
    let loaderUrl = "{{asset('public/loader.gif')}}";
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('public/assets/js/cdn/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/cdn/dataTables.buttons.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/cdn/buttons.print.min.js')}}"></script>
<script src="{{asset('public/assets/js/adminlte.js')}}"></script>
<script src="{{ asset('public/assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('public/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
{{-- <script src="{{ asset('public/plugins/chart/Chart.js') }}"></script> --}}
<script src="{{ asset('public/assets/js/sweetalert.min.js') }}"></script>
<script src="{{asset('public/assets/izitoast/js/iziToast.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/pnotify.custom.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.alert').delay(3000).slideUp(300);
    });
</script>
@yield('scripts')
{{-- <script src="{{asset('public/vendor/datatables/buttons.server-side.js')}}"></script> --}}
</body>

</html>
