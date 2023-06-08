<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Request::segment(1) === 'dashboard' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'customer-show' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('user') }}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'notification' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('notification-index') }}">
                <i class="ti-bell menu-icon"></i>
                <span class="menu-title">Notification</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'template' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('index-template') }}">
                <i class="ti-clipboard menu-icon"></i>
                <span class="menu-title">Templates</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'banners-show' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('banners-show') }}">
                <i class="ti-image menu-icon"></i>
                <span class="menu-title">Banners</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'marketing_tips' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('marketing_tips-index') }}">
                <i class="ti-pencil-alt menu-icon"></i>
                <span class="menu-title">Marketing Tips</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'faqs' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('faqs-index') }}">
                <i class="ti-help-alt menu-icon"></i>
                <span class="menu-title">FAQ</span>
            </a>
        </li>
        <li class="nav-item {{ Request::segment(1) === 'policies' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('policies-index') }}">
                <i class="ti-write menu-icon"></i>
                <span class="menu-title">Policies</span>
            </a>
        </li>
    </ul>
</nav>
