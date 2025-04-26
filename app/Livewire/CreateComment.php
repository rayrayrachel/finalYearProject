<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentAddedNotification;

class CreateComment extends Component
{
    public $companyId;
    public $content;

    protected $rules = [
        'content' => 'required|string|max:1000|min:5',
    ];

    public function mount($companyId)
    {
        $this->companyId = $companyId;
    }

    public function submitComment()
    {
        $this->validate();

        Comment::create([
            'hunter_id' => Auth::id(),
            'company_id' => $this->companyId,
            'content' => $this->content,
        ]);

        $company = User::find($this->companyId);
        $companyEmail = $company->email;  
        Mail::to($companyEmail)->send(new CommentAddedNotification($this->content));


        $this->content = '';
        session()->flash('message', 'Your comment has been added!');
        $this->dispatch('commentAdded'); 
    }

    public function render()
    {
        return view('livewire.create-comment');
    }
}
