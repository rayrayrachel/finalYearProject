<div class="page-contianer">
    <h1 class="highlighted-headers">Your CV Components</h1>

    <div class="section" x-data="{ open: @entangle('sections.contact_information') }">
        <div class="element-container">
            <div class="section-header">
                <h3>Contact Information</h3>
                <button class="btn-secondary" wire:click="toggleSection('contact_information')">Toggle</button>
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
                            <button class="btn-primary">Edit</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.personal_statement') }">
        <div class="element-container">

            <div class="section-header">
                <h3>Personal Statement</h3>
                <button class="btn-secondary" wire:click="toggleSection('personal_statement')">Toggle</button>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Personal Statement -->
                TODO list of personal statement
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.professional_experience') }">
        <div class="element-container">

            <div class="section-header">
                <h3>Professional Experience</h3>
                <button class="btn-secondary" wire:click="toggleSection('professional_experience')">Toggle</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Professional Experience -->
                TODO list of personal statement
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.education') }">
        <div class="element-container">

            <div class="section-header">
                <h3>Education</h3>
                <button class="btn-secondary" wire:click="toggleSection('education')">Toggle</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Education -->
                TODO list of education
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.skills') }">
        <div class="element-container">

            <div class="section-header">
                <h3>Skills</h3>
                <button class="btn-secondary" wire:click="toggleSection('skills')">Toggle</button>
            </div>

        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">

                <!-- Skills -->
                TODO list of skills
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.certifications') }">
        <div class="element-container">

            <div class="section-header">
                <h3>Certifications</h3>
                <button class="btn-secondary" wire:click="toggleSection('certifications')">Toggle</button>
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
