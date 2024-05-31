@extends('layouts.empty')
@section('page_title', 'Home ')

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-content forum-container">

                    <div class="forum-title">
                        <h3>General subjects</h3>
                    </div>
                    @foreach ($news as $new)
                        <div class="forum-item ">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="forum-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <a href="forum_post.html" class="forum-item-title">{{ $new->new_name }}</a>
                                    <div class="forum-sub-title">
                                        {!! $new->description !!}.</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="row col">
                        <h5></h5>
                    </div>
                    <div class="row col">
                        <span>Course Studed</span>
                    </div>

                </div>
            </div>

            {{-- new course top 5 --}}
            <div class="card mt-1">
                <div class="card-body">
                    <div class="row col">
                        <h4>
                            <strong>New Course </strong>
                        </h4>
                    </div>
                    @foreach ($topCourse as $top)
                        <div class=" mt-1">
                            <a href="">
                                <img src="{{ asset($top->c_logo) }}" width="40px" height="40px" alt="School Logo">

                                <span class="mt-2 ml-2">{{ $top->c_name }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- course studies by learners --}}
            <div class="card mt-1">
                <div class="card-body">
                    <div class="row col">
                        <h5>
                            <strong> Level</strong>
                        </h5>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-danger"
                            role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        <script src="{{ asset('assets/js/plugins/pace/pace.min.js') }}"></script>
    @endpush
@endsection
