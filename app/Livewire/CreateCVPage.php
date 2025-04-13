<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\PersonalStatement;
use App\Models\ProfessionalExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;

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

    // Professional Experiences
    public bool $showProfessionalExperiences = false;
    public $selectedProfessionalExperienceIds = [];
    public $selectedProfessionalExperiences = [];
    public $professionalExperiences = [];

    // Educations
    public bool $showEducations = false;
    public $selectedEducationIds = [];
    public $selectedEducations = [];
    public $educations = [];

    //Skills
    public bool $showSkills = false;
    public $selectedSkillIds = [];
    public $selectedSkills = [];
    public $skills = [];

    // Certification
    public bool $showCertificationOptions = false;
    public string $newCertification = '';
    public ?string $selectedCertification = null;
    public array $certifications = [];
    public $selectedCertificationId = null;

    //Errors
    public $addSelectedExperienceError;
    public $addSelectedEducationError;
    public $addSelectedSkillError;



    protected $listeners = ['itemSelected'];

    public function mount()
    {
        $this->professionalExperiences = ProfessionalExperience::where('user_id', Auth::id())->get();
        $this->educations = Education::where('user_id', Auth::id())->get();
        $this->skills = Skill::where('user_id', Auth::id())->get();
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
                    $this->addSelectedExperienceError = 'This education is already selected.';
                    return;
                }

                if (count($this->selectedProfessionalExperienceIds) < 5) {
                    $this->selectedProfessionalExperienceIds[] = $id;
                    $this->selectedProfessionalExperiences[] = $experience;
                }
            }
        }

        if ($component === 'education') {
            $education = Education::find($id);

            if ($education && $education->user_id === Auth::id()) {
                if (in_array($id, $this->selectedEducationIds)) {
                    $this->addSelectedEducationError = 'This education is already selected.';
                    return;
                }

                if (count($this->selectedEducationIds) < 5) {
                    $this->selectedEducationIds[] = $id;
                    $this->selectedEducations[] = $education;
                }
            }
        }

        if ($component === 'skill') {
            $skill = Skill::find($id);

            if ($skill && $skill->user_id === Auth::id()) {
                if (in_array($id, $this->selectedSkillIds)) {
                    $this->addSelectedSkillError = 'This skill is already selected.';

                    return;
                }

                if (count($this->selectedSkillIds) < 5) {
                    $this->selectedSkillIds[] = $id;
                    $this->selectedSkills[] = $skill;
                    $this->showSkills = true;
                }
            }
        }

        if ($component === 'certification') {
            $certification = Certification::find($id);

            if ($certification && $certification->user_id === Auth::id()) {
                $this->selectedCertificationId = $id;
                $this->selectedCertification = $certification;
                $this->showCertificationOptions = false;
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

        $this->selectedProfessionalExperiences = array_values($this->selectedProfessionalExperiences);
        $this->selectedProfessionalExperienceIds = array_values($this->selectedProfessionalExperienceIds);
    }
    public function removeSelectedEducation($educationId)
    {
        $this->selectedEducations = array_filter($this->selectedEducations, function ($edu) use ($educationId) {
            return $edu->id !== $educationId;
        });

        $this->selectedEducationIds = array_filter($this->selectedEducationIds, function ($id) use ($educationId) {
            return $id !== $educationId;
        });

        $this->selectedEducations = array_values($this->selectedEducations);
        $this->selectedEducationIds = array_values($this->selectedEducationIds);
    }

    public function removeSelectedCertification()
    {
        $this->selectedCertification = null;
        $this->selectedCertificationId = null;
        $this->showCertificationOptions = false;
    }
    public function removeSelectedSkill($skillId)
    {
        $this->selectedSkills = array_filter($this->selectedSkills, function ($skill) use ($skillId) {
            return $skill->id !== $skillId;
        });

        $this->selectedSkillIds = array_filter($this->selectedSkillIds, function ($id) use ($skillId) {
            return $id !== $skillId;
        });

        $this->selectedSkills = array_values($this->selectedSkills);
        $this->selectedSkillIds = array_values($this->selectedSkillIds);
    }


    public function render()
    {
        $this->profile = Auth::user()->profile;
        return view('livewire.create-c-v-page');
    }
}
