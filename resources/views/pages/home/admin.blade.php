<div class="row">
    <div class="col-lg-3">
        <div class="widget style1 bg-info">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-graduation-cap fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <a href="" class="text-white">
                        <span>Total Students</span>
                        <h2 class="font-bold">{{ $studentActive }}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 navy-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-user-plus fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <a href="{{ route('staffs.list') }}" class="text-white">
                        <span>Total Staffs</span>
                        <h2 class="font-bold">{{ $usersActive }}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="widget style1 bg-danger">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-book fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Course</span>
                    <h2 class="font-bold">{{ $courseCount }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="widget style1 yellow-bg">
            <div class="row">
                <div class="col-4">
                    <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Templates </span>
                    <h2 class="font-bold">{{ $templateCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row animated fadeInRight">
    <div class="col-lg-4">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Top Course</h5>
            </div>
            <div class="ibox-content">
                <div class="dd" id="nestable2">
                    <ol class="dd-list">
                        @foreach ($topCourse as $top)
                            <li class="dd-item dd-collapsed" data-id="1">
                                <a class='text text-primary'
                                    href="{{ route('course.preview', Common::hash($top->id)) }}">
                                    <div class="dd-handle">
                                        <span class="label label-info">
                                            <img src="{{ asset($top->c_logo) }}" width="40px" height="40px"
                                                alt="School Logo" class="img-rounded">
                                        </span>
                                        {{ $top->c_name }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-8">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>News</h5>
                <a type="button" class="btn btn-primary pull-right mb-1" href="{{ route('news.list') }}">
                    More News</a>
                </a>
            </div>
            <div class="ibox-content" id="ibox-content">

                <div id="vertical-timeline" class="vertical-container dark-timeline">
                    @foreach ($news as $new)
                        <div class="vertical-timeline-block">
                            <div class="vertical-timeline-icon navy-bg">
                                <i class="fa fa-info"></i>
                            </div>

                            <div class="vertical-timeline-content">
                                <h2>{{ $new['new_name'] }}</h2>
                                <p>
                                    {!! $new['description'] !!}
                                </p>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </div>
    </div>
</div>
