<div>
    @if ($isOwner)
        <div class="element-container">
            <h1>
                Your Received Applications</span>

            </h1>


            @forelse ($applications as $application)
                <div class="element-container-blue">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-lg font-semibold">{{ $application->job->title }}</p>
                            <p class="text-gray-600 text-sm mb-2">
                                From: {{ $application->user->name ?? 'Unknown User' }}
                            </p>
                            <p class="text-sm text-gray-500">
                                Applied At: {{ $application->created_at->format('F j, Y') }}
                            </p>
                        </div>

                        <div class="flex flex-col ml-auto text-center space-y-2">
                            <span
                                class="px-3 py-1 rounded-full text-sm font-semibold text-white
                            @if ($application->status === 'pending') bg-yellow-500
                            @elseif($application->status === 'accepted') bg-green-600
                            @elseif($application->status === 'rejected') bg-red-600
                            @else bg-gray-400 @endif">
                                {{ ucfirst($application->status) }}
                            </span>

                            <a href="{{ route('application-detail', $application->id) }}" class="btn-primary">DETAIL</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class='element-container'>
                    <p class="text-sm text-gray-500">No applications found.</p>
                </div>
            @endforelse

            <div class="pagination">
                {{ $applications->links(data: ['scrollTo' => false]) }}
            </div>

        </div>
    @else
        <div>
        </div>
    @endif
</div>
