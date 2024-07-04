@extends('layouts.app')
@section('page_title', 'Edit News')
@section('links')
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @if (Gate::any(['news-list', 'news-edit']))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>Edit News</h4>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.reports.news.create')
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
                    height: 300
                });
                removeError();

                function updateData() {
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

                    var news_data = @json($news_data);
                    var newsId = news_data.id !== undefined ? news_data.id : null;
                    formData.append('id', newsId);
                    var formActionUrl = "{{ route('news.update') }}";
                    saveFormData(formActionUrl, formData);
                }
            </script>
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
