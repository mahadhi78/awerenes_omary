@extends('layouts.app')
@section('page_title', 'Faqs')
@section('links')
    <link href="{{ asset('assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @if (Gate::any(['faqs-list', 'faqs-edit']))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
                                <h4>Faqs Management</h4>
                                @can('faqs-save')
                                    <a href="{{ route('faqs.create') }}" class="btn btn-primary pull-right">
                                        <i class="fa fa-plus"></i>
                                        Add Faqs</a>
                                    </a>
                                @endcan
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                @include('pages.C_M_L_manage.faq.table')
                            </div>
                            @include('pages.C_M_L_manage.faq.edit')
                            @include('pages.C_M_L_manage.faq.preview')
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

                removeError();
                function previewInfo(id) {
                    var url = "{{ route('faqs.preview', ':id') }}";
                    url = url.replace(':id', id);
                    $.ajax({
                        type: 'GET',
                        url: url,
                        success: function(response) {
                            document.getElementById('previewModalBody').innerHTML = response.description;
                            document.getElementById('title').innerHTML = response.name;
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
