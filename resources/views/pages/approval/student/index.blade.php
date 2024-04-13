@extends('layouts.app')
@section('links')
    <link href="{{ asset('assets/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
@endsection
@section('page_title', 'Student Approval')
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
                                <h4>Student Registration Approval</h4>
                                &nbsp;&nbsp;
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.approval.student.table')
                            @include('pages.approval.student.edit')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
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
                $('#level_id,#school_id,#class_id').chosen({
                    width: "100%"
                });

                removeError();
                var studentId = null;

                function approvaStudent(id) {
                    var formData = new FormData()
                    formData.append('id', id);
                    var url = "{{ route('student_approval.getstudent') }}";
                    ApproveDataWithModel(formData, url, getApprovedData);
                }

                function getSchools() {
                    var level_id = document.getElementById("level_id").value;
                    var formData = new FormData()
                    formData.append('level_id', level_id);
                    var url = "{{ route('class_getSchools.list') }}";
                    makeAjaxRequest(url, formData, getSchoolsListCreate)
                }

                function getSchoolsListCreate(data) {
                    var option = ['<option value="">Select Here</option>'];
                    data.forEach(d => {
                        option.push('<option value=' + d.id + '>' + d.sc_name + '</option>');
                    });
                    $("#school_id").html(option.join('')).trigger('chosen:updated');
                }

                function getClass() {
                    var school_id = document.getElementById("school_id").value;
                    var formData = new FormData()
                    formData.append('school_id', school_id);
                    var url = "{{ route('class_getClass.list') }}";
                    makeAjaxRequest(url, formData, getClassListCreate)
                }

                function getClassListCreate(data) {
                    var option = ['<option value="">Select Here</option>'];
                    data.forEach(d => {
                        option.push('<option value=' + d.id + '>' + d.name + '</option>');
                    });
                    $("#class_id").html(option.join('')).trigger('chosen:updated');
                }

                function getApprovedData(data) {
                    $('#fullname').val(data[0].first_name + ' ' + data[0].middle_name + ' ' + data[0].lastname);
                    studentId = data[0].id
                    $('#editModal').modal('show');
                }

                function AddApproveStudent() {
                    var school_id = $("#school_id").val();
                    var class_id = $("#class_id").val();
                    var status = $("#edit_status").val();

                    var formData = new FormData()
                    formData.append('school_id', school_id);
                    formData.append('class_id', class_id);
                    formData.append('status', status);

                    formData.append('id', studentId);

                    var formActionUrl = "{{ route('student_promote.save') }}";
                    UpdateData(formActionUrl, formData);
                }
            </script>
            {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
