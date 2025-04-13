<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class SkillComponent extends Component
{
    use WithPagination;

    public $newSkill;
    public $editingSkillId;
    public $editedSkill;

    //Create CV
    public bool $creatingCV = false;
    public $selectedSkillId;
    public $selectedSkill;


    public function mount($creatingCV = false)
    {
        $this->creatingCV = $creatingCV;
        $this->resetPage();
    }

    public function createSkill()
    {
        $this->validate([
            'newSkill' => 'required|string|max:255', 
        ]);

        Skill::create([
            'skills' => $this->newSkill,
            'user_id' => Auth::id(),
        ]);

        $this->newSkill = '';
        $this->resetPage();
    }

    public function editSkill($id)
    {
        $skill = Skill::find($id);
        $this->editingSkillId = $id;
        $this->editedSkill = $skill->skills;
    }

    public function saveEditedSkill()
    {
        $this->validate([
            'editedSkill' => 'required|string|max:255',
        ]);

        $skill = Skill::find($this->editingSkillId);
        $skill->update([
            'skills' => $this->editedSkill,
        ]);

        $this->editedSkill = '';
        $this->editingSkillId = null;
    }

    public function deleteSkill($id)
    {
        Skill::find($id)->delete();
        $this->resetPage();
    }

    public function render()
    {
        $skills = Skill::where('user_id', Auth::id())->latest()->paginate(5);
        return view('livewire.skill-component', compact('skills'));
    }

    public function select($id)
    {
        $this->selectedSkillId = $id;
        $this->dispatch('itemSelected', component: 'skill', id: $id);
    }
}
