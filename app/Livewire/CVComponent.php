<?php

namespace App\Livewire;

use Livewire\Component;

class CVComponent extends Component
{
    public $sections = [
        'contact_information' => false,
        'personal_statement' => false,
        'professional_experience' => false,
        'education' => false,
        'skills' => false,
        'certifications' => false,
    ];

    public function toggleSection($section)
    {
        $this->sections[$section] = !$this->sections[$section];
    }
    
    public function render()
    {
        return view('livewire.c-v-component');
    }
}
