@extends('auth.auth_master')

@section('page_title', 'Login')
@section('content')
    <div class="ibox-content shadow">
        <center>
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        </center>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    {{ $contents['temp_name'] }}
                </div>
                <div class="row">
                    {!! $contents['info'] !!}
                </div>
            </div>
        </div>
    </div>
@endsection
