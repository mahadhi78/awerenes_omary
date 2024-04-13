@extends('layouts.app')
@section('page_title', 'Uniform Purchased')

@section('content')
    @if (Gate::check('uniforms-list') || Gate::check('uniforms-edit'))
        <div class="col-md-12 p-1  mx-auto">
            <!-- Breadcumb Section -->
            <div class="breadcumb-banner ">

                <div class="title"><i class="fa fa-users"></i> &nbsp;&nbsp;Uniform Purchased</div>

                <a href="javascript:history.back()" type="button" class="btn btn-outline-secondary rounded"><span
                        class="fa fa-arrow-circle-left"></span>
                </a>
            </div>
            <!-- End of Breadcumb Section -->
            <div class="about-page main-container bg-white rounded-medium">

                <div class="col-12 px-0 px-lg-5 pt-3">
                    <div class="row">


                        <div class="col-12">
                            <div class="row">
                                <div class="mt-2">
                                    @can('uniforms_category-create')
                                        <div class="col-md-3">
                                            <a href="#" style="color:white !important;" class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_uniform_Purchased">
                                                Add Purchased Uniform</a>
                                        </div>
                                    @endcan
                                    @include('pages.uniform.purchased.create')
                                    @include('pages.uniform.purchased.table')
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
        <script src="{{ asset('cms/js/sweetalert.min.js') }} "></script>
        <script type="text/javascript" language="javascript" class="init">
            $(".indicator-progress").toggle(false);
        </script>
    @endpush
@endsection
