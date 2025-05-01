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
        if (!$this->jobId || !$this->newStatement) {
            session()->flash('error', 'Job or Statement is missing.');
            return;
        }

        $this->dispatch('runCvMatch', cvText: $this->newStatement, jobId: $this->jobId);
    }

    public function checkLSTM()
    {
        if (!$this->newStatement) {
            session()->flash('error', 'Statement input is missing.');
            return;
        }

        $this->dispatch('runStatementCheck', paragraph: $this->newStatement);
    
    }
}
