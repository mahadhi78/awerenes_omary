<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description">
    <meta name="keywords" content="School Management System">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/SchoolLog.jpg') }}">
    <meta name="theme-color" content="#eb8823">
    <meta name="apple-mobile-web-app-status-bar-style" content="#eb8823">

    @if (Common::getSystemTitle())
        <title>@yield('page_title') | {{ Common::getSystemTitle() }}</title>
    @else
        <title>@yield('page_title') | {{ config('app.name') }}</title>
    @endif

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/select2/select2.min.css') }}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            @if ($systemLogo = Common::getSystemLogo())
                                <img src="{{ asset($systemLogo) }}" class="rounded-circle" width="120px"
                                    alt="School Logo">
                            @else
                                <img src="{{ asset('images/SchoolLog.jpg') }}" class="rounded-circle" width="120px"
                                    alt="School Logo">
                            @endif
                            <div class="text-white">
                                {{ config('app.name') }}
                            </div>
                        </div>
                    </li>
                    @include('layouts.partials.sidebar')

                </ul>


            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                @include('layouts.partials.header')

            </div>
            <div class="row wrapper border-bottom white-bg ">
                <div class="col-lg-12">
                    {{-- <div class="row">
                        <div class="col">
                            <h2>Calendar</h2>

                        </div>
                        <div class="col flex mt-4">
                            <div class="float-right d-flex">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Extra pages
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <strong>Calendar</strong>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="wrapper wrapper-content">
                @yield('content')

            </div>
            <div class="footer">
                <div class="float-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2018
                </div>
            </div>

        </div>
    </div>

    <!-- Mainly scripts -->

    <script src="{{ asset('assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('assets/js/inspinia.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>

</body>

</html>
