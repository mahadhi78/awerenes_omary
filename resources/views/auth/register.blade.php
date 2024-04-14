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
                                <form enctype="multipart/form-data" method="post" action="{{ route('registration.save') }}"
                                    class="php-form" data-aos="fade-up" data-aos-delay="200">
                                    @csrf
                                    <div class="row gy-4 mt-3">
                                        @if (Session::has('message'))
                                            <div class="alert alert-{{ Session::get('status') }}" role="alert">
                                                {{ Session::get('message') }}
                                            </div>
                                        @endif
                                        <div class="form-group row">
                                            <label for="firstname" class="col-lg-2 col-form-label font-weight-semibold">
                                                {{ __('First Name') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-6">
                                                <input id="firstname" type="text"
                                                    class="form-control @error('firstname') is-invalid @enderror"
                                                    name="firstname" value="{{ old('firstname') }}" autocomplete="firstname"
                                                    autofocus onkeyup="removeError(firstname)">
                                                @error('firstname')
                                                    <span id="firstname-error" class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
                                                    </span>
                                                @enderror
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
                                                    onkeyup="removeError(middlename)" placeholder="Middle Name"
                                                    autocomplete="middlename" autofocus>

                                                @error('middlename')
                                                    <span id="middlename-error" class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
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
                                                    name="lastname" value="{{ old('lastname') }}" autocomplete="lastname"
                                                    autofocus onkeyup="removeError(lastname)">
                                                @error('lastname')
                                                    <span id="lastname-error" class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
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
                                                    name="username" value="{{ old('username') }}" autocomplete="username"
                                                    autofocus onkeyup="removeError(username)">

                                                @error('username')
                                                    <span id="username-error" class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
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
                                                    value="{{ old('email') }}" autocomplete="email">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <p>{{ $message }}</p>
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
                                                    name="password">
                                                @error('password')
                                                    <div class="error-message">
                                                        <p>{{ $message }}</p>
                                                    </div>
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
                                                    name="password_confirmation">
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <div class="loading">Loading</div>

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
    @push('scripts')
        <script>
            function removeError(fieldName) {
                document.getElementById(fieldName + '-error').innerHTML = '';
            }
        </script>
    @endpush
@endsection
