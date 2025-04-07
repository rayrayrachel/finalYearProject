<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobPost;
use App\Models\Comment;

class CompanyStats extends Component
{
    public $companyId;
    public $jobCount;
    public $commentCount;

    protected $listeners = [
        'refreshStats' => 'refreshStats',
        'commentAdded' => 'refreshStats',
        'refreshCommentList' => 'refreshStats',
    ];

    public function mount($companyId)
    {
        $this->companyId = $companyId;
        $this->refreshStats();
    }

    public function refreshStats()
    {
        $this->jobCount = JobPost::where('user_id', $this->companyId)->count();
        $this->commentCount = Comment::where('company_id', $this->companyId)->count();
        $this->dispatch('toggleStatJobList');
    }

    public function toggleJobList()
    {
        $this->dispatch('toggleStatJobList');
    }

    public function toggleCommentList()
    {
        $this->dispatch('toggleStatCommentList');
    }

    public function render()
    {
        return view('livewire.company-stats');
    }
}
