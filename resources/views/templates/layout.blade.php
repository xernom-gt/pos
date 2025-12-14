<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'POSApp')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" media="print" onload="this.media='all'">

    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">

    <!-- ApexCharts & JSVectorMap (opsional) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css">

    @stack('style')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ url('/') }}" class="nav-link">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User">
                            <span class="d-none d-md-inline">{{ auth()->check() ? auth()->user()->name : 'Guest' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User">
                                <p>{{ auth()->check() ? auth()->user()->name : 'Guest Account' }}</p>
                            </li>
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="#" class="btn btn-default btn-flat float-end">Sign in</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <div class="sidebar-brand">
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="Logo" class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-light">POSApp</span>
                </a>
            </div>
            <div class="sidebar-wrapper">
                @include('templates.navigation')
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        @include('templates.footer')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>

    <!-- OverlayScrollbars Init -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            const isMobile = window.innerWidth <= 992;

            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars && !isMobile) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true }
                });
            }
        });
    </script>

    <!-- jQuery (wajib untuk script POS) -->
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>

    @stack('script')
</body>
</html>