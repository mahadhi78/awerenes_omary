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

