@extends('layouts.app')
@section('page_title', 'Feedback')

@section('content')
    @if (Gate::any(['report-list', 'report-delete']) || Auth::user()->userType == Constants::LEARNER)
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>{{ Auth::user()->userType == Constants::LEARNER ? 'My Reports' : 'Feedback' }}</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.reports.feedback.table')
                            @include('pages.reports.feedback.preview')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/forms/js/form_sweetAlert.js') }}"></script>
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>

            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#level_id').chosen({
                    width: "100%"
                });

                removeError();


                function previewDocument(id) {
                    var url = "{{ route('report_edit.list', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            console.log(response);
                            document.getElementById('previewModalBody').innerHTML = response.description;
                            $("#documentModal").modal("show");;
                        }
                    });
                }
                var feedbackId = null;

                function editFeedback(id) {
                    var url = "{{ route('type.edit', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            $('#edit_name').val(response.name);
                            $('#edit_status').val(response.status);
                            feedbackId = id
                            $('#edit_status').trigger('chosen:updated');
                            $('#editModal').modal('show');
                        }
                    });
                }

                function UpdateFeedback() {
                    var formData = new FormData()
                    formData.append('name', $("#edit_name").val().trim());
                    formData.append('status', $("#edit_status").val().trim());

                    formData.append('id', feedbackId);
                    var formActionUrl = "{{ route('type.update') }}";
                    UpdateData(formActionUrl, formData);
                }

                function deleteFeedback(id) {
                    var formData = new FormData()
                    formData.append('id', id);
                    var url = "{{ route('report.destroy') }}";
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
