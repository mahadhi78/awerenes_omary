<li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
    <a href="{{ route('home') }}" class="{{ Request::is('home') ? 'active' : '' }}">
        <i class="fa fa-th-large fa-lg"></i>
        <span class="nav-label">Dashboard</span>
    </a>
</li>

@if (collect(Common::approvalPermissions())->filter(function ($permission) {
            return Gate::check($permission);
        })->isNotEmpty())
    <li id="course_management">
        <a href="#"><i class="fa fa-book fa-md"></i>
            <span class="nav-label">Manage Learning</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">

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
@if (collect(Common::staffsPermissions())->filter(function ($permission) {
            return Gate::check($permission);
        })->isNotEmpty())
    <li id="staffs">
        <a href="#"><i class="fa fa-user-plus fa-lg"></i>
            <span class="nav-label">Users</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">
            @if (Gate::check('staffs-save'))
                <li>
                    <a href="{{ route('staffs.create') }}" data-route="staffs.create">Registration</a>
                </li>
            @endif
            {{-- @if (Gate::check('learners-save')) --}}
                <li>
                    <a href="{{ route('learners.create') }}" data-route="learners.create">Learners</a>
                </li>
            {{-- @endif --}}

        </ul>
    </li>
@endif
@if (collect(Common::approvalPermissions())->filter(function ($permission) {
            return Gate::check($permission);
        })->isNotEmpty())
    <li id="approval">
        <a href="#"><i class="fa fa-check-square-o fa-lg"></i>
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
@if (collect(Common::approvalPermissions())->filter(function ($permission) {
            return Gate::check($permission);
        })->isNotEmpty())
    <li id="reports">
        <a href="#"><i class="fa fa-file-text-o fa-lg"></i>
            <span class="nav-label">Reports</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">

            @if (Gate::check('staffs-list') || Gate::check('staffs-edit') || Gate::check('staffs-delete'))
                <li>
                    <a href="{{ route('staffs.list') }}" data-route="staffs.list">Staff's' Details</a>
                </li>
            @endif
            @if (Gate::check('staffs-list') || Gate::check('staffs-edit') || Gate::check('staffs-delete'))
                <li>
                    <a href="{{ route('learners.list') }}" data-route="learners.list">Learner's Details</a>
                </li>
            @endif
        </ul>
    </li>
@endif
@if (Gate::check('roles-list') || Gate::check('roles-edit'))
    <li>
        <a href="{{ route('roles.index') }}"><i class="fa fa-users"></i>
            <span class="nav-label">Role Management</span></a>
    </li>
@endif



@if (collect(Common::systemSettingPermissions())->filter(function ($permission) {
            return Gate::check($permission);
        })->isNotEmpty())
    <li id="system-settings">
        <a href="#"><i class="fa fa-cogs fa-lg"></i>
            <span class="nav-label">System Setting</span>
            <span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">

            @if (Gate::check('settings-list') || Gate::check('settings-edit') || Gate::check('settings-save'))
                <li>
                    <a href="{{ route('settings.list') }}" data-route="settings.list">Configuation</a>
                </li>
            @endif
            @if (Gate::any(['levels-list', 'levels-edit', 'levels-save', 'levels-destroy']))
                <li>
                    <a href="{{ route('levels.list') }}" data-route="levels.list">Levels</a>
                </li>
            @endif



        </ul>
    </li>
@endif

<li id="security">
    <a href="#"><i class="fa fa-lock fa-lg"></i>
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
