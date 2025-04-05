<?php



namespace App\Livewire;

use Livewire\Component;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileDetail extends Component
{
    public $profileID;
    public $profile;

    public function mount($profileId = null)
    {
        $this->profileID = $profileId ?? Auth::id();
        // dd('Passed Profile ID:', $this->profileID);

        $this->loadProfileData();
    }

    public function loadProfileData()
    {
        $this->profile = Profile::findOrFail($this->profileID);

        if (Auth::check() && !($this->profile->user_id === Auth::id() || $this->profile->is_company)) {
            abort(403, 'Forbidden'); 
        }
    }

    public function render()
    {
        return view('livewire.profile-detail');
    }
}
