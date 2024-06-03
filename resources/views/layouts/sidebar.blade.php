<li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
    <a href="{{ route('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">
        <i class="fa fa-th-large fa-sm"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>
@if (!(Auth::user()->userType == Constants::LEARNER))
    @if (Gate::any(['phishing-list', 'phishing-edit', 'phishing-save', 'phishing-destroy']))
        <li class="{{ Route::currentRouteName() == 'phishing.list' ? 'active' : '' }}">
            <a href="{{ route('phishing.list') }}" class="{{ Request::is('phishing.list') ? 'active' : '' }}">
                <i class="fa fa-desktop fa-sm"></i>
                <span class="nav-label">Phishingii</span>
            </a>
        </li>
    @endif
    @if (Gate::any(['news-list', 'news-edit', 'news-save', 'news-destroy']))
        <li class="{{ Route::currentRouteName() == 'news.list' ? 'active' : '' }}">
            <a href="{{ route('news.list') }}" class="{{ Request::is('news.list') ? 'active' : '' }}">
                <i class="fa fa-envelope fa-sm"></i>
                <span class="nav-label">News</span>
            </a>
        </li>
    @endif
    @if (collect(Common::learningPermissions())->filter(function ($permission) {
                return Gate::check($permission);
            })->isNotEmpty())
        <li id="learning_mgnt">
            <a href="#"><i class="fa fa-book fa-md"></i>
                <span class="nav-label">Manage Learning</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">
                @if (Gate::any(['levels-list', 'levels-edit', 'levels-save', 'levels-destroy']))
                    <li>
                        <a href="{{ route('levels.list') }}" data-route="levels.list">Levels</a>
                    </li>
                @endif
                @if (Gate::any(['course-list', 'course-edit', 'course-save', 'course-destroy']))
                    <li>
                        <a href="{{ route('course.list') }}" data-route="course.list">Course</a>
                    </li>
                @endif
                @if (Gate::any(['module-list', 'module-edit', 'module-save', 'module-destroy']))
                    <li>
                        <a href="{{ route('module.list') }}" data-route="module.list">Modules</a>
                    </li>
                @endif
                @if (Gate::any(['lesson-list', 'lesson-edit', 'lesson-save', 'lesson-destroy']))
                    <li>
                        <a href="{{ route('lesson.list') }}" data-route="lesson.list">Lessons</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (collect(Common::usersPermissions())->filter(function ($permission) {
                return Gate::check($permission);
            })->isNotEmpty())
        <li id="users_m">
            <a href="#"><i class="fa fa-user-plus fa-sm"></i>
                <span class="nav-label">Users</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">
                @if (Gate::check('staffs-save'))
                    <li>
                        <a href="{{ route('staffs.create') }}" data-route="staffs.create"> Staff's Registration</a>
                    </li>
                @endif
                @if (Gate::check('staffs-list') || Gate::check('staffs-edit') || Gate::check('staffs-delete'))
                    <li>
                        <a href="{{ route('staffs.list') }}" data-route="staffs.list">Staff's' List</a>
                    </li>
                @endif
                @if (Gate::check('learners-save'))
                    <li>
                        <a href="{{ route('learners.create') }}" data-route="learners.create">Student Registration</a>
                    </li>
                @endif

                @if (Gate::check('staffs-list') || Gate::check('staffs-edit') || Gate::check('staffs-delete'))
                    <li>
                        <a href="{{ route('learners.list') }}" data-route="learners.list">Student List</a>
                    </li>
                @endif

            </ul>
        </li>
    @endif
    @if (collect(Common::approvalPermissions())->filter(function ($permission) {
                return Gate::check($permission);
            })->isNotEmpty())
        <li id="approval">
            <a href="#"><i class="fa fa-check-square-o fa-sm"></i>
                <span class="nav-label">Approval</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">
                @if (Gate::check('user_approval-list'))
                    <li>
                        <a href="{{ route('user_approval.list') }}" data-route="user_approval.list">
                            Registration
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
    @if (collect(Common::reportsPermissions())->filter(function ($permission) {
                return Gate::check($permission);
            })->isNotEmpty())
        <li id="reports">
            <a href="#"><i class="fa fa-file-text-o fa-sm"></i>
                <span class="nav-label">Reports</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">
                @if (Gate::any(['type-list', 'type-edit', 'type-save', 'type-destroy']))
                    <li>
                        <a href="{{ route('type.list') }}" data-route="type.list">
                            Type
                        </a>
                    </li>
                @endif
                @if (Gate::any(['report-list', 'report-edit', 'report-save', 'report-destroy']))
                    <li>
                        <a href="{{ route('report.list') }}" data-route="report.list">
                            Feedback
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

    @if (Gate::any(['roles-list', 'roles-edit', 'roles-save', 'roles-destroy']))
        <li class="{{ Route::currentRouteName() == 'roles-list' ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}" class="{{ Request::is('roles-list') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span class="nav-label">Role Management</span>
            </a>
        </li>
    @endif


    @if (collect(Common::systemSettingPermissions())->filter(function ($permission) {
                return Gate::check($permission);
            })->isNotEmpty())
        <li id="system-settings">
            <a href="#"><i class="fa fa-cogs fa-sm"></i>
                <span class="nav-label">System Setting</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="nav nav-second-level collapse">

                @if (Gate::check('settings-list') || Gate::check('settings-edit') || Gate::check('settings-save'))
                    <li>
                        <a href="{{ route('settings.list') }}" data-route="settings.list">Configuation</a>
                    </li>
                @endif


            </ul>
        </li>
    @endif
@endif
@if (Auth::user()->userType == Constants::LEARNER)
    <li class="{{ Route::currentRouteName() == 'learning.course' ? 'active' : '' }}">
        <a href="{{ route('learning.course') }}" class="{{ Request::is('learning.course') ? 'active' : '' }}">
            <i class="fa fa-book fa-sm"></i>
            <span class="nav-label">Course</span>
        </a>
    </li>
    <li class="{{ Route::currentRouteName() == 'report.create' ? 'active' : '' }}">
        <a href="{{ route('report.create') }}" class="{{ Request::is('report.create') ? 'active' : '' }}">
            <i class="fa fa-file fa-sm"></i>
            <span class="nav-label">Report</span>
        </a>
    </li>
    <li class="{{ Route::currentRouteName() == 'news.list' ? 'active' : '' }}">
        <a href="{{ route('news.list') }}" class="{{ Request::is('news.list') ? 'active' : '' }}">
            <i class="fa fa-envelope fa-sm"></i>
            <span class="nav-label">News</span>
        </a>
    </li>
@endif
<li id="security">
    <a href="#"><i class="fa fa-lock fa-sm"></i>
        <span class="nav-label">Security</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level collapse">
        <li>
            <a href="{{ route('profile.index') }}" data-route="profile.index">Profile</a>
        </li>
        <li>
            <a href="{{ route('LoginHistory') }}" data-route="LoginHistory">
                Login History
            </a>
        </li>
        <li>
            <a href="{{ route('profile.changePassword') }}" data-route="profile.changePassword">
                Change Password
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"
                data-bs-toggle="tooltip" title="Log out">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>

    </ul>
</li>
