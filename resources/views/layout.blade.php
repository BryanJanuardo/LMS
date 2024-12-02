<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;@600;@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    @stack('styles')
    <title>@yield('title')</title>
</head>

<body>
    <header class="header d-flex justify-content-between align-items-center">
        <div class="header-content">
            <h1 class="header-title">LEARNING MANAGEMENT SYSTEMS</h1>
        </div>
        <div class="header-icons d-flex align-items-center">
            <div class="notification-button me-3">
                <button aria-label="Notifications" class="btn btn-light">
                    <i class="bi bi-bell-fill"></i>
                </button>
            </div>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </div>

        </div>
    </header>

    <div class="custom-sidebar">
        <div class="menu-container">
            @include('partials.sidebar')
        </div>
    </div>

    <div class="content-area">
        @yield('content')
    </div>

    <script src="/js/dashboard.js"></script>
</body>
</html>
