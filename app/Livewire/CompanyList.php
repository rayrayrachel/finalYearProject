<?php

namespace App\Livewire;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyList extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search'];

    protected $listeners = ['searchClicked' => 'applySearch'];


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $companies = Profile::where('is_company', true)
            ->when($this->search, function ($query) {
                $query->where('user_name', 'like', '%' . $this->search . '%')
                    ->orWhere('bio', 'like', '%' . $this->search . '%')
                    ->orWhere('location', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.company-list', ['companies' => $companies]);
    }
}
