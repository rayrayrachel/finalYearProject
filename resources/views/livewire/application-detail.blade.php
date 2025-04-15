<div class="element-container ">

    <div class="mt-6 text-right">
        <button onclick="window.print()" class="btn-primary">
            Print Application
        </button>
    </div>
    <div id="cv-print-area" class="page-container">

        <div class="element-container flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold">Application for {{ $application->job->title }}
                    at {{ $application->job->user->name }}</h2>
                <p class="text-sm text-gray-500">Applied on {{ $application->created_at->format('F j, Y') }}</p>
            </div>
            <span
                class="px-4 py-2 text-sm font-semibold rounded-full text-white 
            @if ($application->status === 'pending') bg-yellow-500 
            @elseif ($application->status === 'accepted') bg-green-600 
            @elseif ($application->status === 'rejected') bg-red-600 
            @else bg-gray-500 @endif">
                {{ ucfirst($application->status) }}
            </span>
        </div>

        <h3 class="cv-section-heading text-center">Job Description</h3>
        @livewire('job-detail', ['jobId' => $application->job->id])

        <div class="mt-6">
            <h3 class="cv-section-heading text-center">Cover Letter</h3>
            <div class="element-container">{{ $application->cover_letter }}</div>
        </div>

        @if ($cv)
            <div class="mt-6">
                <h3 class="cv-section-heading text-center">Curriculum Vitae</h3>
                @livewire('cv-preview', ['cvId' => $cv->id, 'printable' => false])
            </div>
        @else
            <p class="text-sm text-gray-500 italic">No CV found for this application.</p>
        @endif
    </div>
</div>
