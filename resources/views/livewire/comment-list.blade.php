<div class="comment-section">
    <div class="comment-list">
        @foreach ($comments as $comment)
            <div class="comment-container">
                <div class="comment-pfp">
                    <div class="comment-profile-picture-container">
                        <img src="{{ $comment->hunter->profile_picture_url }}" alt="{{ $comment->hunter->name }}'s profile picture" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="comment-text">
                    <p><strong>{{ $comment->hunter->name }}:</strong> {{ $comment->content }}</p>
                    <p><em>Posted on {{ $comment->created_at->diffForHumans() }}</em></p>
                </div>
                @auth
                    @if ($editingCommentId === $comment->id)
                        <div wire:key="edit-{{ $comment->id }}">
                            @if (session()->has('error'))
                                <div class="alert alert-error">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <textarea wire:model="commentContent" class="w-full p-2 border rounded" rows="3"></textarea>
                            <div class="mt-2">
                                <button wire:click="updateComment({{ $comment->id }})" class="update-comment-button">Update</button>
                            </div>
                        </div>
                    @endif

                    @if ($confirmingDelete === $comment->id)
                        <div class="mt-2">
                            <p class="text-red-600 font-semibold">Are you sure you want to delete this comment?</p>
                            <div class="flex gap-2 mt-1">
                                <button wire:click="deleteComment({{ $comment->id }})" class="delete-button">Yes</button>
                                <button wire:click="$set('confirmingDelete', null)" class="cancel-button">No</button>
                            </div>
                        </div>
                    @elseif (Auth::id() === $comment->hunter_id)
                        <div class="flex gap-2 mt-2 goto">
                            <button wire:click="toggleEditForm({{ $comment->id }})" class="edit-button-toggle">
                                {{ $editingCommentId === $comment->id ? 'QUIT' : 'EDIT' }}
                            </button>
                            <button wire:click="confirmDelete({{ $comment->id }})" class="delete-button">
                                DELETE
                            </button>
                        </div>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $comments->links() }}
    </div>
</div>
