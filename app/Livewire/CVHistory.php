<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CV;
use Illuminate\Support\Facades\Auth;

class CVHistory extends Component
{
    public $cvs;


    public function mount()
    {
        $this->cvs = CV::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();
    }
    public function render()
    {
        return view('livewire.c-v-history');
    }
}
