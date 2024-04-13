@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Staff List')
@section('content')
    @if (Gate::check('staffs-list') || Gate::check('staffs-edit') || Gate::check('staffs-delete'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>Staff Details</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.user_management.users.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('assets/forms/js/form_sweetAlert.js') }}"></script>

            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#dob .input-group.date').datepicker({
                    startView: 2,
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    autoclose: true
                });

                $('#admision_date_validate .input-group.date').datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true
                });

                $('#level_id').chosen({
                    width: "100%"
                });

                removeError();
            </script>
             {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
