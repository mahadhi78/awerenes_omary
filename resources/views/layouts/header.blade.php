<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
            <i class="fa fa-bars"></i>
        </a>
        @if (Common::getSystemName())
            <p class="minimalize-styl-2 text-primary " href="#">
                <b> {{ Common::getSystemName() }}</b>
            </p>
        @else
            <p class="minimalize-styl-2 text-primary " href="#">
                <b> {{ config('app.name') }}</b>
            </p>
        @endif
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li>
            
            @if ($profile = Auth::user()->photo_path)
                <img style="width:40px;height:40px;" class="ml-3 rounded-circle" src="{{ asset('' . $profile) }}">
            @else
                <img style="width:40px;height:40px;" class="ml-3 rounded-circle"
                    src="{{ asset('images/user_logo.png') }}">
            @endif
            <span class="m-r-sm text-muted"> <b>{{ Auth::user()->firstname }}
                    {{ Auth::user()->lastname }}</b></span>
        </li>
        @if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR) || Auth::user()->hasRole(Constants::ROLE_ADMINISTRATOR))
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> <span class="label label-danger">{{ Common::CountNotification() }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    @if (common::CountNotification() > 0)
                        @foreach (common::getNotification() as $notify)
                            <li>
                                <a href="#" class="dropdown-item">
                                    <div>{{ $notify->message }}
                                        <span class="float-right text-muted small">{{ $notify->created_at }}</span>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                        @endforeach
                    @else
                        <li>
                            <a href="#" class="dropdown-item">
                                <div>
                                    No Message
                                </div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <li>
            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> Log out
            </a>
            <form id="logout_form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
