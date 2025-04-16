<div class="element-container ">

    <div class="mt-6 text-right">
        <button onclick="window.print()" class="btn-primary">
            Print Application
        </button>
    </div>
    <div id="cv-print-area" class="page-container">
        {{-- Application Info --}}
        <div class="element-container-blue flex justify-between items-start">
            <div>
                <h2 class="text-2xl font-bold">
                    {{ $application->user->name }}
                    's Application for {{ $application->job->title }}
                    at {{ $application->job->user->name }}</h2>
                <p class="text-sm text-gray-500">
                    Applied on {{ $application->created_at->format('F j, Y') }}
                </p>
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

        {{-- Accept / Reject Buttons --}}
        @if ($isOwner && $application->status === 'pending')
            <div class="element-container">
                <p
                    class="mb-4 border border-green-200 rounded-xl p-4 text-center text-green-800 bg-green-100 font-medium">
                    Accept this application to view the applicant's contact information.
                </p>

                <div class="flex justify-center gap-4">
                    <button wire:click="accept" class="editing-button">
                        ACCEPT </button>

                    <button wire:click="reject" class="delete-button">
                        REJECT </button>
                </div>
            </div>
        @endif

        {{-- Job Detail --}}

        <div class="mt-6">
            <h2 class="cv-section-heading text-center ">Job Details</h2>
            @livewire('job-detail', ['jobId' => $application->job_id, 'from' => 'null'])
        </div>


        {{-- Cover Letter --}}
        <div class="mt-6">
            <h3 class="cv-section-heading text-center">Cover Letter</h3>
            <div class="element-container">{{ $application->cover_letter }}</div>
        </div>

        {{-- CV Preview --}}
        @if ($cv)
            <div class="mt-6">
                <h3 class="cv-section-heading text-center">Curriculum Vitae</h3>
                @livewire('cv-preview', ['cvId' => $cv->id, 'printable' => false])
            </div>
        @else
            <p class="text-sm text-gray-500 italic">No CV found for this application.</p>
        @endif

        {{-- Flash Message --}}
        @if (session()->has('message'))
            <div class="text-green-600 font-semibold mt-4">
                {{ session('message') }}
            </div>
        @endif
    </div>

</div>
