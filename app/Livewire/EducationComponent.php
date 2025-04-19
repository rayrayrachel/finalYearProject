<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Education;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class EducationComponent extends Component
{
    use WithPagination;


    public $degree;
    public $field_of_study;
    public $university_name;
    public $start_date;
    public $graduation_date;
    public $grade;
    public $project;

    public $editingEducationId;
    public $editedEducation = [];


    //Create CV
    public bool $creatingCV = false;
    public $selectedEducation;
    public $selectedEducationId;

    public function mount()
    {
        $this->resetPage();
    }

    public function createEducation()
    {
        $this->validate([
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'graduation_date' => 'required|date',
            'grade' => 'nullable|string|max:255',
            'project' => 'nullable|string|max:1000', 
        ]);

        Education::create([
            'user_id' => Auth::id(),
            'degree' => $this->degree,
            'field_of_study' => $this->field_of_study,
            'university_name' => $this->university_name,
            'graduation_date' => $this->graduation_date,
            'start_date' => $this->start_date,
            'grade' => $this->grade,
            'project' => $this->project,
        ]);

        $this->reset(['degree', 'field_of_study', 'university_name', 'start_date', 'grade', 'project']);
        $this->resetPage();
    }

    public function editEducation($id)
    {
        $education = Education::find($id);
        $this->editingEducationId = $id;
        $this->editedEducation = $education->toArray();
    }

    public function saveEditedEducation()
    {
        $this->validate([
            'editedEducation.degree' => 'required|string|max:255',
            'editedEducation.field_of_study' => 'required|string|max:255',
            'editedEducation.university_name' => 'required|string|max:255',
            'editedEducation.start_date' => 'required|date',
            'editedEducation.graduation_date' => 'required|date',
            'editedEducation.grade' => 'nullable|string|max:255',
            'editedEducation.project' => 'nullable|string|max:1000', 
        ]);

        $education = Education::find($this->editingEducationId);
        $education->update($this->editedEducation);

        $this->editingEducationId = null;
        $this->editedEducation = [];
    }

    public function deleteEducation($id)
    {
        Education::find($id)->delete();
        $this->resetPage();
    }

    public function render()
    {
        $educations = Education::where('user_id', Auth::id())->latest()->paginate(3);
        return view('livewire.education-component', compact('educations'));
    }

    public function select($id)
    {
        $this->selectedEducationId = $id;
        $this->dispatch('itemSelected', component: 'education', id: $id);
    }
}
