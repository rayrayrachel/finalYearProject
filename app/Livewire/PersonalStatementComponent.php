<?php

namespace App\Livewire;

use App\Models\JobPost;
use Livewire\Component;
use App\Models\PersonalStatement;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;

class PersonalStatementComponent extends Component
{
    use WithPagination;

    public $newStatement;
    public $editingStatementId;
    public $editedStatement;
    public $jobId;

    // Create CV
    public $selectedPersonalStatementId;
    public $creatingCV = false;

    public $score = null;
    public $matchedKeywords = [];
    public $totalKeywords = [];

    public function mount($jobId = null, $creatingCV = false)
    {
        $this->creatingCV = $creatingCV;

        $this->resetPage();
        $this->jobId = $jobId;
    }

    public function createPersonalStatement()
    {
        $this->validate([
            'newStatement' => 'required|string|max:1000',
        ]);

        PersonalStatement::create([
            'statement' => $this->newStatement,
            'user_id' => Auth::id(),
        ]);

        $this->newStatement = '';
        $this->resetPage();
    }

    public function editPersonalStatement($id)
    {
        $statement = PersonalStatement::find($id);
        $this->editingStatementId = $id;
        $this->editedStatement = $statement->statement;
    }

    public function saveEditedPersonalStatement()
    {
        $this->validate([
            'editedStatement' => 'required|string|max:1000',
        ]);

        $statement = PersonalStatement::find($this->editingStatementId);
        $statement->update([
            'statement' => $this->editedStatement,
        ]);

        $this->editedStatement = '';
        $this->editingStatementId = null;
    }

    public function deletePersonalStatement($id)
    {
        PersonalStatement::find($id)->delete();
        $this->resetPage();
    }

    public function render()
    {
        $personalStatements = PersonalStatement::where('user_id', Auth::id())->latest()->paginate(5);
        return view('livewire.personal-statement-component', compact('personalStatements'));
    }

    public function select($id)
    {
        $this->selectedPersonalStatementId = $id;
        $this->dispatch('itemSelected', component: 'personal_statement', id: $id);
    }

    public function checkPersonalStatementMatch()
    {
        // Get job description from the database based on jobId
        $job = JobPost::find($this->jobId);
        if (!$job) {
            session()->flash('error', 'Job not found.');
            return;
        }
        $jobText = $job->description . "\n" . $job->requirements;

        // Make a request to the FastAPI endpoint using host.docker.internal
        $response = Http::post('http://host.docker.internal:8000/cv-match', [
            'cv_text' => $this->newStatement,
            'job_description' => $jobText,
        ]);

        // Check if the response was successful
        if ($response->successful()) {
            $responseData = $response->json();
            $this->score = $responseData['score'];
            $this->matchedKeywords = $responseData['matched_keywords'];
            $this->totalKeywords = $responseData['total_keywords'];
        } else {
            session()->flash('error', 'Failed to check the match.');
        }
    }
}
