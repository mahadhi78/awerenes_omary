<div class="row animated fadeInRight">
    <div class="col-lg-5">
        <div class="row">
            <div class="col-lg-12">
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
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Top Faqs</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="dd" id="nestable2">
                            <ol class="dd-list">
                                @foreach (Common::getFaqs() as $faq)
                                    <div class="vertical-timeline-block">
                                        <div class="vertical-timeline-icon navy-bg">
                                            <i class="fa fa-info"></i>
                                        </div>

                                        <div class="vertical-timeline-content">
                                            <h2>{{ $faq['name'] }}</h2>
                                            <p>
                                                {!! $faq['description'] !!}
                                            </p>

                                        </div>
                                    </div>
                                @endforeach
                            </ol>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
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