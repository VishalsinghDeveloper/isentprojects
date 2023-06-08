<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('dashboard') }}"><b> Isent Admin</b></a> {{--<img src="newad/images/logo.svg" class="mr-2"
        alt="logo" /> --}}
        <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">Isent</a> {{--<img src="newad/images/logo-mini.svg"
        alt="logo" />--}}
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            {{-- <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span class="count"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                @foreach ( $notifications as $notification )
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="ti-info-alt mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">{{ $notification->message }}</h6>
            <p class="font-weight-light small-text mb-0 text-muted">
                Just now
            </p>
    </div>
    </a>
    @endforeach
    <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
            <div class="preview-icon bg-warning">
                <i class="ti-settings mx-0"></i>
            </div>
        </div>
        <div class="preview-item-content">
            <h6 class="preview-subject font-weight-normal">Settings</h6>
            <p class="font-weight-light small-text mb-0 text-muted">
                Private message
            </p>
        </div>
    </a>
    <a class="dropdown-item preview-item">
        <div class="preview-thumbnail">
            <div class="preview-icon bg-info">
                <i class="ti-user mx-0"></i>
            </div>
        </div>
        <div class="preview-item-content">
            <h6 class="preview-subject font-weight-normal">New user registration</h6>
            <p class="font-weight-light small-text mb-0 text-muted">
                2 days ago
            </p>
        </div>
    </a>
    </div>
    </li> --}}
    <li class="nav-item nav-profile dropdown">
        <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            @if(!empty( Auth::user()->images ) && File::exists(public_path(Auth::user()->images )))
            <img src="{{ asset(Auth::user()->images ) }}" class="rounded-circle img-fluid">
            @else
            <img src="{{ asset('uploads/noimg.webp') }}" class="rounded-circle img-fluid">
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="{{ route('profile') }}">
                <i class="ti-settings text-primary"></i>
                Profile
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}">
                <i class="ti-power-off text-primary"></i>
                Logout
            </a>
        </div>
    </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="icon-menu"></span>
    </button>
    </div>
</nav>

