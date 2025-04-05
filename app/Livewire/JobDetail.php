<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobPost;

class JobDetail extends Component
{
    public $job;

    public function mount($jobId)
    {
        $this->job = JobPost::findOrFail($jobId);
    }

    public function render()
    {
        return view('livewire.job-detail');
    }
}
