@extends('layouts.app')
@section('page_title', 'Levels')

@section('content')
    {{-- @if (Gate::any(['levels-list', 'levels-edit'])) --}}
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="row ml-2">
                            <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                            <h4>Feeddback</h4>

                        </div>
                    </div>
                    <div class="ibox-content">
                        @include('pages.reports.feedback.table')
                        @include('pages.reports.feedback.edit')
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


            var classId = null;

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
        </script>
        {!! Common::renderDataTable() !!}
    @endpush
    {{-- @else
        @component('errors.unauthorized')
        @endcomponent
    @endif --}}
@endsection
