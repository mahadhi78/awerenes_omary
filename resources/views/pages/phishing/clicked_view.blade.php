@extends('auth.auth_master')

@section('page_title', $contents['temp_name'])
@section('content')
    <div class="ibox-content shadow">
        <center>
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        </center>
        <div class="row">
            <center>
                <div class="col-lg-12">

                    <div class="row col text-capitalize">
                        {{ $contents['temp_name'] }}
                    </div>
                    <div class="row col">
                        {!! $contents['info'] !!}
                    </div>
                </div>
            </center>
        </div>
    </div>
@endsection
