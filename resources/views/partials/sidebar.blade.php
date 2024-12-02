<ul class="nav-menu" id="menu">
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <img src="/images/icon/ri_dashboard-fill.svg" alt="Dashboard Icon" class="icon">
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('schedule') }}" class="nav-link {{ request()->is('schedule') ? 'active' : '' }}">
            <img src="/images/icon/ion_calendar-sharp.svg" alt="Calendar Icon" class="icon">
            <span class="nav-text">Schedule</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="/course"
           class="nav-link {{ request()->is('course*') ? 'active' : '' }}">
            <img src="/images/icon/graduation-hat.svg" alt="Courses Icon" class="icon">
            <span class="nav-text">Courses</span>
        </a>
    </li>


</ul>
