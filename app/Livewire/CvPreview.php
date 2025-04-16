<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class CvPreview extends Component
{
    public $cv;
    public bool $printable = true;

    public $application;
    public $applicationId;

    public bool $canViewContactInfo = false;

    protected $listeners = ['cvSelected' => 'refreshData', 'updatedStatus' => 'refreshData'];

    public function mount($cvId, $printable = true)
    {
        $this->cv = CV::with('application.job.user')->findOrFail($cvId);
        $this->printable = $printable;
        $this->applicationId = $this->cv->application_id;

        if ($this->applicationId) {
            $this->application = Application::with('job.user')->findOrFail($this->applicationId);
        }

        $this->determineContactVisibility();
    }

    public function refreshData()
    {
        if ($this->applicationId) {
            $this->application = Application::with('job.user')->findOrFail($this->applicationId);
        }

        $this->determineContactVisibility();
    }

    public function determineContactVisibility()
    {
        $this->canViewContactInfo = false;

        if ($this->applicationId) {
            if (
                Auth::id() === $this->application->user_id ||
                (Auth::id() === $this->application->job->user_id && $this->application->status === 'accepted')
            ) {
                $this->canViewContactInfo = true;
            }
        } else {
            if (Auth::id() === $this->cv->user_id) {
                $this->canViewContactInfo = true;
            }
        }
    }

    public function render()
    {
        return view('livewire.cv-preview');
    }
}
