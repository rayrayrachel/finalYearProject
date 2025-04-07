<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobPost;

class JobDetail extends Component
{
    public $job;

    public function mount(int $jobId)
    {
        $this->job = JobPost::with('user.profile')->findOrFail($jobId);
    }

    public function render()
    {
        return view('livewire.job-detail');
    }
}
