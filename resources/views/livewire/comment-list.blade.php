<div class="comment-section">
    <div class="comment-list">
        @forelse ($comments as $comment)
            <div class="comment-container">
                <div class="comment-pfp">
                    <div class="comment-profile-picture-container overflow-hidden">
                        @php
                            $profilePicture =
                                $comment->hunter->profile && $comment->hunter->profile->profile_picture
                                    ? asset('storage/' . $comment->hunter->profile->profile_picture)
                                    : ($comment->hunter->profile->is_company
                                        ? asset('images/Tree.png') 
                                        : asset('images/default-pfp.gif')); 
                        @endphp
                        <img src="{{ $profilePicture }}" alt="{{ $comment->hunter->name }}'s profile picture"
                            class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="comment-text">
                    <a href="{{ route('profile.detail', ['profileId' => $comment->company->id]) }}" wire:navigate>
                        <p>
                            <strong>{{ $comment->hunter->name }}</strong>
                            commented on
                            <strong>{{ $comment->company->name }}</strong>:
                        </p>
                        <p>{{ $comment->content }}</p>
                        <p><em class="text-gray-500">Posted on {{ $comment->created_at->diffForHumans() }}</em></p>
                    </a>
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
                                <button wire:click="updateComment({{ $comment->id }})"
                                    class="update-comment-button">Update</button>
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
        @empty
            <div class="text-center">
                No thoughts found.
            </div>
        @endforelse

        <div class="pagination">
            {{ $comments->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
