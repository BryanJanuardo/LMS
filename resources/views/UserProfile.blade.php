@extends('layout')

@section('title', 'Edit User')

@push('styles')
    <link href="{{ asset('css/user-profile.css') }}" rel="stylesheet">
@endpush

@section('content')

    <h1>Edit Your Profile</h1>

    <form method="post" action="{{ route('user.update') }}">
        @csrf
        @method('PUT')

        <div>
            <label for="UserName">Username</label>
            <input type="text" name="UserName" placeholder="Username" value="{{ Auth::user()->UserName }}" required />
        </div>
        <div>
            <label for="UserEmail">Email</label>
            <input type="email" name="UserEmail" placeholder="Email" value="{{ Auth::user()->UserEmail }}" required />
        </div>
        <div>
            <label for="UserPassword">Password</label>
            <input type="password" name="UserPassword" placeholder="Password" value="{{ Auth::user()->UserPassword }}" required />
        </div>
        <div>
            <label for="UserDOB">Date of Birth</label>
            <input type="date" name="UserDOB" value="{{ Auth::user()->UserDOB }}" required />
        </div>

        <div>
            <input type="submit" value="Update Profile">
        </div>
    </form>

@endsection
