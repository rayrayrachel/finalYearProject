<?php

namespace App\Livewire;

use App\Models\JobPost;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CvMatcherComponent extends Component
{
    public $jobId;
    public $cvText;

    public $score = null;
    public $matchedImportantKeywords = [];
    public $matchedLessImportantKeywords = [];
    public $missedImportantKeywords = [];
    public $missedLessImportantKeywords = [];

    protected $listeners = ['runCvMatch'];

    public function runCvMatch($cvText, $jobId)
    {
        $this->cvText = $cvText;
        $this->jobId = $jobId;
        $this->checkMatch();
    }

    public function mount($jobId = null)
    {
        $this->jobId = $jobId;
    }

    public function checkMatch()
    {
        $job = JobPost::find($this->jobId);

        if (!$job) {
            session()->flash('error', 'Job not found.');
            return;
        }

        if (!$this->cvText) {
            session()->flash('error', 'Please enter your CV text.');
            return;
        }

        $jobText = $job->description . "\n" . $job->requirements;

        $response = Http::post('http://host.docker.internal:8000/cv-match', [
            'cv_text' => $this->cvText,
            'job_description' => $jobText,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $this->score = $data['score'];
            $this->matchedImportantKeywords = $data['matched_important_keywords'];
            $this->matchedLessImportantKeywords = $data['matched_less_important_keywords'];
            $this->missedImportantKeywords = $data['missed_important_keywords'];
            $this->missedLessImportantKeywords = $data['missed_less_important_keywords'];
        } else {
            session()->flash('error', 'Match check failed.');
        }
    }

    public function render()
    {
        return view('livewire.cv-matcher-component');
    }
}
