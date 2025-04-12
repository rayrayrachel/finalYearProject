<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\PersonalStatement;
use App\Models\ProfessionalExperience;
use Livewire\Component;

class CreateCVPage extends Component
{
    public $profile;

    // Personal Statement
    public bool $showPersonalStatementOptions = false;
    public string $newPersonalStatement = '';
    public ?string $selectedPersonalStatement = null;
    public array $personalStatements = [];
    public $selectedPersonalStatementId = null;

    // Professional Experience
    public bool $showProfessionalExperiences = false;
    public $selectedProfessionalExperienceIds = [];
    public $selectedProfessionalExperiences = [];
    public $professionalExperiences = [];

    protected $listeners = ['itemSelected'];

    public function mount()
    {
        $this->professionalExperiences = ProfessionalExperience::where('user_id', Auth::id())->get();
    }

    public function itemSelected($component, $id)
    {
        if ($component === 'personal_statement') {
            $statement = PersonalStatement::find($id);

            if ($statement && $statement->user_id === Auth::id()) {
                $this->selectedPersonalStatementId = $id;
                $this->selectedPersonalStatement = $statement->statement;
                $this->showPersonalStatementOptions = false;
            }
        }

        if ($component === 'professional-experience') {
            $experience = ProfessionalExperience::find($id);

            if ($experience && $experience->user_id === Auth::id()) {
                if (in_array($id, $this->selectedProfessionalExperienceIds)) {
                    session()->flash('error', 'This experience is already selected.');
                    return;
                }

                if (count($this->selectedProfessionalExperienceIds) < 5) {
                    $this->selectedProfessionalExperienceIds[] = $id;
                    $this->selectedProfessionalExperiences[] = $experience;
                    $this->showProfessionalExperiences = true;
                }
            }
        }
    }

    public function removeSelectedStatement()
    {
        $this->selectedPersonalStatement = null;
        $this->selectedPersonalStatementId = null;
        $this->showPersonalStatementOptions = false;
    }

    public function removeSelectedExperience($experienceId)
    {
        $this->selectedProfessionalExperiences = array_filter($this->selectedProfessionalExperiences, function ($exp) use ($experienceId) {
            return $exp->id !== $experienceId;
        });

        $this->selectedProfessionalExperienceIds = array_filter($this->selectedProfessionalExperienceIds, function ($id) use ($experienceId) {
            return $id !== $experienceId;
        });
    }

    public function render()
    {
        $this->profile = Auth::user()->profile;
        return view('livewire.create-c-v-page');
    }
}
