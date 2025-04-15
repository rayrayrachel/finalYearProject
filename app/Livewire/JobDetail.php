<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JobPost;

class JobDetail extends Component
{
    public $job;
    public $fromJobDetail = false;

    public function mount(int $jobId ,$from = null)
    {
        $this->job = JobPost::with('user.profile')->findOrFail($jobId);
        $this->fromJobDetail = $from === 'jobDetailPage';

    }

    public function render()
    {
        return view('livewire.job-detail');
    }
}
