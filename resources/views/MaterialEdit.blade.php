@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Material</h2>

    <!-- Form to edit the material -->
    <form action="{{ route('material.update', ['CourseID' => $CourseID, 'SessionID' => $SessionID, 'MaterialID' => $MaterialID, 'PreviousURL' => URL::previous()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="MaterialName">Name</label>
            <input type="text" class="form-control" id="MaterialName" name="MaterialName" value="{{ old('MaterialName', $material->MaterialName) }}" required>
        </div>

        <div class="form-group">
            <label for="MaterialType">Type</label>
            <textarea class="form-control" id="MaterialType" name="MaterialType" rows="4" required>{{ old('MaterialType', $material->MaterialType) }}</textarea>
        </div>

        <div class="form-group">
            <label for="MaterialPath">File Path</label>
            <input name="MaterialPath" class="form-control" type="file" value="{{ old('MaterialPath', $material->MaterialPath) }}">
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
        <button type="submit" class="btn btn-primary">Update Material</button>
    </form>

</div>
@endsection
