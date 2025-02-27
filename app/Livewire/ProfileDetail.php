<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Profile;

class ProfileDetail extends Component
{
    public $profileID;
    public $profile;

    public function mount($userId = null)
    {
        $this->profileID = $userId;

        if (!$this->profileID) {
            return redirect()->route('dashboard'); 
        }

        $this->loadProfileData();
    }

    public function loadProfileData()
    {
        $this->profile = Profile::where('user_id', $this->profileID)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.profile-detail');
    }
}
