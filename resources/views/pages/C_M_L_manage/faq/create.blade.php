@extends('layouts.app')
@section('page_title', 'Faqs')
@section('links')
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @if (Gate::any(['faqs-save', 'faqs-edit']))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>Faqs Management</h4>
                              
                            </div>
                        </div>
                        <div class="ibox-content">
                            
                            @include('pages.C_M_L_manage.faq.create_data')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="{{ asset('assets/system/js/addForm.js') }}"></script>
            <script src="{{ asset('assets/js/plugins/summernote/summernote-bs4.js') }}"></script>
            <script type="text/javascript" language="javascript" class="init">
                $(".indicator-progress").toggle(false);

                $('#description').summernote({
                    height: 150 // Set the desired height in pixels
                });

                function saveFaqs(isUpdate) {
                    $(".btnSave").prop('disabled', true);
                    $(".indicator-progress").toggle(true);
                    $(".indicator-label").hide();

                    var name = $("#name").val().trim();
                    var description = $("#description").val().trim();

                    var data = {
                        name: name,
                        description: description
                    };

                    var json = JSON.stringify(data);
                    var blob = new Blob([json], {
                        type: 'application/json'
                    });
                    var formData = new FormData()
                    formData.append('name', $("#name").val().trim());
                    formData.append('file', blob, 'data.json');

                    var formActionUrl = "{{ route('faqs.save') }}";
                    saveFormData(formActionUrl, formData);
                }

                removeError();
            </script>
            {!! Common::renderDataTable() !!}
        @endpush
    @else
        @component('errors.unauthorized')
        @endcomponent
    @endif
@endsection
