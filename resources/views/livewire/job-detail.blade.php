<div class="element-container">

    @if ($job->user->profile && $job->user->profile->profile_picture)
        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('storage/' . $job->user->profile->profile_picture) }}" alt="Company Logo"
                style="width: 100px; height: 100px; border-radius: 9999px; object-fit: cover;">
        </div>
    @endif


    <h1 class="detail-title">{{ $job->title }}</h1>

    <p class="detail-subinfo">
        <strong>Posted by:</strong>
        @if ($job->user->profile)
            {{ $job->user->profile->user_name }}
        @else
            Unknown Company
        @endif
    </p>

    <p class="detail-subinfo"><strong>Salary Range:</strong> {{ $job->salary_range }}</p>

    <div class="detail-section">
        <h2>Description</h2>
        <p>{{ $job->description }}</p>
    </div>

    <div class="detail-section">
        <h2>Requirements</h2>
        <p>{{ $job->requirements }}</p>
    </div>

    <p class="detail-timestamp">Posted {{ $job->created_at->diffForHumans() }}</p>
</div>
