<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProfessionalExperience;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class ProfessionalExperienceComponent extends Component
{
    use WithPagination;

    public bool $creatingCV = false;
    public $selectedProfessionalExperience;
    public $selectedExperienceId;  

    public $job_title;
    public $company_name;
    public $location;
    public $start_date;
    public $end_date;
    public $key_achievements;
    public $quantifiable_results;

    public $editingExperienceId;
    public $editedExperience = [];

    public function mount()
    {
        $this->resetPage();
    }

    public function createExperience()
    {
        $this->validate([
            'job_title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'key_achievements' => 'nullable|string',
            'quantifiable_results' => 'nullable|string',
        ]);

        ProfessionalExperience::create([
            'user_id' => Auth::id(),
            'job_title' => $this->job_title,
            'company_name' => $this->company_name,
            'location' => $this->location,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'key_achievements' => $this->key_achievements,
            'quantifiable_results' => $this->quantifiable_results,
        ]);

        $this->reset(['job_title', 'company_name', 'location', 'start_date', 'end_date', 'key_achievements', 'quantifiable_results']);
        $this->resetPage();
    }

    public function editExperience($id)
    {
        $experience = ProfessionalExperience::find($id);
        $this->editingExperienceId = $id;
        $this->editedExperience = $experience->toArray();
    }

    public function saveEditedExperience()
    {
        $this->validate([
            'editedExperience.job_title' => 'required|string|max:255',
            'editedExperience.company_name' => 'required|string|max:255',
            'editedExperience.location' => 'required|string|max:255',
            'editedExperience.start_date' => 'required|date',
            'editedExperience.end_date' => 'nullable|date',
            'editedExperience.key_achievements' => 'nullable|string',
            'editedExperience.quantifiable_results' => 'nullable|string',
        ]);

        $experience = ProfessionalExperience::find($this->editingExperienceId);
        $experience->update($this->editedExperience);

        $this->editingExperienceId = null;
        $this->editedExperience = [];
    }

    public function deleteExperience($id)
    {
        ProfessionalExperience::find($id)->delete();
        $this->resetPage();
    }

    public function render()
    {
        $experiences = ProfessionalExperience::where('user_id', Auth::id())->latest()->paginate(3);
        return view('livewire.professional-experience-component', compact('experiences'));
    }

    public function select($id)
    {
        $this->selectedExperienceId = $id;  
        $this->dispatch('itemSelected', component: 'professional-experience', id: $id);
    }
}
