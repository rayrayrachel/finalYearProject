<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class CVComponent extends Component
{
    public $profile;
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
        $this->profile = Auth::user()->profile;
        return view('livewire.c-v-component');
    }
}
