@extends('emails.layout')

@section('content')
    <div class="img">
        <img src="asserts/ngao.png" alt="">
    </div>
    <div class="container flex">
        <div class="row justify-content-center ">
            <div class="col-md-4">
                <div class="card mt-4 shadow">

                    <div class="card-body">
                        <div class="container">
                            <h4> <strong>Hello ! {{ $name }} </strong> </h4>
                            <br>
                            You have been Approved to use your Account for the
                            @if (Common::getSystemName() != null)
                                <span class="text-primary" style="font-family: Roboto-Bold,sans-serif !important;">
                                    {{ Common::getSystemName() }}
                                </span>
                            @else
                                <span class="text-primary" style="font-family: Roboto-Bold,sans-serif !important;">
                                    {{ config('app.name') }}</span>
                            @endif
                            use the email and password <b style="color: blue">{{ $password }}</b> to login in the system
                            <br>
                            <span>Thanks ...... </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
