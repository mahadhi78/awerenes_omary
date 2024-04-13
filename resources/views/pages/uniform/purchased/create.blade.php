@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Uniform Published')

@section('content')
    @if (Gate::check('uniforms_published-save'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Add Purchased Unifroms</h5>
                        </div>
                        <div class="ibox-content">
                            @include('pages.uniform.purchased.field')
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

        <script src="{{ asset('system/js/addForm.js') }}"></script>
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
                var school_id = $("#school_id").val();
                
                var formData = new FormData()
                formData.append('uniform_category_id', uniform_category_id.trim());
                formData.append('qty', qty.trim());
                formData.append('pub_date', pub_date.trim());
                formData.append('school_id', school_id.trim());

                var formActionUrl = "{{ route('uniforms_published.save') }}";
                saveFormData(formActionUrl, formData);

            }
        </script>
    @endpush
@endsection
