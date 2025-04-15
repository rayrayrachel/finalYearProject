<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\PersonalStatement;
use App\Models\ProfessionalExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\CV;
use Livewire\Component;

class CreateCVPage extends Component
{
    public $createApplication;
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

    // Skills
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

    // Errors
    public $addSelectedExperienceError;
    public $addSelectedEducationError;
    public $addSelectedSkillError;

    protected $listeners = ['itemSelected'];

    public function mount($createApplication = false)
    {
        $this->createApplication = $createApplication;
        $this->professionalExperiences = ProfessionalExperience::where('user_id', Auth::id())->get();
        $this->educations = Education::where('user_id', Auth::id())->get();
        $this->skills = Skill::where('user_id', Auth::id())->get();
    }
    public function toggleSection($section)
    {
        $currentlyOpen = [
            'personal_statement' => $this->showPersonalStatementOptions,
            'professional_experience' => $this->showProfessionalExperiences,
            'education' => $this->showEducations,
            'skill' => $this->showSkills,
            'certification' => $this->showCertificationOptions,
        ];

        // Close all sections
        $this->showPersonalStatementOptions = false;
        $this->showProfessionalExperiences = false;
        $this->showEducations = false;
        $this->showSkills = false;
        $this->showCertificationOptions = false;

        // Reopen the clicked one if it wasn't already open
        if (!$currentlyOpen[$section]) {
            switch ($section) {
                case 'personal_statement':
                    $this->showPersonalStatementOptions = true;
                    break;
                case 'professional_experience':
                    $this->showProfessionalExperiences = true;
                    break;
                case 'education':
                    $this->showEducations = true;
                    break;
                case 'skill':
                    $this->showSkills = true;
                    break;
                case 'certification':
                    $this->showCertificationOptions = true;
                    break;
            }
        }
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
                    $this->addSelectedExperienceError = 'This professional experience is already selected.';
                    $this->showProfessionalExperiences = false;
                    return;
                }

                if (count($this->selectedProfessionalExperienceIds) < 5) {
                    $this->selectedProfessionalExperienceIds[] = $id;
                    $this->selectedProfessionalExperiences[] = $experience;
                    $this->showProfessionalExperiences = false;
                    $this->addSelectedExperienceError = null;
                }
            }
        }

        if ($component === 'education') {
            $education = Education::find($id);
            if ($education && $education->user_id === Auth::id()) {
                if (in_array($id, $this->selectedEducationIds)) {
                    $this->addSelectedEducationError = 'This education is already selected.';
                    $this->showEducations = false;
                    return;
                }

                if (count($this->selectedEducationIds) < 5) {
                    $this->selectedEducationIds[] = $id;
                    $this->selectedEducations[] = $education;
                    $this->showEducations = false;
                    $this->addSelectedEducationError = null;
                }
            }
        }

        if ($component === 'skill') {
            $skill = Skill::find($id);
            if ($skill && $skill->user_id === Auth::id()) {
                if (in_array($id, $this->selectedSkillIds)) {
                    $this->addSelectedSkillError = 'This skill is already selected.';
                    $this->showSkills = false;
                    return;
                }

                if (count($this->selectedSkillIds) < 5) {
                    $this->selectedSkillIds[] = $id;
                    $this->selectedSkills[] = $skill;
                    $this->showSkills = false;
                    $this->addSelectedSkillError = null;
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
        $this->selectedProfessionalExperiences = array_filter($this->selectedProfessionalExperiences, fn($exp) => $exp->id !== $experienceId);
        $this->selectedProfessionalExperienceIds = array_filter($this->selectedProfessionalExperienceIds, fn($id) => $id !== $experienceId);
        $this->selectedProfessionalExperiences = array_values($this->selectedProfessionalExperiences);
        $this->selectedProfessionalExperienceIds = array_values($this->selectedProfessionalExperienceIds);
    }

    public function removeSelectedEducation($educationId)
    {
        $this->selectedEducations = array_filter($this->selectedEducations, fn($edu) => $edu->id !== $educationId);
        $this->selectedEducationIds = array_filter($this->selectedEducationIds, fn($id) => $id !== $educationId);
        $this->selectedEducations = array_values($this->selectedEducations);
        $this->selectedEducationIds = array_values($this->selectedEducationIds);
    }

    public function removeSelectedSkill($skillId)
    {
        $this->selectedSkills = array_filter($this->selectedSkills, fn($skill) => $skill->id !== $skillId);
        $this->selectedSkillIds = array_filter($this->selectedSkillIds, fn($id) => $id !== $skillId);
        $this->selectedSkills = array_values($this->selectedSkills);
        $this->selectedSkillIds = array_values($this->selectedSkillIds);
    }

    public function removeSelectedCertification()
    {
        $this->selectedCertification = null;
        $this->selectedCertificationId = null;
        $this->showCertificationOptions = false;
    }


    public function createCV()
    {
        $this->validate([
            'selectedPersonalStatementId' => 'nullable|exists:personal_statements,id',
            'selectedProfessionalExperienceIds' => 'array|max:5',
            'selectedEducationIds' => 'array|max:5',
            'selectedSkillIds' => 'array|max:5',
            'selectedCertificationId' => 'nullable|exists:certifications,id',
        ]);


        $user = Auth::user();

        // Fetch data

        $selectedExperiences = ProfessionalExperience::whereIn('id', $this->selectedProfessionalExperienceIds)
            ->where('user_id', $user->id)
            ->get();

        $experiencesData = $selectedExperiences->map(function ($experience) {
            return [
                'job_title' => $experience->job_title,
                'company_name' => $experience->company_name,
                'location' => $experience->location,
                'start_date' => $experience->start_date,
                'end_date' => $experience->end_date ?? 'Present',
                'key_achievements' => $experience->key_achievements,
                'quantifiable_results' => $experience->quantifiable_results,
            ];
        });

        $selectedEducations = Education::whereIn('id', $this->selectedEducationIds)
            ->where('user_id', $user->id)
            ->get();

        $educationsData = $selectedEducations->map(function ($education) {
            return [
                'degree' => $education->degree,
                'field_of_study' => $education->field_of_study,
                'university_name' => $education->university_name,
                'start_date' => $education->start_date,
                'graduation_date' => $education->graduation_date,
                'grade' => $education->grade,
                'project' => $education->project,
            ];
        });

        $selectedSkills = Skill::whereIn('id', $this->selectedSkillIds)
            ->where('user_id', $user->id)
            ->get();

        $skillsData = $selectedSkills->map(function ($skill) {
            return [
                'skills' => $skill->skills,
            ];
        });

        $selectedCertification = Certification::find($this->selectedCertificationId);

        $certificationData = $selectedCertification ? [
            'languages_spoken' => $selectedCertification->languages_spoken,
            'certifications' => $selectedCertification->certifications,
            'awards' => $selectedCertification->awards,
            'publications' => $selectedCertification->publications,
            'presentations' => $selectedCertification->presentations,
            'relevant_activities' => $selectedCertification->relevant_activities,
            'hobbies_and_interests' => $selectedCertification->hobbies_and_interests,
        ] : null;

        // Store CV 
        CV::create([
            'user_id' => $user->id,
            'contact_information' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->profile->phone_number ?? 'Not Provided',
                'location' => $user->profile->location ?? 'Not Provided',
                'date_of_birth' => $user->profile->date_of_birth ?? 'Not Provided',
            ],
            'personal_statement' => $this->selectedPersonalStatement
                ? ['statement' => $this->selectedPersonalStatement]
                :  [],
            'professional_experiences' => $experiencesData ?:  [],
            'educations' => $educationsData ?:  [],
            'skills' => $skillsData ?:  [],
            'certifications' => $certificationData ?:  [],
        ]);

        if ($this->createApplication) {
            $this->dispatch("CVTailored");
        } else {
            return redirect()->route('c-v-history');
        }
    }

    public function render()
    {
        $this->profile = Auth::user()->profile;
        return view('livewire.create-c-v-page');
    }
}
