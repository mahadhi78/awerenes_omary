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
                        <h2 class="font-bold"></h2>
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
                    <i class="fa fa-envelope-o fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                    <span> Notifications</span>
                    <h2 class="font-bold">{{ Common::CountNotification() }}</h2>
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
                    <span> Inputs </span>
                    <h2 class="font-bold">0</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Inputs <small>Statistics.</small></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-bar-chart" style="padding: 0px; position: relative;">
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="col-lg-6">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Logbook <small>Report.</small></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="logbook" style="padding: 0px; position: relative;">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
