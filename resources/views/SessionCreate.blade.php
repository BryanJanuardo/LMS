@extends('layout')

@section('title', 'New Session')

@section('content')

<h1>Create new Session</h1>
<form method="post" action="{{ route('session.store', ['CourseID' => $courseID]) }}">
    @csrf
    @method('POST')
    <div class="mb-3">
        <label for="SessionName" class="form-label">Session Name</label>
        <input type="text" class="form-control" id="SessionName" name="SessionName" placeholder="Session Name" />
    </div>
    <div class="mb-3">
        <label for="SessionDescription" class="form-label">Session Description</label>
        <input type="text" class="form-control" id="SessionDescription" name="SessionDescription" placeholder="Session Description" />
    </div>
    <div class="mb-3">
        <label for="SessionStart" class="form-label">Session Start</label>
        <input type="datetime-local" class="form-control" id="SessionStart" name="SessionStart" />
    </div>
    <div class="mb-3">
        <label for="SessionEnd" class="form-label">Session End</label>
        <input type="datetime-local" class="form-control" id="SessionEnd" name="SessionEnd" />
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

@endsection