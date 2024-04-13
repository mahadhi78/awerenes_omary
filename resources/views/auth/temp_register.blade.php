<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (Common::getSystemTitle())
        <title>@yield('title') | {{ Common::getSystemTitle() }}</title>
    @else
        <title>@yield('title') | {{ config('app.name') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="top-navigation pace-done">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-reorder"></i>
                    </button>

                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="active text-capitalize">
                                <a aria-expanded="false" role="button" href="#">
                                    @if (Common::getSystemTitle())
                                        {{ Common::getSystemTitle() }}
                                    @else
                                        {{ config('app.name') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            
                            <li>
                                <a href="{{ route('register')}}">
                                    <i class="fa fa-download"></i> Register
                                </a>
                                
                            </li>
                            <li>
                                <a href="{{ route('login')}}">
                                    <i class="fa fa-download"></i> Login
                                </a>
                                
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="container">
                    <div class="col-lg-12">
                        @yield('content')


                    </div>

                </div>
            </div>
        </div>
    </div>
</body>


</html>
