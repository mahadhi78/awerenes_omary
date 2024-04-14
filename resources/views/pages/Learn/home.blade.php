@extends('layouts.empty')
@section('page_title', 'Home ')

@section('content')

    <div class="row">
        <div class="col-lg-8">
            <div class="ibox ">
                <div class="ibox-content">
                    <div>
                        <span class="float-right text-right">
                            <small>Average value of sales in the past month in: <strong>United
                                    states</strong></small>
                            <br>
                            All sales: 162,862
                        </span>
                        <h3 class="font-bold no-margins">
                            Half-year revenue margin
                        </h3>
                        <small>Sales marketing.</small>
                    </div>

                    <div class="m-t-sm">

                        <div class="row">
                            <div class="col-md-8">
                                <div><iframe class="chartjs-hidden-iframe"
                                        style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; inset: 0px;"></iframe>
                                    <canvas id="lineChart" height="171" width="450"
                                        style="display: block; width: 450px; height: 171px;"></canvas>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <ul class="stat-list m-t-lg">
                                    <li>
                                        <h2 class="no-margins">2,346</h2>
                                        <small>Total orders in period</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 48%;"></div>
                                        </div>
                                    </li>
                                    <li>
                                        <h2 class="no-margins ">4,422</h2>
                                        <small>Orders in last month</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 60%;"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="m-t-md">
                        <small class="float-right">
                            <i class="fa fa-clock-o"> </i>
                            Update on 16.07.2015
                        </small>
                        <small>
                            <strong>Analysis of sales:</strong> The value has been changed over time, and last month
                            reached a level over $50,000.
                        </small>
                    </div>

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
