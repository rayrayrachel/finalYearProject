<div class="element-container">
    <h2 class="highlighted-headers mb-4">CV History</h2>

    @if ($cvs->isEmpty())
        <p class="text-gray-500">You have not generated any CVs yet.</p>
    @else
        <div class="page-container">
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


                            @if ($creatingApplication)
                                <button wire:click="select({{ $cv->id }})" class="btn-primary">SELECT</button>
                            @endif

                            <button class="editing-button">
                                <a href="{{ route('cv-preview', ['cvId' => $cv->id]) }}" target="_blank"
                                    rel="noopener noreferrer">
                                   VIEW CV
                                </a>
                            </button>

                            @if (!$creatingApplication)
                                <button wire:click="deleteCV({{ $cv->id }})" class="delete-button">DELETE</button>
                            @endif


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
