<div id="courseCardTemplate" style="display: none;">
    <div class="course-card">
        <h3 class="course-title"></h3>
        <div class="course-details">
            <div class="course-detail">
                <i class="bi bi-person-badge-fill"></i>
                <span class="course-code"></span>
            </div>
            <div class="course-detail">
                <i class="bi bi-clipboard-check-fill"></i>
                <span class="course-credits"></span>
            </div>
            <div class="course-detail">
                <i class="bi bi-people-fill"></i>
                <span class="course-class"></span>
            </div>
        </div>
        @include('components.divider')
        <div class="progress-block">
            <p>Class Progress</p>
            <div class="progress-bar-container">
                <div class="progress-bar">
                    <div class="progress-fill"></div>
                </div>
            </div>
            <p class="progress-percentage"><span class="course-progress"></span>%</p>
        </div>
    </div>
</div>
