<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;

class CvPreview extends Component
{
    public $cv;
    public bool $printable = true;
    protected $listeners = ['cvSelected' => '$refresh'];

    public function mount($cvId, $printable = true)
    {
        $this->cv = CV::findOrFail($cvId);
        $this->printable = $printable;
    }

    public function render()
    {
        return view('livewire.cv-preview');
    }
}
