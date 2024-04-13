@extends('layouts.app')
@section('page_title', 'System Role')

@section('content')
    @if (Gate::check('roles-list') || Gate::check('roles-save') || Gate::check('roles-edit') || Gate::check('roles-delete'))
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <div class="row ml-2">
                                <a href="javascript:history.back()"
                                    class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                                <h4>Roles Management</h4>
                                &nbsp;&nbsp;
                                <div class="pull-right">
                                    @can('roles-save')
                                        <div class="float-right">
                                            <a class="btn btn-primary" href="{{ route('roles.save') }}">
                                                <i class="fa fa-plus"></i>
                                                <b> Add New</b>
                                            </a>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @include('pages.user_management.roles.table')

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
        <script type="text/javascript" language="javascript" class="init">
            $(".indicator-progress").toggle(false);

            function confirmDelete(id) {
                var formData = new FormData()
                formData.append('id', id);
                var url = "{{ route('roles.destroy') }}";
                deleteData(formData, url);
            }
        </script>
        {!! Common::renderDataTable() !!}
    @endpush
@endsection
