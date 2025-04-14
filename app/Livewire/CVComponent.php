<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CVComponent extends Component
{
    public $profile;
    public $showContactInformation = false;
    public $showPersonalStatementOptions = false;
    public $showProfessionalExperiences = false;
    public $showEducations = false;
    public $showSkills = false;
    public $showCertificationOptions = false;

    public function toggleSection($section)
    {
        $currentlyOpen = [
            'contact_information'=>$this->showContactInformation,
            'personal_statement' => $this->showPersonalStatementOptions,
            'professional_experience' => $this->showProfessionalExperiences,
            'education' => $this->showEducations,
            'skill' => $this->showSkills,
            'certification' => $this->showCertificationOptions,
        ];

        $this->showContactInformation=false;
        $this->showPersonalStatementOptions = false;
        $this->showProfessionalExperiences = false;
        $this->showEducations = false;
        $this->showSkills = false;
        $this->showCertificationOptions = false;

        if (!$currentlyOpen[$section]) {
            switch ($section) {
                case 'contact_information':
                    $this->showContactInformation = true;
                    break;
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

    public function render()
    {
        $this->profile = Auth::user()->profile;
        return view('livewire.c-v-component');
    }
}
