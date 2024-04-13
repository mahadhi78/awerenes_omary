@extends('auth.auth_master')
@section('content')
    <div class="ibox-content shadow">
        <center>
            @if ($systemLogo = Common::getSystemLogo())
                <img src="{{ asset($systemLogo) }}" width="120px" alt="School Logo">
            @else
                <img src="{{ asset('images/SchoolLog.jpg') }}" width="120px" alt="School Logo">
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
                <form method="POST" action="{{ route('password.resets') }}" class="form w-100" novalidate="novalidate"
                    id="kt_sign_in_form">
                    @csrf
                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label class="form-label fs-6 fw-bolder text-dark">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" readonly value="{{ $email ?? old('email') }}" required autocomplete="email"
                            autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Confirm Password') }}</label>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            function displayPasswordRules() {
                swal("Minimum Password Length should be 8 Characters, Password must have Capital, Small Letters and one of the following Special Characters($,&,@,#,*,&,(,),[,])) ", {
                    title: 'Change Password Rules'
                });
                return false;
            }

            function showPassword() {
                var password = document.getElementById("password");
                if (password.type === "password") {
                    password.type = "text";
                } else {
                    password.type = "password";
                }

                var confirmPassword = document.getElementById("password-confirm");
                if (confirmPassword.type === "password") {
                    confirmPassword.type = "text";
                } else {
                    confirmPassword.type = "password";
                }
            }
            $(document).ready(function() {
                $("[rel=tooltip]").tooltip({
                    placement: 'top'
                });
            });
        </script>
    @endpush
@endsection
