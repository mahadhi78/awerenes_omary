@extends('auth.master')

@section('content')

    <div class="d-flex flex-column flex-lg-row-fluid py-10">
                    <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed">
                <!--begin::Content-->
                <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
                       <center>
                        <a href="#" class="mb-12">
                        <img src="{{ asset('media/images/ngao.png') }}" alt="Tanzania Logo" ></a>
                           <h3 class="text-dark mb-3" style="font-family: Roboto-Bold,sans-serif !important;">The Ministry of Finance and Planning</h3>
                         <h5 class="text-dark mb-3" style="font-family: Roboto-Bold,sans-serif !important;">Hazina Yetu Portal</h5>
                         </center>
                             <h2>Account Activation Request</h2>
                            <p>Dear : <b>{{ $firstname }} {{ $lastname }} </b><br>
                        Welcome to the {{ config('app.name') }}<br>
                        You have been successfully registered to the Portal,In order to activate your Account, click the link below, (If you’re having trouble clicking then copy the link and paste to the URL of your browser):
                        </p>
                        Account Activation password Link: {{ url('password/reset', $token).'?email='.urlencode($email) }}
                            </p>
                            <br>
                            by  {{ config('app.name') }} Administrator

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Authentication - Sign-in-->
    </div>

@endsection