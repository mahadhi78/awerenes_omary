@extends('layouts.app')
@section('page_title', 'Modules')

@section('content')
    @if (Gate::any(['module-list', 'module-edit', 'module-save']))

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>Course Modules</h4>
                                @can('module-save')
                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                        data-target="#myModal">
                                        <i class="fa fa-plus"></i>
                                        Add Moudles</a>
                                    </button>
                                    @include('pages.C_M_L_manage.module.create')
                                @endcan
                            </div>

                        </div>
                        <div class="ibox-content">
                            @include('pages.C_M_L_manage.module.table')
                            @can('module-edit')
                                @include('pages.C_M_L_manage.module.edit')
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#level_id,#edit_level_id,#course_id').chosen({
                    width: "100%"
                });

                removeError();

                function saveData() {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var formData = new FormData()
                    formData.append('m_name', $("#m_name").val().trim());
                    formData.append('level_id', $("#level_id").val().trim());
                    formData.append('course_id', $("#course_id").val().trim());
                    

                    var formActionUrl = "{{ route('module.save') }}";
                    saveFormData(formActionUrl, formData);
                }


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
            </script>
            {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
