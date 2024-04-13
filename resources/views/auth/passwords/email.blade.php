@extends('auth.auth_master')
@section('content')
    <div class="ibox-content shadow">
        <center>
            @if ($systemLogo = Common::getSystemLogo())
                <img src="{{ asset($systemLogo) }}" width="150px" alt="School Logo">
            @else
                <img src="{{ asset('images/SchoolLog.jpg') }}" width="150px" alt="School Logo">
            @endif
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
                <form method="POST" action="{{ route('password.resets-email') }}" class="form w-100"
                    novalidate="novalidate" id="kt_sign_in_form">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    
                    <div class="form-group mt-2">
                        <label class="form-label fs-6 fw-bolder text-dark"><b>{{ __('E-Mail Address :') }}</b></label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Enter Email Address">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
