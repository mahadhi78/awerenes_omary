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
            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#description').summernote({
                    height: 150 // Set the desired height in pixels
                });
                removeError();

                function saveData() {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var formData = new FormData()
                    formData.append('new_name', $("#new_name").val().trim());
                    formData.append('description', $("#description").val().trim());

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
            </script>

            {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
