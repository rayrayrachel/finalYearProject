<?php

namespace App\Livewire;

use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use App\Models\CV;
use App\Models\Application;

use Livewire\Component;

class ApplicationPage extends Component
{
    public $jobId;
    public $job;
    public $cvid = null;
    public $cvChosen = false;
    public $coverLetter = '';
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

    public function submitApplication()
    {
        if (!$this->cvid) {
            session()->flash('error', 'Please select a CV.');
            return;
        }

        $cv = CV::findOrFail($this->cvid);

        $application = Application::create([
            'job_id' => $this->jobId,
            'user_id' => Auth::id(),
            'cover_letter' => $this->coverLetter,
            'status' => 'pending', 
        ]);

        $application->save();
        $newCv = $cv->replicate();

        $newCv->application_id = $application->id; 
        $newCv->save();

        session()->flash('success', 'Your application has been submitted.');
        return redirect()->route('job-detail', ['jobId' => $this->jobId]);
    }


    public function render()
    {
        return view('livewire.application-page');
    }
}
