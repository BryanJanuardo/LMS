@extends('layout')

@section('title', 'Schedule')

@section('content')
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="mt-3">
                    <div id="calendar" class="custom-calendar"></div>
                </div>
            </div>
        </div>

        <div id="modal-action" class="modal" tabindex="-1"></div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
                integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
                integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
                integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <style>
            body {
                background-color: #f8f9fa;
            }

            #calendar {
                background-color: white !important;
                padding: 50px;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 1600px;
                max-width: 100%;
                margin: 0 auto;
                overflow-y: scroll;
            }

            @media (max-width: 1400px) {
                #calendar {
                    width: 95%;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'timeGridWeek',
                        themeSystem: 'bootstrap5',
                        events: function (info, successCallback, failureCallback) {
                            $.ajax({
                                url: '{{ route('schedule.getListCourses') }}',
                                method: 'GET',
                                data: {
                                    DateStart: info.startStr,
                                    DateEnd: info.endStr
                                },
                                success: function (data) {
                                    successCallback(data);
                                },
                                error: function () {
                                    failureCallback();
                                }
                            });
                        },
                        editable: false,
                        eventResizableFromStart: false,
                        eventDurationEditable: false,
                        height: '750px',
                    eventClick: function ({ event }) {
                        window.location.href = `{{ route('course.detail', ['CourseID' => '__ID__']) }}`.replace('__ID__', event.id);
                        console.log(event.id);
                    },
                });
                calendar.render();
            });

        </script>
    </body>
</html>
@endsection
