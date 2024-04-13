@extends('frontend.layouts.empty')

@section('page_title', 'Home ')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title" data-aos="fade">

            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="current">Registration</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <div class="container" data-aos="shake" data-aos-delay="60">

                <div class="row gy-4">

                    <div class="card shadow gy-4" data-aos="fade-up" data-aos-delay="50">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <form enctype="multipart/form-data" method="post" action="{{ route('learners.register') }}"
                                    class="php-email-form" data-aos="fade-up" data-aos-delay="200">

                                    <div class="row gy-4 mt-3">

                                        <div class="form-group row">
                                            <label for="firstname" class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('First Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="firstname" type="text"
                                                    class="form-control @error('firstname') is-invalid @enderror"
                                                    name="firstname" value="{{ old('firstname') }}" required
                                                    autocomplete="firstname" autofocus>

                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="middlename" class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('Middle Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="middlename" type="text"
                                                    class="form-control @error('middlename') is-invalid @enderror"
                                                    name="middlename" value="{{ old('middlename') }}"
                                                    placeholder="Middle Name" required autocomplete="middlename" autofocus>

                                                @error('middlename')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="current_session"
                                                class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('Last Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="lastname" type="text"
                                                    class="form-control @error('lastname') is-invalid @enderror"
                                                    name="lastname" value="{{ old('lastname') }}" required
                                                    autocomplete="lastname" autofocus>

                                                @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="current_session"
                                                class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('User Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="username" type="text"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    name="username" value="{{ old('username') }}" required
                                                    autocomplete="username" autofocus>

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row mt-3">
                                            <label for="email" class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('Email') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="password" class="col-lg-2 col-form-label ">
                                                {{ __('Password') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">

                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required >
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mt-3">
                                            <label for="email" class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('Confirm password') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required >
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <div class="loading">Loading</div>
                                            <div class="error-message"></div>
                                            <div class="sent-message">Your message has been sent. Thank you!</div>

                                            <button type="submit">Register</button>
                                        </div>

                                    </div>
                                </form>
                            </div><!-- End Contact Form -->
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
@endsection
