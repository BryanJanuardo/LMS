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
                    <div class="d-flex flex-column">
                        <small class="text-muted"><span>Posted on {{ $post->CreatedDate }}</span> | <span>By: {{ $post->user->UserName }}</span></small>
                        <small class="text-muted"><a href="{{ $post->FilePath }}"  target="_blank"></a></small>
                    </div>

                    <button type="button" id="replyBtn" style="my: 4; padding: 0" class="btn btn-link toggle-reply-btn">Reply</button>
                    <ul class="mt-2 ps-4 border-start">
                        @foreach ($post->replies as $reply)
                            <li class="d-flex flex-column">
                                <p>{{ $reply->ReplyMessages }}</p>
                                <small class="text-muted"><span>Replied on {{ $reply->CreatedDate }}</span> | <span>By: {{ $reply->user->UserName }}</span></small>
                                <small class="text-muted"><a href="{{ $reply->FilePath }}"  target="_blank">{{ $reply->FilePath }}</a></small>
                            </li>
                        @endforeach
                    </ul>

                    <form action="{{ route('forum.reply', ['CourseID' => $sessionLearning->courseLearning->id, 'SessionID' => $sessionLearning->id, 'postId' => $post->id]) }}" method="POST" class="mt-2 reply-form hidden"  enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="d-flex flex-column gap-2">
                            <textarea name="ReplyMessages" class="form-control" rows="3" placeholder="Write your comment here..." required></textarea>
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
                        <div class="text-end my-2">
                            <button type="submit" class="btn btn-sm btn-secondary">Send Reply</button>
                            <button type="button" class="btn btn-sm btn-danger cancel-reply-btn">Cancel</button>
                        </div>
                    </form>
                </li>
            @endforeach
        </ul>
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
        const toggleButtons = document.querySelectorAll('#replyBtn');
        console.log(toggleButtons);
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                console.log("dadw");
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
