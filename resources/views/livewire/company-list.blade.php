<div>
    <div class="element-container">

        <div class="search-container">
            <input type="text" placeholder="Search companies..." wire:model="search" class="search-input" />
            <button class="search-icon" wire:click="$dispatch('searchClicked')">
                🔍
            </button>
        </div>
    </div>

    <div class="element-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Location</th>
                    <th>Website</th>
                    <th>Descriptions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($companies as $company)
                    <tr>
                        <td>{{ $company->user_name }}</td>
                        <td>{{ $company->location ?? 'N/A' }}</td>
                        <td>
                            @if ($company->website)
                                <a href="{{ $company->website }}" target="_blank"
                                    class="text-blue-600">{{ $company->website }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ Str::limit($company->bio, 50) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No companies found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $companies->links() }}
    </div>
</div>
