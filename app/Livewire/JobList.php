<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobPost;

class JobList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $userId;
    public $context;
    public $companyId;  

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    protected $listeners = ['searchClicked' => 'applySearch', 'postClicked' => '$refresh'];

    public function mount($userId = null, $context = null, $companyId = null)
    {
        $this->userId = $userId;
        $this->context = $context;
        $this->companyId = $companyId; 
    }

    public function applySearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function toggleSortDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $jobsQuery = JobPost::query();

        if ($this->companyId) {
            $jobsQuery->where('user_id', $this->companyId);  
        }

        $jobsQuery->when($this->context === 'company-dashboard' && $this->userId, function ($query) {
            $query->where('user_id', $this->userId);
        })
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user.profile', function ($query) {
                        $query->where('user_name', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy($this->sortField, $this->sortDirection);

        $jobs = $jobsQuery->paginate(5);

        return view('livewire.job-list', compact('jobs'));
    }
}
