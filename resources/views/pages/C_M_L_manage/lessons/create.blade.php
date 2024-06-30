@extends('layouts.app')

@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('page_title', 'Create Lesson')

@section('content')
    @if (Gate::any(['lesson-edit', 'lesson-save']))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4> Create Lesson</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.C_M_L_manage.lessons.create_data')

                        </div>
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

                $('#level_id,#course_id,#module_id').chosen({
                    width: "100%"
                });

                function getCourse(level_id) {
                    var formData = new FormData()
                    formData.append('level_id', level_id);
                    var url = "{{ route('get_course.list') }}";
                    makeAjaxRequest(url, formData, getCourseList)
                }

                function getCourseList(data) {
                    var option = ['<option value="">Select Here</option>'];
                    data.forEach(d => {
                        option.push('<option value=' + d.id + '>' + d.c_name + '</option>');
                    });
                    $("#course_id").html(option.join('')).trigger('chosen:updated');
                }

                function getModules(course_id) {
                    var formData = new FormData()
                    formData.append('course_id', course_id);
                    var url = "{{ route('get_module.list') }}";
                    makeAjaxRequest(url, formData, getModulesList)
                }

                function getModulesList(data) {
                    var option = ['<option value="">Select Here</option>'];
                    data.forEach(d => {
                        option.push('<option value=' + d.id + '>' + d.m_name + '</option>');
                    });
                    $("#module_id").html(option.join('')).trigger('chosen:updated');
                }

                @if ($lesson)
                    function updateLesson() {
                        lessonData(true);
                    }
                @else
                    function saveLesson() {
                        lessonData(false);
                    }
                @endif
                function lessonData(isUpdate) {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();
                    var lesson_name = $("#lesson_name").val().trim();
                    var description = $("#description").val().trim();

                    var data = {
                        lesson_name: lesson_name,
                        description: description
                    };

                    // Convert data to JSON string and create a Blob
                    var json = JSON.stringify(data);
                    var blob = new Blob([json], {
                        type: 'application/json'
                    });
                    var formData = new FormData()
                    formData.append('lesson_name', $("#lesson_name").val().trim());
                    formData.append('level_id', $("#level_id").val().trim());
                    formData.append('course_id', $("#course_id").val().trim());
                    formData.append('module_id', $("#module_id").val().trim());
                    formData.append('file', blob, 'data.json');


                    if (isUpdate) {
                        formData.append('id', {!! isset($lesson) ? json_encode($lesson->id) : 'null' !!});

                        saveFormData("{{ route('lesson.update') }}", formData);
                    } else {
                        var formActionUrl = "{{ route('lesson.save') }}";
                        saveFormData(formActionUrl, formData);
                    }
                }

                removeError();
            </script>
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
