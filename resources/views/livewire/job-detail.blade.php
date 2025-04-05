<div class="element-container">
    <div class="job-header mb-6">
        <h1 class="text-3xl font-bold">{{ $job->title }}</h1>
        <p class="text-sm text-gray-500">
            Posted {{ $job->created_at->diffForHumans() }} by User ID: {{ $job->user_id }}
        </p>
    </div>

    <div class="job-info mb-4">
        <h2 class="text-xl font-bold mb-2">Description</h2>
        <p>{{ $job->description }}</p>
    </div>

    <div class="job-requirements mb-4">
        <h2 class="text-xl font-bold mb-2">Requirements</h2>
        <p>{{ $job->requirements }}</p>
    </div>
</div>


<!-- TODO details -->
