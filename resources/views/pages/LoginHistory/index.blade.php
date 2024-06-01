@extends('layouts.app')
@section('page_title', 'Login Histpory')

@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="row ml-2">
                            <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                            <h4>Login History</h4>
                        </div>
                    </div>
                    <div class="ibox-content">
                        @include('pages.LoginHistory.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {!! Common::renderDataTable() !!}
    @endpush
@endsection
