@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Staffs Approval')
@section('content')
    @if (Gate::check('staffs_approval-list') || Gate::check('staffs_approval-edit'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                    <h4>Staff Registration Approval</h4>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.approval.users.table')
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

                function approvaStaff(id) {
                    var formData = new FormData()
                    formData.append('id', id);
                    var url = "{{ route('staffs_approval.edit') }}";
                    ApproveData(formData, url);
                }
            </script>
             {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
