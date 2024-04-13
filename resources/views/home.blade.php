@extends('layouts.app')
@section('page_title', 'Dashboard ')
@section('content')
    @if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR) || Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR))
        @include('pages.home.admin')
    @else
        @include('pages.home.staff')
    @endif
    @push('scripts')
    <script src="{{ asset('assets/js/plugins/flot/jquery.flot.js') }}"></script>
    <script>
        $(function() {
            var barOptions = {
                series: {
                    bars: {
                        show: true,
                        barWidth: 0.5,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0.8
                            }, {
                                opacity: 0.8
                            }]
                        }
                    }
                },
                xaxis: {
                    tickDecimals: 0
                },
                colors: ["#1ab394"],
                grid: {
                    color: "#999999",
                    hoverable: true,
                    clickable: true,
                    tickColor: "#D4D4D4",
                    borderWidth: 0
                },
                legend: {
                    show: false
                },
                tooltip: false,
                tooltipOpts: {
                    content: "x: %x, y: %y"
                }
            };
            var barData = {
                label: "bar",
                data: [
                    [1, 34],
                    [2, 25],
                    [3, 19],
                    [4, 34],
                    [5, 32],
                    [6, 44],
                    [6, 84],
                ]
            };
            $.plot($("#flot-bar-chart"), [barData], barOptions);
            $.plot($("#logbook"), [barData], barOptions);


        });
    </script>
@endpush
@endsection
