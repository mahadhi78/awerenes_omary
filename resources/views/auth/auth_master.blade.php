<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (Common::getSystemTitle())
        <title>@yield('page_title') | {{ Common::getSystemTitle() }}</title>
    @else
        <title>@yield('page_title') | {{ config('app.name') }}</title>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="passwordBox animated ">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                @yield('content')

                <div class="text-inverse-success mt-4" style="text-align: center">
                    <span class="fw-bold me-1">Copyright &copy; <?php echo date('Y'); ?>
                        @if (Common::getSystemTitle())
                            {{ Common::getSystemTitle() }}
                        @else
                            {{ config('app.name') }}
                        @endif ...
                    </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
