<ul class="nav-menu" id="menu">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('schedule.index') }}" class="nav-link {{ request()->is('schedule') ? 'active' : '' }}">
            <i class="bi bi-calendar-week-fill"></i>
            <span class="nav-text">Schedule</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('course.index') }}" class="nav-link {{ request()->is('courses') ? 'active' : '' }}">
            <i class="bi bi-mortarboard-fill"></i>
            <span class="nav-text">Courses</span>
        </a>
    </li>
    <!-- Management Dropdown -->
    <li class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle {{ request()->is('course.management') ? 'active' : '' }}" id="managementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-archive-fill"></i>
            <span class="nav-text">Management</span>
        </a>
        <ul class="dropdown-menu" aria-labelledby="managementDropdown">
            <li><a class="dropdown-item" href="{{ route('course.management') }}">Course Management</a></li>
        </ul>
    </li>
</ul>
