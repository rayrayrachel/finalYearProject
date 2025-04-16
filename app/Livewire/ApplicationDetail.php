<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\CV;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ApplicationDetail extends Component
{
    public $applicationId;
    public $application;
    public $cv;
    public $newStatus;
    public $isOwner;

    public $listeners = ['updatedStatus' => '$refresh'];

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->application = Application::with('job.user')->findOrFail($applicationId);

        if (Auth::id() !== $this->application->user_id && Auth::id() !== $this->application->job->user_id) {
            abort(403, "You are not authorized to view this application.");
        }
        if (Auth::id() !== $this->application->job->user_id) {
            $this->isOwner = false;
        }
        if (Auth::id() == $this->application->job->user_id) {
            $this->isOwner = true;
        }

        $this->cv = CV::where('application_id', $applicationId)->first();
        $this->newStatus = $this->application->status;
    }

    public function updateStatus(): void
    {
        if (!$this->isOwner) {
            abort(403);
        }

        $this->validate([
            'newStatus' => 'required|in:accepted,rejected',
        ]);

        $this->application->status = $this->newStatus;
        $this->application->save();

        session()->flash('message', 'Application status updated successfully.');
        $this->dispatch("updatedStatus");
    }

    public function accept()
    {
        $this->newStatus = 'accepted';
        $this->updateStatus();
    }

    public function reject()
    {
        $this->newStatus = 'rejected';
        $this->updateStatus();
    }

    public function render()
    {
        return view('livewire.application-detail');
    }
}
