<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\JobPost;

class ReceivedApplications extends Component
{
    use WithPagination;

    public $jobId = null;
    public $job = null;
    public $isOwner = false;

    public function mount($jobId = null)
    {
        $this->jobId = $jobId;

        $this->job = JobPost::with('user')->find($jobId);

        if ($this->job && Auth::check()) {
            $this->isOwner = $this->job->user_id === Auth::id();
        }
    }

    public function render()
    {
        $applications = collect(); 

        if ($this->isOwner) {
            $applications = Application::with(['job.user', 'user.profile'])
                ->whereHas('job', function ($q) {
                    $q->where('user_id', Auth::id());

                    if ($this->jobId) {
                        $q->where('id', $this->jobId);
                    }
                })
                ->orderByDesc('created_at')
                ->paginate(10);
        }

        return view('livewire.received-applications', [
            'job' => $this->job,
            'applications' => $applications,
            'isOwner' => $this->isOwner
        ]);
    }
}
