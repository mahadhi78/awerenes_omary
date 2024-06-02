@extends('layouts.app')
@section('page_title', 'Home ')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h4>{{ $course }}</h4>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                    </div>
                </div>
                <div class="ibox-content">
                    <div id="external-events">
                        @foreach ($modules as $module)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-1">
                                            <input type="radio" name="module_id" id="module_id" class="form-control mt-2"
                                                value="{{ $module->id }}" style="height:50%">
                                        </div>
                                        <div class="col-md-8">
                                            <h3>
                                                <a href="{{ route('module.preview', Common::hash($module->id)) }}"
                                                    class="text text-primary">
                                                    {{ $module->m_name }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
