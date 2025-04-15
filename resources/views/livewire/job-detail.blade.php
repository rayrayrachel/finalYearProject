<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="element-container">

        <div class="mb-6">
            <h1 class="highlighted-headers text-2xl font-semibold leading-tight">{{ $job->title }}</h1>
        </div>

        <div class="flex items-center justify-between mb-6">
            @if ($job->user->profile && $job->user->profile->profile_picture)
                <a href="{{ route('profile.detail', ['profileId' => $job->user->profile->id]) }}" wire:navigate>
                    <div class="mr-4">
                        <img src="{{ asset('storage/' . $job->user->profile->profile_picture) }}" alt="Company Logo"
                            class="rounded-full w-16 h-16 object-cover mx-4">

                    </div>
                </a>
            @endif

            <div class="flex-1">
                <p class="detail-subinfo">
                    <a href="{{ route('profile.detail', ['profileId' => $job->user->profile->id]) }}" wire:navigate>
                        <strong>Posted by:</strong>
                        @if ($job->user->profile)
                            {{ $job->user->profile->user_name }}
                        @else
                            Unknown Company
                        @endif
                    </a>
                </p>
            </div>

            @if ($fromJobDetail && auth()->check() && !auth()->user()->profile->is_company)
                <div>
                    <a href="{{ route('application-page', ['jobId' => $job->id]) }}" wire:navigate>
                        <button class="editing-button">APPLY</button>
                    </a>
                </div>
            @endif
        </div>

        <div class="element-container">
            <p class="detail-subinfo"><strong>Salary Range:</strong> {{ $job->salary_range }}</p>

            <div class="detail-section">
                <strong>
                    <h2>Location</h2>
                </strong>
                <p>{{ $job->location }}</p>
            </div>

            <div class="detail-section">
                <strong>
                    <h2>Description</h2>
                </strong>
                <p>{{ $job->description }}</p>
            </div>

            <div class="detail-section">
                <strong>
                    <h2>Requirements</h2>
                </strong>
                <p>{{ $job->requirements }}</p>
            </div>

            <p class="detail-timestamp">Posted {{ $job->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>
