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
    @stack('styles')
    <title>@yield('title')</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <h1 class="header-title">LEARNING MANAGEMENT SYSTEMS</h1>
            <div class="notification-button">
                <button aria-label="Notifications">
                    <i class="bi bi-bell-fill"></i>
                </button>
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
