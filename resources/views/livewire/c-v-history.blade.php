<div class="element-container">
    <h2 class="highlighted-headers mb-4">CV History</h2>

    @if ($cvs->isEmpty())
        <p class="text-gray-500">You have not generated any CVs yet.</p>
    @else
        <div class="space-y-4">
            @foreach ($cvs as $cv)
                <div class="element-container-blue p-4 shadow-md rounded-lg">
                    <div class="justisfy-content flex">
                        <div>
                            <p><strong>Created At:</strong> {{ $cv->created_at->format('F j, Y H:i') }}</p>

                            <p><strong>Full Name:</strong> {{ $cv->contact_information['name'] ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $cv->contact_information['email'] ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $cv->contact_information['phone'] ?? 'N/A' }}</p>
                        </div>
                        <div class="mt-2 item-center ml-auto">
                            <button class="editing-button">
                                <a wire:navigate href="{{ route('cv-preview', ['cvId' => $cv->id]) }}">
                                    View CV
                                </a>
                            </button>

                            <button wire:click="deleteCV({{ $cv->id }})" class="delete-button">Delete</button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="pagination">
            {{ $cvs->links(data: ['scrollTo' => false]) }}
        </div>
    @endif
</div>
