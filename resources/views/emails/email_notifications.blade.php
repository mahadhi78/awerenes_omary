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
                        <p style="">
                            @if (Common::getSystemName() != null)
                                <h5 class="text-dark mt-3" style="font-family: Roboto-Bold,sans-serif !important;">
                                    {{ Common::getSystemName() }}</h5>
                            @else
                                <h5 class="text-dark mb-3" style="font-family: Roboto-Bold,sans-serif !important;">
                                    {{ config('app.name') }}</h5>
                            @endif
                        </p>
                        <div class="container">
                          <h3>change Password Request</h3>
                          <p> <strong>Hello !</strong>
                              You have been request the changing of password to the @if (Common::getSystemName() != null)
                                  <span class="text-primary" style="font-family: Roboto-Bold,sans-serif !important;">
                                      {{ Common::getSystemName() }}</span>
                              @else
                                  <span class="text-primary" style="font-family: Roboto-Bold,sans-serif !important;">
                                      {{ config('app.name') }}</span>
                              @endif
                              <br>
                          <div class="col-md-6 text-center mt-4">
                              <a href="{{ url('password/reset', $token) . '?email=' . urlencode($email) }}"><button
                                      class="btn btn-sm btn-primary w-100 mb-5">Reset Password</button></a>
                          </div>
                          <br>
                          In order to make changes to your Account, click the link above, If you’re having trouble clicking then copy the link and paste to the
                          URL of your browser:
                          </p>
                          reset password Link: {{ url('password/reset', $token) . '?email=' . urlencode($email) }}
                          <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
