<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PersonalStatement; 
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PersonalStatementComponent extends Component
{
    use WithPagination;

    public $newStatement;       
    public $editingStatementId;  
    public $editedStatement;

    public function mount()
    {
        $this->resetPage(); 
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
}
