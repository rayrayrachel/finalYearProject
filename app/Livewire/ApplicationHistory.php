<?php

namespace App\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;


class ApplicationHistory extends Component
{
    public function render()
    {    $applications = Application::with(['job', 'cv']) 
                ->where('user_id', Auth::id())
                ->latest()
                ->paginate(5);
    
        return view('livewire.application-history', [
            'applications' => $applications,
        ]);
    }
}
