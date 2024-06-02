@extends('layouts.app')
@section('page_title', 'Course')

@section('content')
    @if (Gate::any(['course-list', 'course-edit', 'course-save']))

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>Course Management</h4>
                                @can('course-save')
                                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                        data-target="#myModal">
                                        <i class="fa fa-plus"></i>
                                        Add Course</a>
                                    </button>
                                    @include('pages.C_M_L_manage.course.create')
                                @endcan
                            </div>

                        </div>
                        <div class="ibox-content">
                            @include('pages.C_M_L_manage.course.table')
                            @can('course-edit')
                                @include('pages.C_M_L_manage.course.edit')
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

                $('#level_id,#edit_level_id,#edit_status,#school_id,#edit_school_id').chosen({
                    width: "100%"
                });

                removeError();

                function saveData() {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var c_logo = document.getElementById("c_logo").value;
                    var formData = new FormData()
                    formData.append('c_name', $("#c_name").val().trim());
                    formData.append('level_id', $("#level_id").val().trim());
                    if (c_logo != '' && c_logo != null) {
                        formData.append('c_logo', $("#c_logo")[0].files[0]);
                    }

                    var formActionUrl = "{{ route('course.save') }}";
                    saveFormData(formActionUrl, formData);
                }
                var courseId = null;

                function editClass(id) {
                    var url = "{{ route('course.edit', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            $('#edit_c_name').val(response.c_name);
                            $('#edit_level_id').val(response.level_id);
                            courseId = id
                            $('#edit_level_id').trigger('chosen:updated');
                            $('#editModal').modal('show');
                        }
                    });
                }

                function UpdateClass() {
                    var EditLogo = document.getElementById("edit_c_logo").value;
                    var formData = new FormData()
                    formData.append('c_name', $("#edit_c_name").val().trim());
                    formData.append('level_id', $("#edit_level_id").val().trim());
                    if (EditLogo != '' && EditLogo != null) {
                        formData.append('c_logo', $("#edit_c_logo")[0].files[0]);
                    }

                    formData.append('id', courseId);
                    var formActionUrl = "{{ route('course.update') }}";
                    UpdateData(formActionUrl, formData);
                }

                function deleteClass(id) {
                    var formData = new FormData()
                    formData.append('id', id);
                    var url = "{{ route('course.destroy') }}";
                    deleteData(formData, url);
                }
            </script>
            {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
