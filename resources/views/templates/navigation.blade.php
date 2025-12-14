<nav class="mt-2">
    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('order.index') }}" class="nav-link {{ request()->routeIs('order.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-cart"></i>
                <p>POS</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
            </a>
        </li>
        @yield('navigation')
    </ul>
</nav>