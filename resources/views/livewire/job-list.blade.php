<div>
    <div class="element-container">

        <div class="search-container">
            <input type="text" placeholder="Search Jobs..." wire:model="search" class="search-input" />
            <button class="search-icon" wire:click="$dispatch('searchClicked')">
                🔍
            </button>
        </div>

    </div>

    <div class="element-container">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        <button wire:click="sortBy('title')">Title</button>
                        @if ($sortField === 'title')
                            <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th>Description</th>
                    <th>
                        <button wire:click="sortBy('salary_range')">Salary</button>
                        @if ($sortField === 'salary_range')
                            <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th>Posted</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($job->description, 200) }}</td>
                        <td>{{ $job->salary_range }}</td>
                        <td>{{ $job->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No jobs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <div class="pagination">
        {{ $jobs->links() }}
    </div>
</div>
