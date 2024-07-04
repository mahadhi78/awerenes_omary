@extends('layouts.app')
@section('page_title', 'News')
@section('links')
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @if (Gate::any(['news-list', 'news-edit']) || Auth::user()->userType == Constants::LEARNER)
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>News</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <ul class="nav nav-tabs nav-tabs-white">
                                <li class="nav-item">
                                    <a href="#new-section" class="nav-link active" data-toggle="tab">
                                        News List
                                    </a>
                                </li>
                                @can('news-save')
                                    <li class="nav-item">
                                        <a href="#new-section2" class="nav-link" data-toggle="tab">
                                            <i class="fa fa-plus"></i>
                                            Create News
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show  active " id="new-section">
                                    <div class="col-lg-12">
                                        @include('pages.reports.news.table')
                                        @include('pages.reports.news.preview')
                                    </div>
                                </div>
                                @can('news-save')
                                    <div class="tab-pane show" id="new-section2">
                                        <div class="col-lg-12">
                                            @include('pages.reports.news.create')
                                        </div>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/forms/js/form_sweetAlert.js') }}"></script>
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/clipboard/clipboard.min.js') }}"></script>
            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $(document).ready(function() {
                    new Clipboard('.btn-copy');
                });
                $('#description').summernote({
                    height: 300
                });
                removeError();

                function saveData() {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var description = $('#description').val().trim();
                    var newName = $("#new_name").val().trim();

                    var data = {
                        new_name: newName,
                        description: description
                    };

                    // Convert data to JSON string and create a Blob
                    var json = JSON.stringify(data);
                    var blob = new Blob([json], {
                        type: 'application/json'
                    });

                    // Create FormData and append the Blob
                    var formData = new FormData();
                    formData.append('file', blob, 'data.json');
                    formData.append('new_name', $("#new_name").val().trim());

                    var formActionUrl = "{{ route('news.save') }}";
                    saveFormData(formActionUrl, formData);
                }

                function previewInfo(id) {
                    var url = "{{ route('news_edit.list', ':id') }}";
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

                function deleteNews(id) {
                    var formData = new FormData()
                    formData.append('id', id);
                    var url = "{{ route('news.destroy') }}";
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
