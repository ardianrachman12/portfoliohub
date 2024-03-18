<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/post">
                <i class="ti-write  menu-icon"></i>
                <span class="menu-title">Post</span>
            </a>
        </li>
        @if (auth()->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="/user">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">User</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="/profile">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.show', auth()->user()->username) }}" target="_blank">
                <i class="ti-desktop menu-icon"></i>
                <span class="menu-title">Your Website</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/logout">
                <i class="ti-power-off menu-icon"></i>
                <span class="menu-title">Logout</span>
            </a>
        </li>
    </ul>
</nav>
