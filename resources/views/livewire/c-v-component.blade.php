<div class="page-contianer">
    <h1 class="highlighted-headers">Your CV Components</h1>

    <div class="section" x-data="{ open: @entangle('sections.contact_information') }">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Contact Information</h3>
                <button class="btn-secondary" wire:click="toggleSection('contact_information')">TOGGLE</button>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">
                <!-- Contact Information -->
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
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.personal_statement') }">
        <div class="element-container-blue">

            <div class="section-header">
                <h3>Personal Statement</h3>
                <button class="btn-secondary" wire:click="toggleSection('personal_statement')">TOGGLE</button>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Personal Statement -->
                <livewire:personal-statement-component />
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.professional_experience') }">
        <div class="element-container-blue">
            <div class="section-header">
                <h3>Professional Experience</h3>
                <button class="btn-secondary" wire:click="toggleSection('professional_experience')">TOGGLE</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Professional Experience -->
                TODO list of professional experiences
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.education') }">
        <div class="element-container-blue">

            <div class="section-header">
                <h3>Education</h3>
                <button class="btn-secondary" wire:click="toggleSection('education')">TOGGLE</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Education -->
                <livewire:education-component />
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.skills') }">
        <div class="element-container-blue">

            <div class="section-header">
                <h3>Skills</h3>
                <button class="btn-secondary" wire:click="toggleSection('skills')">TOGGLE</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Skills -->
                <livewire:skill-component />
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.certifications') }">
        <div class="element-container-blue">

            <div class="section-header">
                <h3>Certifications</h3>
                <button class="btn-secondary" wire:click="toggleSection('certifications')">TOGGLE</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Certifications -->
                TODO list of certifications
            </div>
        </div>
    </div>
</div>
