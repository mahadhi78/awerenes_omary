@extends('auth.temp_register')
@section('page_title', 'Register ')

@section('content')
    <div class="ibox ">
        <div class="ibox-title">
            <div class="row ml-2">

                <h4>Member Registration</h4>
            </div>
        </div>
        <div class="ibox-content">
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold">
                            {{ __('First Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input id="firstName" type="text"
                                class="form-control @error('firstName') is-invalid @enderror" name="firstName"
                                value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold">
                            {{ __('Last Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input id="lastName" type="text"
                                class="form-control @error('lastName') is-invalid @enderror" name="lastName"
                                value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>

                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold">
                            {{ __('User Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">

                            <input id="userName" type="text"
                                class="form-control @error('userName') is-invalid @enderror" name="userName"
                                value="{{ old('userName') }}" required autocomplete="userName" autofocus>

                            @error('userName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold">
                            {{ __('Email ') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold">
                            {{ __('Password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="current_session" class="col-lg-2 col-form-label font-weight-semibold">
                            {{ __('Confirm Password') }}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">

                        </div>
                    </div>



                    <hr class="divider">

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right ">
                            <i class="fa fa-send"> Submit </i>

                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
@endsection
