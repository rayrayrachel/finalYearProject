<div>
    <div class="element-container">
        <div class="search-container  bg-blue-100">
            <input type="text" placeholder="Search Jobs..." wire:model="search" class="search-input  bg-blue-100" />
            <button class="search-icon" wire:click="$dispatch('searchClicked')">
                🔍
            </button>

            <select wire:model="sortField" class="sort-dropdown">
                <option value="title">Title</option>
                <option value="salary_range">Salary</option>
                <option value="created_at">Date</option>
            </select>

            <button class="sort-direction-btn" wire:click="toggleSortDirection">
                {{ $sortDirection === 'asc' ? '⬆️' : '⬇️' }}
            </button>
        </div>
    </div>

    <div class="element-container">
        @forelse ($jobs as $job)
            <a href="{{ route('job-detail', ['jobId' => $job->id]) }}" wire:navigate>

                <div class="job-card ">
                    <div class="job-content flex">
                        <div class="profile-picture-container">
                            @if ($job->user->profile->profile_picture)
                                <img src="{{ asset('storage/' . $job->user->profile->profile_picture) }}"
                                    alt="Company Logo of {{ $job->user->profile->user_name }}" class="profile-picture">
                            @else
                                <img src="{{ asset('images/Tree.png') }}" alt="Default Company Logo"
                                    class="profile-picture">
                            @endif
                        </div>

                        <div class="job-list-text-container">
                            <h3 class="job-title">
                                {{ $job->title }}
                                @if ($job->user->profile)
                                    <span class="company-name"> - {{ $job->user->profile->user_name }}</span>
                                @else
                                    <span class="company-name"> - Unknown Company</span>
                                @endif
                            </h3>
                            <p class="job-salary">Salary: {{ $job->salary_range ?? 'Not Specified' }}</p>
                            <p class="job-description">{{ \Illuminate\Support\Str::limit($job->description, 200) }}</p>
                            <p><em class="text-gray-500">Posted on {{ $job->created_at->diffForHumans() }}</em></p>

                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center">
                No jobs found.
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $jobs->links() }}
    </div>
</div>
