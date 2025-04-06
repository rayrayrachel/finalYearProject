<div class="comment-section">
    <div class="comment-list">
        @foreach($comments as $comment)
            <div class="comment">
                <p><strong>{{ $comment->hunter->name }}:</strong> {{ $comment->content }}</p>
                <p><em>Posted on {{ $comment->created_at->diffForHumans() }}</em></p>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $comments->links() }}
    </div>
</div>
