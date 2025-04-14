<div class="page-container">
    <h1 class="highlighted-headers">Your CV Components</h1>

    <!-- Contact Information -->
    <div class="section">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Contact Information</h3>
                <button class="btn-secondary" wire:click="toggleSection('contact_information')">TOGGLE</button>
            </div>
        </div>
        @if ($showContactInformation)
            <div class="element-container-transparent">
                <div class="element-container bg-white">
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
            </div>
        @endif
    </div>


    <!-- Personal Statement -->
    <div class="section">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Personal Statement</h3>
                <button class="btn-secondary" wire:click="toggleSection('personal_statement')">TOGGLE</button>
            </div>
        </div>
        @if ($showPersonalStatementOptions)
            <div class="element-container-transparent">
                <livewire:personal-statement-component />
            </div>
        @endif
    </div>


    <!-- Professional Experience -->
    <div class="section">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Professional Experience</h3>
                <button class="btn-secondary" wire:click="toggleSection('professional_experience')">TOGGLE</button>
            </div>
        </div>
        @if ($showProfessionalExperiences)
            <div class="element-container-transparent">
                <livewire:professional-experience-component />
            </div>
        @endif
    </div>

    {{-- Education --}}
    <div class="section">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Education</h3>
                <button class="btn-secondary" wire:click="toggleSection('education')">TOGGLE</button>
            </div>
        </div>
        @if ($showEducations)
            <div class="element-container-transparent">
                <livewire:education-component />
            </div>
        @endif
    </div>

    {{-- Skills --}}
    <div class="section">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Skills</h3>
                <button class="btn-secondary" wire:click="toggleSection('skill')">TOGGLE</button>
            </div>
        </div>
        @if ($showSkills)
            <div class="element-container-transparent">
                <livewire:skill-component />
            </div>
        @endif
    </div>

    {{-- Certifications --}}
    <div class="section">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Certifications</h3>
                <button class="btn-secondary" wire:click="toggleSection('certification')">TOGGLE</button>
            </div>
        </div>
        @if ($showCertificationOptions)
            <div class="element-container-transparent">
                <livewire:certification-component />
            </div>
        @endif
    </div>
</div>
