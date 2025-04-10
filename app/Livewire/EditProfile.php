<?php

namespace App\Livewire;

use Livewire\WithFileUploads;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class EditProfile extends Component
{
    use WithFileUploads;

    public $bio;
    public $website;
    public $profile_picture;
    public $location;
    public $phone_number;
    public $date_of_birth;
    public $isCompany;

    protected $rules = [
        'bio' => 'nullable|string',
        'website' => 'nullable|url',
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'phone_number'=> 'nullable|string',
        'location' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
    ];

    public function mount()
    {
        $profile = Auth::user()->profile;
        $this->bio = $profile->bio;
        $this->website = $profile->website;
        $this->profile_picture = $profile->profile_picture;
        $this->location = $profile->location;
        $this->phone_number = $profile->phone_number;
        $this->date_of_birth = $profile->date_of_birth;
        $this->isCompany = $profile->is_company;
    }

    public function updateProfile()
    {

        // logger('updateProfile method was called');
        $this->validate();

        $profile = Auth::user()->profile;

        if ($this->profile_picture && is_object($this->profile_picture)) {
            // Delete pfp in public storage
            if ($profile->profile_picture && Storage::disk('public')->exists($profile->profile_picture)) {
                Storage::disk('public')->delete($profile->profile_picture);
            }

            $profile_picture_path = $this->profile_picture->store('profile_pictures', 'public');
            $this->profile_picture = $profile_picture_path;
        }

        $profile->update([
            'bio' => $this->bio,
            'website' => $this->website,
            'profile_picture' => $this->profile_picture ?? $profile->profile_picture,
            'location' => $this->location,
            'phone_number' => $this->phone_number,
            'date_of_birth' => $this->date_of_birth,
        ]);

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.edit-profile');
    }
}
