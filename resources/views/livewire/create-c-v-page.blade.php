<div class="p-6 max-w-5xl mx-auto space-y-8">
    <h1 class="highlighted-headers">Build Your CV</h1>

    {{-- Contact Information --}}
    <section class="element-container">
        <h2 class="text-lg font-semibold mb-2">Contact Information</h2>
        <div class="space-y-2">
            <div class="flex justify-between items-center">
                <ul>
                    <li>Full Name: {{ $profile->user->name }}</li>
                    <li>Email: {{ $profile->user->email }}</li>
                    <li>Phone: {{ $profile->phone_number ?? 'Not Provided' }}</li>
                    <li>Location: {{ $profile->location ?? 'Not Provided' }}</li>
                    <li>Date Of Birth: {{ $profile->date_of_birth ?? 'Not Provided' }}</li>
                </ul>
                <a href="{{ route('edit-profile') }}" wire::navigate>
                    <button class="btn-primary">EDIT</button>
                </a>
            </div>
        </div>

    </section>


    {{-- Personal Statement --}}
    <section class="element-container">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Personal Statement</h2>

            @if (!$selectedPersonalStatement)
                <button wire:click="$toggle('showPersonalStatementOptions')" class="btn-secondary">
                    {{ $showPersonalStatementOptions ? 'Cancel' : '+ Add' }}
                </button>
            @endif
        </div>
        <div class="space-y-4">
            @if ($selectedPersonalStatement)
                <div class="element-container flex items-center justify-between mb-2    ">
                    <p class="italic">{{ $selectedPersonalStatement }}</p>
                    <button wire:click="removeSelectedStatement"
                        class="delete-button">Remove</button>
                </div>
            @else
                <p class="text-gray-500">No personal statement selected yet.</p>
            @endif
            @if ($showPersonalStatementOptions && !$selectedPersonalStatement)
                <livewire:personal-statement-component :creatingCV="true" />
            @endif
        </div>
    </section>



    {{-- Experience --}}
    <section class="element-container">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Professional Experience</h2>
            <button class="btn btn-sm">+ Add</button>
        </div>
        <div class="space-y-2">
            <p class="text-gray-500">No experience selected yet.</p>
        </div>
    </section>

    {{-- Education --}}
    <section class="element-container">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Education</h2>
            <button class="btn btn-sm">+ Add</button>
        </div>
        <div class="space-y-2">
            <p class="text-gray-500">No education selected yet.</p>
        </div>
    </section>

    {{-- Skills --}}
    <section class="element-container">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Skills</h2>
            <button class="btn btn-sm">+ Add</button>
        </div>
        <div class="space-y-2">
            <p class="text-gray-500">No skills selected yet.</p>
        </div>
    </section>

    {{-- Certifications --}}
    <section class="element-container">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-lg font-semibold">Certifications</h2>
            <button class="btn btn-sm">+ Add</button>
        </div>
        <div class="space-y-2">
            <p class="text-gray-500">No certifications selected yet.</p>
        </div>
    </section>

    {{-- Save Button --}}
    <div class="text-center">
        <button class="welcoming-button">GENERATE</button>
    </div>
</div>
