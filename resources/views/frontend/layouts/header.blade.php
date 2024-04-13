<div class="container-fluid container-xl position-relative d-flex align-items-center ms-auto">

    <a href="{{ route('frontend.home') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <h1>
            @if (Common::getSystemTitle())
                {{ Common::getSystemTitle() }}
            @else
                {{ config('app.name') }}
            @endif
        </h1>
    </a>

    <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a href="{{ route('frontend.home') }}" class="{{ Request::is('frontend.home') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('frontend.about') }}" class="{{ Request::is('frontend.about') ? 'active' : '' }}">About</a>
            </li>
            <li>
                <a href="{{ route('frontend.courses') }}" class="{{ Request::is('frontend.courses') ? 'active' : '' }}">Courses</a>
            </li>
            <li>
                <a href="{{ route('frontend.contact') }}"
                    class="{{ Request::is('frontend.contact') ? 'active' : '' }}">Contact</a>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
    <a class="btn-getstarted" href="{{ route('register') }}">Register</a>

</div>
