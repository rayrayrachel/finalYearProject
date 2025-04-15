<?php

namespace App\Livewire;

use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use App\Models\CV;

use Livewire\Component;

class ApplicationPage extends Component
{
    public $jobId;
    public $job;
    public $cvid = null;
    public $cvChosen = false;

    protected $listeners = ['cvSelected', 'CVTailored'];

    public function mount($jobId)
    {
        $this->jobId = $jobId;
        $this->job = JobPost::findOrFail($jobId);
    }
    public function cvSelected($data)
    {
        if ($data['component'] === 'cv') {
            $this->cvid = $data['id'];
            $this->cvChosen = true;
        }
    }

    public function CVTailored()
    {
        $latestCV = CV::where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($latestCV) {
            $this->cvid = $latestCV->id;
            $this->cvChosen = true;
        }
    }

    public function removeSelectedCV()
    {
        $this->cvid = null;
        $this->cvChosen = false;
    }

    public function render()
    {
        return view('livewire.application-page');
    }
}
