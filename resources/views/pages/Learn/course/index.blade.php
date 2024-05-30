@extends('layouts.empty')
@section('page_title', 'Home ')

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <div class="row ml-2">
                        <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>&nbsp;&nbsp;
                        <h4>Course List</h4>
                        &nbsp;&nbsp;
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($course as $list)
                                <div class="file-box">
                                    <div class="file">
                                        <a href="{{ route('course.preview', Common::hash($list->id)) }}">
                                            <span class="corner"></span>

                                            <div class="icon">
                                                @if ($logo = $list->c_logo)
                                                    <img src="{{ asset($list->c_logo) }}" width="100%" height="120%"
                                                        alt="School Logo">
                                                @endif
                                            </div>
                                            <div class="file-name">
                                                <a class="file-name"
                                                    href="{{ route('course.preview', Common::hash($list->id)) }}">
                                                    {{ $list->c_name }}
                                                </a>
                                            </div>
                                        </a>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
