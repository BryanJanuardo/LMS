<h6>Add a Post:</h6>
<form action="{{ route('forum.store', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id]) }}" method="POST"  enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="d-flex flex-column gap-2">
        <textarea name="ForumTitle" class="form-control" rows="1" placeholder="Write your title post here..." required></textarea>
        <textarea name="ForumDescription" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
        <input name="FilePath" class="form-control" type="file">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
