<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="element-container">

        @if ($job->user->profile && $job->user->profile->profile_picture)
            <a href="{{ route('profile.detail', ['profileId' => $job->user->profile->id]) }}" wire:navigate>

                <div style="text-align: center; margin-bottom: 20px;">
                    <img src="{{ asset('storage/' . $job->user->profile->profile_picture) }}" alt="Company Logo"
                        style="width: 100px; height: 100px; border-radius: 9999px; object-fit: cover;">
                </div>
            </a>
        @endif
        <div class="justify-between flex items-center">
            <div>
                <h1 class="detail-title">{{ $job->title }}</h1>
            </div>

            @if ($fromJobDetail && !auth()->user()->profile->is_company)
                <div>
                    <a href="{{ route('application-page', ['jobId' => $job->id]) }}" wire:navigate>
                        <button class="editing-button">APPLY</button>
                    </a>
                </div>
            @endif

        </div>


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
