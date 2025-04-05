<div>
    <div class="element-container">
        <div class="search-container bg-blue-100">
            <input type="text" placeholder="Search Companies..." wire:model="search" class="search-input bg-blue-100" />
            <button class="search-icon" wire:click="$dispatch('searchClicked')">
                🔍
            </button>
        </div>
    </div>

    <div class="element-container">
        @forelse ($companies as $company)
            <a href="{{ route('profile.detail', ['profileId' => $company->id]) }}">

                <div class="company-card">
                    <div class="company-content flex">
                        <div class="profile-picture-container">
                            @if ($company->profile_picture)
                                <img src="{{ asset('storage/' . $company->profile_picture) }}"
                                    alt="Company Logo of {{ $company->user_name }}" class="profile-picture">
                            @else
                                <img src="{{ asset('images/Tree.png') }}" alt="Default Company Logo"
                                    class="profile-picture">
                            @endif
                        </div>
                        <div class="company-list-text-container">
                            <h3 class="company-name"> {{ $company->user_name }} </h3>
                            <p class="company-info">Location: {{ $company->location ?? 'N/A' }}</p>
                            <p class="company-description">{{ Str::limit($company->bio, 400) }}</p>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center">
                No companies found.
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $companies->links() }}
    </div>
</div>
