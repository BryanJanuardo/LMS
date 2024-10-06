@extends('layout')

@section('title', 'Courses')

@push('styles')
    <link href="{{ asset('css/courses.css') }}" rel="stylesheet">
@endpush

@section('content')
    <h1>My Courses</h1>

    @php
        $latestPeriod = last($periods); 
    @endphp

    <div class="top-box">
        <p>Running Period:</p>
        <select id="semesterDropdown">
            @foreach ($periods as $period)
                <option value="{{ $period }}" {{ $period == $latestPeriod ? 'selected' : '' }}>
                    {{ $period }}
                </option>
            @endforeach
        </select>
    </div>

    @include('components.divider')

    <div id="courseList" class="course-container">
        <!-- Courses will be displayed here as cards -->
    </div>

    @include('components.course-card')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/courses.js') }}"></script>

@endsection
