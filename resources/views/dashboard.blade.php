<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/global.css">
    <title>Dashboard</title>
</head>
<body>
    <header class="row header py-2 px-3 sticky-top">
        <div class="col d-flex justify-content-between align-items-center px-3">
            <h1 class="h4 mb-0">LEARNING MANAGEMENT SYSTEMS</h1>
            <div class="d-flex align-items-center">
                <button class="btn btn-link" aria-label="Notifications">
                    <i class="bi bi-bell-fill" style="font-size: 1.5em;"></i>
                </button>
            </div>
        </div>
    </header>
    {{-- <div class="container-fluid overflow-hidden"> --}}
        <div class="row overflow-auto">
            <div class="col-12 col-sm-3 col-xl-2 px-sm-2 px-0 bg-white d-flex flex-column custom-sidebar">
                <div class="d-flex flex-column flex-grow-1 align-items-start px-3 pt-3">
                    <ul class="nav nav-pills flex-column flex-nowrap mb-auto" id="menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link active d-flex align-items-center justify-content-start">
                                <img src="/images/icon/ri_dashboard-fill.svg" alt="Dashboard Icon" class="icon" style="width: 1.5em; height: 1.5em; margin-right: 8px;">
                                <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-start">
                                <img src="/images/icon/ion_calendar-sharp.svg" alt="Calendar Icon" class="icon" style="width: 1.5em; height: 1.5em; margin-right: 8px;">
                                <span class="ms-1 d-none d-sm-inline">Schedule</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-start">
                                <img src="/images/icon/material-symbols_forum.svg" alt="Forum Icon" class="icon" style="width: 1.5em; height: 1.5em; margin-right: 8px;">
                                <span class="ms-1 d-none d-sm-inline">Forum</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link d-flex align-items-center justify-content-start">
                                <img src="/images/icon/graduation-hat.svg" alt="Graduation Hat Icon" class="icon" style="width: 1.5em; height: 1.5em; margin-right: 8px;">
                                <span class="ms-1 d-none d-sm-inline">Courses</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col d-flex flex-column h-sm-100 content-area">
                <main class="row overflow-auto">
                    <div class="col pt-3">
                        <h3>Content</h3>
                    </div>
                </main>
            </div>
        </div>
    {{-- </div> --}}

    <script src="js/dashboard.js"></script>
</body>
</html>
