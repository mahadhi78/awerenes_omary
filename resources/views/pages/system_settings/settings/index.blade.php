@extends('layouts.app')
@section('page_title', 'Settings')

@section('content')
    @if (Gate::check('settings-list') || Gate::check('settings-edit'))

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>System Configuration</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.system_settings.settings.create')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @push('scripts')
            <script src="{{ asset('system/js/sweetalert.min.js') }} "></script>
        @endpush --}}
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
