<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentList extends Component
{
    use WithPagination;

    public $companyId;
    public $commentContent;

    protected $listeners = ['commentAdded' => 'refreshComments'];

    public function mount($companyId)
    {
        $this->companyId = $companyId;
    }

    public function render()
    {

        $commentsQuery = Comment::with('company');


        if ($this->companyId) {
            $commentsQuery->where('company_id', $this->companyId);
        }

        $comments = $commentsQuery->paginate(5);

        return view('livewire.comment-list', [
            'comments' => $comments
        ]);
    }
}
