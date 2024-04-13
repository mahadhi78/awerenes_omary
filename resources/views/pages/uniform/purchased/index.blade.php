@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Uniform Purchased')

@section('content')
    @if (Gate::check('uniforms_published-list') || Gate::check('uniforms_published-edit'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>

                                <h5>Uniform Published</h5>
                                @can('uniforms_published-save')
                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                        data-target="#myModal">
                                        <i class="fa fa-plus"></i>
                                        Add Published Uniforms</a>
                                    </button>
                                    {{-- @include('pages.uniform.published.create') --}}
                                @endcan
                            </div>
                        </div>
                        <div class="ibox-content">
                            {{-- @include('pages.uniform.published.table') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
    @push('scripts')
        <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

        <script src="{{ asset('assets/forms/js/form_sweetAlert.js') }}"></script>

        <script type="text/javascript" language="javascript" class="init">
            $(".indicator-progress").toggle(false);

            $('#uniform_category_id').chosen({
                width: "100%"
            });
            $('#pub_date_validate .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            function savePublishedUniform() {
                $(".btnSave").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();

                var uniform_category_id = $("#uniform_category_id").val();
                var qty = $("#qty").val();
                var pub_date = $("#pub_date").val();

                var formData = new FormData()
                formData.append('uniform_category_id', uniform_category_id.trim());
                formData.append('qty', qty.trim());
                formData.append('pub_date', pub_date.trim());

                var formActionUrl = "{{ route('uniforms_published.save') }}";
                saveFormData(formActionUrl, formData);

            }
        </script>
    @endpush
@endsection
