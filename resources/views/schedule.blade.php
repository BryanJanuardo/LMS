@extends('layout')

@section('title', 'Schedule and Announcements')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.0.0/dist/fullcalendar.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container my-5">
    <h2>Task Calendar</h2>
    <div id="calendar" class="table-responsive"></div>
    <div id="task-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tasks for <span id="task-date"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="task-list" class="list-group"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth();

    const renderCalendar = () => {
        let calendarHtml = `<table class="table table-bordered"><thead><tr>`;
        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        days.forEach(day => calendarHtml += `<th>${day}</th>`);
        calendarHtml += `</tr></thead><tbody>`;

        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        let date = 1;
        for (let i = 0; i < 6; i++) {
            calendarHtml += `<tr>`;
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay) {
                    calendarHtml += `<td></td>`;
                } else if (date > lastDate) {
                    break;
                } else {
                    const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    calendarHtml += `<td onclick="fetchTasks('${formattedDate}')">${date}</td>`;
                    date++;
                }
            }
            calendarHtml += `</tr>`;
            if (date > lastDate) break;
        }

        calendarHtml += `</tbody></table>`;
        document.getElementById('calendar').innerHTML = calendarHtml;
    };

    const fetchTasks = (date) => {
    $.ajax({
        url: '/schedule/2024-11-20', // Hardcoded test date
        method: 'GET',
        success: (tasks) => {
            console.log(tasks); // Check if tasks are fetched
        },
        error: (xhr, status, error) => {
            console.error(`Error fetching tasks: ${error}`);
        }
    });
};

    };

    document.addEventListener('DOMContentLoaded', () => {
        renderCalendar();
    });
</scri>
