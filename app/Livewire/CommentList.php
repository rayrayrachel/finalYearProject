<?php

namespace App\Livewire;

use App\Models\Comment;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class CommentList extends Component
{
    use WithPagination;

    public $companyId;
    public $commentContent;

    public $editingCommentId = null;
    public $confirmingDelete = null;

    protected $listeners = [
        'commentAdded' => 'refreshComments',
        'submitClicked' => 'refreshComments',
        'refreshCommentList' => 'refreshComments'
    ];

    public function mount($companyId)
    {
        $this->companyId = $companyId;
    }

    public function refreshComments()
    {
        $this->resetPage();
    }

    public function toggleEditForm($commentId)
    {
        if ($this->editingCommentId === $commentId) {
            $this->commentContent = '';
        } else {
            $this->commentContent = Comment::find($commentId)->content;
        }

        $this->editingCommentId = $this->editingCommentId === $commentId ? null : $commentId;
    }

    public function confirmDelete($commentId)
    {
        $this->confirmingDelete = $commentId;
    }

    public function deleteComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Auth::id() !== $comment->hunter_id) {
            abort(403, 'Unauthorized');
        }

        $comment->delete();

        session()->flash('message', 'Comment deleted successfully!');
        $this->confirmingDelete = null;
        $this->editingCommentId = null;
        $this->commentContent = '';
        $this->dispatch('refreshCommentList');
    }

    public function updateComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (empty($this->commentContent)) {
            session()->flash('error', 'Comment content cannot be empty.');
            return;
        }

        if (Auth::id() !== $comment->hunter_id) {
            session()->flash('error', 'You are not authorized to edit this comment.');
            return;
        }

        $comment->update(['content' => $this->commentContent]);

        session()->flash('message', 'Comment updated successfully!');
        $this->editingCommentId = null;
        $this->commentContent = '';
        $this->dispatch('refreshCommentList');
    }

    public function render()
    {
        $commentsQuery = Comment::with('company')->orderBy('created_at', 'desc');;

        if ($this->companyId) {
            $commentsQuery->where('company_id', $this->companyId);
        }

        $comments = $commentsQuery->paginate(5);

        return view('livewire.comment-list', [
            'comments' => $comments
        ]);
    }
}
