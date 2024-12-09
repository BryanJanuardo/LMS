<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/sidebar.css">
    <link rel="stylesheet" href="/css/global.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    @stack('styles')
    <title>@yield('title')</title>
</head>

<body>
    <header class="header bg-primary text-white p-3">
        <div class="header-content">
            <h1 class="header-title h3">LEARNING MANAGEMENT SYSTEMS</h1>
            <div class="notification-button">
                <button class="btn btn-link text-white p-0" aria-label="Notifications" id="notificationButton">
                    <i class="bi bi-bell-fill fs-3"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end p-3 overflow-y-scroll" style="right: 0; top: 60px; max-height: 300px" id="notificationDropdown">
                    @foreach ($announcements as $announcement)
                        <li class="p-2 border-bottom mb-2">
                            <p class="m-0 text-wrap" style="max-width: 300px" data-id="{{ $announcement->id }}">
                                {{ $announcement->AnnouncementMessage }}
                                <a class="text-primary text-decoration-none mark-as-read" href="#" data-id="{{ $announcement->id }}">Mark as read</a>
                            </p>
                        </li>
                    @endforeach
                    @if($announcements->isEmpty())
                        <li class="dropdown-item">
                            <p class="m-0 text-muted">No new announcements</p>
                        </li>
                    @endif
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
    @stack('scripts')
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#notificationButton').on('click', function (e) {
        e.preventDefault();
        $('#notificationDropdown').toggleClass('show'); 
    });

    $(document).on('click', '.mark-as-read', function(e) {

        var announcementId = $(this).data('id');
        var url = '/announcement/' + announcementId;
        var li = $(this).closest('li')
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.status === 'success') {
                    li.remove();
                }
            },
            error: function() {
                console.error('AJAX Error');
                alert('An error occurred.');
            }
        });
    });
</script>
</html>
