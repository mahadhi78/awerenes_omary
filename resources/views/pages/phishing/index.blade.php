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
                                    @can('template-list')
                                        <li class="nav-item">
                                            <a href="#new-section3" class="nav-link" data-toggle="tab">
                                                Templates List
                                            </a>
                                        </li>
                                    @endcan
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

            $(document).ready(function() {
                new Clipboard('.btn-copy');
            });
            $('#info').summernote({
                height: 150
            });

            $('#ttr_id,#ts_id,#subject_id,#day').chosen({
                width: "100%"
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
        </script>
        {!! Common::renderDataTable() !!}
        {!! Common::renderDataTable2() !!}
    @endpush
@endsection
