<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description">
    <meta name="keywords" content="School Management System">
    <meta name="msapplication-TileColor" content="#ffffff">
    @if ($systemLogo = Common::getSystemLogo())
        <link rel = "icon" href ="{{ asset('storage/' . $systemLogo) }}" type = "image/x-icon">
    @else
        <link rel = "icon" href ="{{ asset('images/SchoolLog.jpg') }}" type = "image/x-icon">
    @endif

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
    <!---chosen select --->
    <link href="{{ asset('assets/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">
    @yield('links')

</head>

<body>

    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu" style="">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <img src="@if (!empty(Auth::user()->school_id)) {{ asset(Common::getSchoolLogo()) }}  @elseif(empty(Auth::user()->school_id )){{ asset(Common::getSystemLogo()) }}@else{{ asset('images/SchoolLog.jpg') }} @endif"
                                class="profile-image  img-circle align-items-center ml-3" width="80px" height="95px" alt="School Logo">
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
            <div class="wrapper wrapper-content">
                @yield('content')
            </div>
            <div class="footer">
                <div class="float-right">
                    <strong></strong>
                </div>
                <div>
                    <strong>Copyright </strong>
                    @if (Common::getSystemName())
                        {{ Common::getSystemName() }}
                    @else
                        {{ config('app.name') }}
                    @endif &copy; <?php echo date('Y'); ?>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.partials.script')
    @include('layouts.partials.alert')
</body>

</html>
