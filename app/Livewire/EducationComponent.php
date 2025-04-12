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
    public $graduation_date;
    public $grade;
    public $project;

    public $editingEducationId;
    public $editedEducation = [];

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
            'graduation_date' => 'required|date',
            'grade' => 'nullable|string|max:255',
            'project' => 'nullable|string|max:255', 
        ]);

        Education::create([
            'user_id' => Auth::id(),
            'degree' => $this->degree,
            'field_of_study' => $this->field_of_study,
            'university_name' => $this->university_name,
            'graduation_date' => $this->graduation_date,
            'grade' => $this->grade,
            'project' => $this->project,
        ]);

        $this->reset(['degree', 'field_of_study', 'university_name', 'graduation_date', 'grade', 'project']);
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
            'editedEducation.graduation_date' => 'required|date',
            'editedEducation.grade' => 'nullable|string|max:255',
            'editedEducation.project' => 'nullable|string|max:255', 
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
        $educations = Education::where('user_id', Auth::id())->latest()->paginate(5);
        return view('livewire.education-component', compact('educations'));
    }
}
