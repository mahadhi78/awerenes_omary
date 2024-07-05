@extends('layouts.app')
@section('page_title', 'Phishing Compaign')
@section('links')
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @if (Gate::any(['compaign-list', 'compaign-edit', 'compaign-save', 'compaign-delete', 'phishing-save']))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                <h4>Phishing</h4>
                                &nbsp;&nbsp;
                                @can('compaign-save')
                                    <a type="button" class="btn btn-primary pull-right" href="{{ route('phishing.create') }}">
                                        <i class="fa fa-send"></i>
                                        Send Phishing
                                    </a>
                                @endcan
                            </div>
                        </div>

                        <div class="ibox-content">
                            <div class="card-body ibox">
                                <ul class="nav nav-tabs nav-tabs-white">
                                    <li class="nav-item">
                                        <a href="#new-section" class="nav-link active " data-toggle="tab">
                                            Compaign List
                                        </a>
                                    </li>

                                    @can('compaign-save')
                                        <li class="nav-item">
                                            <a href="#new-section2" class="nav-link" data-toggle="tab">
                                                <i class="fa fa-plus"></i>
                                                Create Compaign
                                            </a>
                                        </li>
                                    @endcan
                                    @canany(['template-save', 'template-edit', 'template-destroy'])
                                        <li class="nav-item">
                                            <a href="#new-section3" class="nav-link" data-toggle="tab">
                                                Templates List
                                            </a>
                                        </li>
                                    @endcanany

                                    @can('template-save')
                                        <li class="nav-item">
                                            <a href="#new-section4" class="nav-link" data-toggle="tab">
                                                <i class="fa fa-plus"></i>
                                                Add Templates
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show  active " id="new-section">
                                        <div class="col-lg-12">
                                            @include('pages.phishing.compaign.table')
                                            @include('pages.phishing.compaign.edit')
                                        </div>
                                    </div>

                                    <div class="tab-pane show" id="new-section2">
                                        <div class="col-lg-12">
                                            @include('pages.phishing.compaign.create')
                                        </div>
                                    </div>

                                    <div class="tab-pane show" id="new-section3">
                                        <div class="col-lg-12">
                                            @include('pages.phishing.templates.data')
                                        </div>
                                    </div>
                                    <div class="tab-pane show" id="new-section4">
                                        <div class="col-lg-12">
                                            @include('pages.phishing.templates.create')
                                            @include('pages.phishing.templates.preview')
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/restrict/jquery-key-restrictions.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.js') }}"></script>
        <script type="text/javascript" language="javascript" class="init">
            $(".indicator-progress").toggle(false);

            $('#info').summernote({
                height: 150
            });

            removeError();

            function saveData() {
                $(".btnSave").prop('disabled', true);
                $(".indicator-progress").toggle(true);
                $(".indicator-label").hide();

                var info = $('#info').val().trim();
                var tempName = $("#temp_name").val().trim();

                var data = {
                    temp_name: tempName,
                    info: info
                };

                // Convert data to JSON string and create a Blob
                var json = JSON.stringify(data);
                var blob = new Blob([json], {
                    type: 'application/json'
                });

                // Create FormData and append the Blob
                var formData = new FormData();
                formData.append('file', blob, 'data.json');
                formData.append('temp_name', $("#temp_name").val().trim());

                var formActionUrl = "{{ route('template.save') }}";
                saveFormData(formActionUrl, formData);
            }

            var typeId = null;

            function editCompaign(id) {
                var url = "{{ route('compaign.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(response) {
                        $('#edit_name').val(response.name);
                        $('#edit_status').val(response.status);
                        $('#edit_start_at').val(response.start_at);
                        $('#edit_end_at').val(response.end_at);
                        typeId = id
                        $('#edit_status').trigger('chosen:updated');
                        $('#editModal').modal('show');
                    }
                });
            }

            function UpdateCompaign() {
                var formData = new FormData()
                formData.append('name', $("#edit_name").val().trim());
                formData.append('status', $("#edit_status").val().trim());
                formData.append('start_at', $("#edit_start_at").val().trim());
                formData.append('end_at', $("#edit_end_at").val().trim());

                formData.append('id', typeId);
                var formActionUrl = "{{ route('compaign.update') }}";
                UpdateData(formActionUrl, formData);
            }
            function previewTemplate(id) {
            var url = "{{ route('template.preview', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(response) {
                    document.getElementById('previewModalBody').innerHTML = response.description;
                    document.getElementById('title').innerHTML = response.new_name;
                    $("#documentModal").modal("show");;
                }
            });
        }
            function deleteCompaign(id) {
                var formData = new FormData()
                formData.append('id', id);
                var url = "{{ route('compaign.destroy') }}";
                deleteData(formData, url);
            }

            function restoreCompaign(id) {
                var formData = new FormData()
                formData.append('id', id);
                var url = "{{ route('compaign.restore') }}";
                restoreData(formData, url);
            }
        </script>
        {!! Common::renderDataTable() !!}
    @endpush
@endsection
