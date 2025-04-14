<?php

namespace App\Livewire;

use App\Models\Application;
use App\Models\CV;
use Livewire\Component;

class ApplicationDetail extends Component
{
    public $applicationId;
    public $application;
    public $cv;

    public function mount($applicationId)
    {
        $this->applicationId = $applicationId;
        $this->application = Application::with('job.user')->findOrFail($applicationId);
        $this->cv = CV::where('application_id', $applicationId)->first();
    }

    public function render()
    {
        return view('livewire.application-detail');
    }
}
