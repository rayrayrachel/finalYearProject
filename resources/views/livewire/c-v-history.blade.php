<div class="element-container">
    <h2 class="highlighted-headers mb-4">CV History</h2>

    @if ($cvs->isEmpty())
        <p class="text-gray-500">You have not generated any CVs yet.</p>
    @else
        <div class="space-y-4">
            @foreach ($cvs as $cv)
                <div class="element-container-blue p-4 shadow-md rounded-lg">
                    <p><strong>Created At:</strong> {{ $cv->created_at->format('F j, Y H:i') }}</p>

                    <p><strong>Full Name:</strong> {{ $cv->contact_information['name'] ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $cv->contact_information['email'] ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $cv->contact_information['phone'] ?? 'N/A' }}</p>

                    <div class="mt-2">
                        <a href="{{ route('create-c-v-page') }}" class="btn-primary">View CV</a>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
</div>
