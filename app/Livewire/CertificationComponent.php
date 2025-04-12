<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Certification;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class CertificationComponent extends Component
{
    use WithPagination;

    public $languages_spoken;
    public $certifications;
    public $awards;
    public $publications;
    public $presentations;
    public $relevant_activities;
    public $hobbies_and_interests;

    public $editingCertificationId;
    public $editedCertification = [];

    public function mount()
    {
        $this->resetPage();
    }

    public function createCertification()
    {
        $this->validate([
            'languages_spoken' => 'required|string|max:255',
            'certifications' => 'nullable|string|max:255',
            'awards' => 'nullable|string|max:255',
            'publications' => 'nullable|string|max:255',
            'presentations' => 'nullable|string|max:255',
            'relevant_activities' => 'nullable|string|max:255',
            'hobbies_and_interests' => 'nullable|string|max:255',
        ]);

        Certification::create([
            'user_id' => Auth::id(),
            'languages_spoken' => $this->languages_spoken,
            'certifications' => $this->certifications,
            'awards' => $this->awards,
            'publications' => $this->publications,
            'presentations' => $this->presentations,
            'relevant_activities' => $this->relevant_activities,
            'hobbies_and_interests' => $this->hobbies_and_interests,
        ]);

        $this->reset([
            'languages_spoken',
            'certifications',
            'awards',
            'publications',
            'presentations',
            'relevant_activities',
            'hobbies_and_interests'
        ]);
        $this->resetPage();
    }

    public function editCertification($id)
    {
        $certification = Certification::find($id);
        $this->editingCertificationId = $id;
        $this->editedCertification = $certification->toArray();
    }

    public function saveEditedCertification()
    {
        $this->validate([
            'editedCertification.languages_spoken' => 'required|string|max:255',
            'editedCertification.certifications' => 'nullable|string|max:255',
            'editedCertification.awards' => 'nullable|string|max:255',
            'editedCertification.publications' => 'nullable|string|max:255',
            'editedCertification.presentations' => 'nullable|string|max:255',
            'editedCertification.relevant_activities' => 'nullable|string|max:255',
            'editedCertification.hobbies_and_interests' => 'nullable|string|max:255',
        ]);

        $certification = Certification::find($this->editingCertificationId);
        $certification->update($this->editedCertification);

        $this->editingCertificationId = null;
        $this->editedCertification = [];
    }

    public function deleteCertification($id)
    {
        Certification::find($id)->delete();
        $this->resetPage();
    }

    public function render()
    {
        $certs  = Certification::where('user_id', Auth::id())->latest()->paginate(5);
        return view('livewire.certification-component', compact('certs'));
    }
}
