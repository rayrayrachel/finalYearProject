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

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->application = Application::with('job.user')->findOrFail($applicationId);

        if (Auth::id() !== $this->application->job->user_id) {
            abort(403, "You are not authorized to view this application.");
        }

        $this->cv = CV::where('application_id', $applicationId)->first();
        $this->newStatus = $this->application->status;
    }

    public function updateStatus()
    {
        if ($this->application->status === 'pending' && in_array($this->newStatus, ['accepted', 'rejected'])) {
            $this->application->status = $this->newStatus;
            $this->application->save();
        }
    }

    public function render()
    {
        return view('livewire.application-detail');
    }
}
