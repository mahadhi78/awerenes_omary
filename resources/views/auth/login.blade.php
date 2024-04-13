@extends('auth.auth_master')
@section('page_title', 'Login ')

@section('content')
    <div class="ibox-content shadow">
        <center>
            <img src="@if ($systemLogo = Common::getSystemLogo()) {{ asset($systemLogo) }}@else {{ asset('images/SchoolLog.jpg') }} @endif"
                width="100px" height="90px" class="img-rounded" alt="School Logo">
            <h4 class="mt-3">
                @if (Common::getSystemTitle())
                    {{ Common::getSystemTitle() }}
                @else
                    {{ config('app.name') }}
                @endif
            </h4>
            <hr>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate"
                    id="kt_sign_in_form">
                    @csrf
                    @if (Session::has('message'))
                        <div class="alert alert-{{ Session::get('status') }}" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                            name="email" id="email" required autofocus autocomplete="off" />
                        @error('email')
                            <span class="invalid-feedback">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex flex-stack mb-2">
                            <label for="password">Password</label>
                        </div>
                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                            name="password" id="password" autocomplete="off" required />
                        @error('password')
                            <span class="invalid-feedback">
                                <p>{{ $message }}</p>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" id="loginBtn" class="btn btn-lg btn-primary w-100 mb-3">
                            <span class="indicator-label">Sign In</span>

                        </button>
                        <a href="{{ route('password.request') }}" class="link-primary fs-2  ">Forgot Password
                            ?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
