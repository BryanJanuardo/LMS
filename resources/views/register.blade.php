@extends('partials.guest-layout')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Register</h2>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="UserName" class="form-label">Name</label>
                <input type="text" class="form-control" id="UserName" name="UserName" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="UserEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="UserEmail" name="UserEmail" placeholder="Enter your email">
            </div>
            <div class="mb-3">
                <label for="UserPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="UserPassword" name="UserPassword" placeholder="Enter your password">
            </div>
            <div class="mb-3">
                <label for="UserDOB" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="UserDOB" name="UserDOB">
            </div>
            <div class="mb-3">
                <label for="UserPhotoPath" class="form-label">Photo</label>
                <input type="file" class="form-control" id="UserPhotoPath" name="UserPhotoPath" accept="image/*">
            </div>
            <div class="d-grid">
                <button type="button" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
