<div class="card mt-4">
    <div class="card-header bg-primary text-white">
        <h6>Discussion Forum</h6>
    </div>
    <div class="card-body">
        <h6>Posts:</h6>
        <ul class="list-unstyled">
            @foreach ($sessionLearning->forumPosts as $post)
                <li class="border-bottom pb-2 mb-2">
                    <strong>{{ $post->ForumTitle }}:</strong>
                    <p>{{ $post->ForumDescription }}</p>
                    <small class="text-muted">Posted on {{ $post->CreatedDate }}</small>
                    <small>Nama: blablabla</small>
                    <small class="text-muted"><a href="{{ $post->FilePath }}">{{ $post->FilePath }}</a></small>

                    <button type="button" class="btn btn-link toggle-reply-btn">Reply</button>
                    <ul class="mt-2 ps-4 border-start">
                        @foreach ($post->replies as $reply)
                            <li>
                                {{-- <strong>{{ $reply->username }}:</strong> --}}
                                <p>{{ $reply->ReplyMessages }}</p>
                                <small class="text-muted">Replied on {{ $reply->CreatedDate }}</small>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('forum.reply', ['CourseID' => $sessionLearning->courseLearning->CourseID, 'SessionID' => $sessionLearning->id, 'postId' => $post->id]) }}" method="POST" class="mt-2 reply-form hidden">
                        @csrf
                        <textarea name="content" class="form-control" rows="2" placeholder="Write your reply..." required></textarea>
                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-sm btn-secondary">Send Reply</button>
                            <button type="button" class="btn btn-sm btn-danger cancel-reply-btn">Cancel</button>
                        </div>
                    </form>
                </li>
            @endforeach
        </ul>

        <h6>Add a Post:</h6>
        <form action="{{ route('forum.store', ['CourseID' => $sessionLearning->courseLearning->CourseID, 'SessionID' => $sessionLearning->id, 'postId' => $post->id]) }}" method="POST">
            @csrf
            <textarea name="content" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>

<style>
    .hidden {
        display: none;
    }
    p{
        margin-bottom: 0;
    }
    li{
        margin-bottom: 8px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.toggle-reply-btn');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const replyForm = this.closest('li').querySelector('.reply-form');
                replyForm.classList.toggle('hidden');
            });
        });
        const cancelButtons = document.querySelectorAll('.cancel-reply-btn');

        cancelButtons.forEach(button => {
            button.addEventListener('click', function () {
                const replyForm = this.closest('li').querySelector('.reply-form');
                replyForm.classList.add('hidden');
                replyForm.querySelector('textarea').value = '';
            });
        });
    });
</script>
