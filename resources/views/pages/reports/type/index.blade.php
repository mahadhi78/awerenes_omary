@extends('layouts.app')
@section('page_title', 'Report Type')

@section('content')
    {{-- @if (Gate::any(['levels-list', 'levels-edit'])) --}}
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="row ml-2">
                            <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                            <h4>Type</h4>
                            @can('levels-save')
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
                                    data-target="#myModal">
                                    <i class="fa fa-plus"></i>
                                    Add Type</a>
                                </button>
                                @include('pages.reports.type.create')
                            @endcan
                        </div>
                    </div>
                    <div class="ibox-content">
                        @include('pages.reports.type.table')
                        @include('pages.reports.type.edit')
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

            $('#level_id,#status').chosen({
                width: "100%"
            });

            removeError();

            function saveData() {
                $(".btnSave").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();

                var formData = new FormData()
                formData.append('name', $("#name").val().trim());
                formData.append('status', $("#status").val().trim());

                var formActionUrl = "{{ route('type.save') }}";
                saveFormData(formActionUrl, formData);
            }
            var typeId = null;

            function editType(id) {
                var url = "{{ route('type.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        $('#edit_name').val(response.name);
                        $('#edit_status').val(response.status);
                        typeId = id
                        $('#edit_status').trigger('chosen:updated');
                        $('#editModal').modal('show');
                    }
                });
            }

            function UpdateType() {
                var formData = new FormData()
                formData.append('name', $("#edit_name").val().trim());
                formData.append('status', $("#edit_status").val().trim());

                formData.append('id', typeId);
                var formActionUrl = "{{ route('type.update') }}";
                UpdateData(formActionUrl, formData);
            }

            function deleteType(id) {
                var formData = new FormData()
                formData.append('id', id);
                var url = "{{ route('type.destroy') }}";
                deleteData(formData, url);
            }
        </script>
        {!! Common::renderDataTable() !!}
    @endpush
    {{-- @else
        @component('errors.unauthorized')
        @endcomponent
    @endif --}}
@endsection
