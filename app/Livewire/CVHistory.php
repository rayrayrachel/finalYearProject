<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; 
use App\Models\CV;
use Illuminate\Support\Facades\Auth;

class CVHistory extends Component
{
    use WithPagination;  

    public function render()
    {
        $cvs = CV::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(5);

        return view('livewire.c-v-history', compact('cvs'));
    }

    public function deleteCV($cvId)
    {
        $cv = CV::find($cvId);

        if ($cv && $cv->user_id === Auth::id()) {
            $cv->delete();
            session()->flash('message', 'CV deleted successfully!');
        } else {
            session()->flash('message', 'CV not found or you do not have permission to delete this.');
        }

        $this->render();
    }
}
