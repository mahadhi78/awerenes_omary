@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('page_title', 'Home ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h4>Send Reports</h4>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" id="type_report_id_validate">
                                <!--begin::Label-->
                                <label for="type_report_id">
                                    <span>Type<i class="text-danger">*</i></span>
                                </label>
                                <select name="type_report_id" id="type_report_id" class="form-control">
                                    @foreach ($type as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group" id="description_validate">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" minlength="30" maxlength="300"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox-footer">
                    <a href="javascript:history.back()" class="btn btn-default">Back</a>

                    <button style="color:white !important;" type="submit" onclick="saveLesson()"
                        class="btn btn-primary btnSave pull-right">
                        <span style="color:white !important;" class="indicator-label">Save</span>
                        <span style="color:white !important;" class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/restrict/jquery-key-restrictions.min.js') }}"></script>
        <script type="text/javascript" language="javascript" class="init">
            $(".indicator-progress").toggle(false);

            $('#description').summernote({
                height: 150 // Set the desired height in pixels
            });

            $('#type_report_id').chosen({
                width: "100%"
            });

            function saveLesson() {
                $(".btnSave").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();

                var formData = new FormData()
                formData.append('type_report_id', $("#type_report_id").val().trim());
                formData.append('description', $("#description").val().trim());


                var formActionUrl = "{{ route('report.save') }}";
                saveFormData(formActionUrl, formData);
            }

            removeError();
        </script>
    @endpush

@endsection
