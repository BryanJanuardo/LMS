<ul class="nav-menu" id="menu">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <img src="/images/icon/ri_dashboard-fill.svg" alt="Dashboard Icon" class="icon">
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('schedule.index') }}" class="nav-link {{ request()->is('schedule') ? 'active' : '' }}">
            <img src="/images/icon/ion_calendar-sharp.svg" alt="Calendar Icon" class="icon">
            <span class="nav-text">Schedule</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('course.index') }}" class="nav-link {{ request()->is('courses') ? 'active' : '' }}">
            <img src="/images/icon/graduation-hat.svg" alt="Graduation Hat Icon" class="icon">
            <span class="nav-text">Courses</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('task.index') }}" class="nav-link {{ request()->is('tasks') ? 'active' : '' }}">
            <img src="" class="icon">
            <span class="nav-text">Tasks</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('course.management') }}" class="nav-link {{ request()->is('tasks') ? 'active' : '' }}">
            <img src="" class="icon">
            <span class="nav-text">Course Management</span>
        </a>
    </li>
</ul>
