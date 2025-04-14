<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;

class CvPreview extends Component
{
    public $cv;

    public function mount($cvId)
    {
        $this->cv = CV::findOrFail($cvId);
    }

    public function render()
    {
        return view('livewire.cv-preview');
    }
}
