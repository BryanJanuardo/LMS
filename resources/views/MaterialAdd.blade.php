@extends('layout')

@section('content')
<div class="container">
    <h2>Add Material</h2>

    <!-- Form to edit the material -->
    <form action="{{ route('material.store', ['CourseID' => $CourseID, 'SessionID' => $SessionID, 'PreviousURL' => URL::previous()]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="MaterialName">Name</label>
            <input type="text" class="form-control" id="MaterialName" name="MaterialName" placeholder="Enter material name" required>
        </div>

        <div class="form-group">
            <label for="MaterialType">Type</label>
            <textarea class="form-control" id="MaterialType" name="MaterialType" rows="4" placeholder="Enter material type" required></textarea>
        </div>

        <div class="form-group">
            <label for="MaterialPath">File Path</label>
            <textarea class="form-control" id="MaterialPath" name="MaterialPath" rows="4" placeholder="Enter material path" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Material</button>
    </form>

</div>
@endsection