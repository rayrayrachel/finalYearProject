<div class="page-contianer">
    <h1 class="highlighted-headers">Your CV Components</h1>

    <div class="section" x-data="{ open: @entangle('sections.contact_information') }">
        <div class="element-container">
            <div class="section-header">
                <h3>Contact Information</h3>
                <button class="btn-primary" wire:click="toggleSection('contact_information')">Toggle</button>
            </div>
        </div>
        <div x-show="open" x-transition>
            <div class="element-container-transparent">
                <!-- Contact Information -->
                TODO display profile info
            </div>
        </div>
    </div>

    <div class="section" x-data="{ open: @entangle('sections.personal_statement') }">
        <div class="element-container">

            <div class="section-header">
                <h3>Personal Statement</h3>
                <button class="btn-primary" wire:click="toggleSection('personal_statement')">Toggle</button>
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
                <button class="btn-primary" wire:click="toggleSection('professional_experience')">Toggle</button>
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
                <button class="btn-primary" wire:click="toggleSection('education')">Toggle</button>
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
                <button class="btn-primary" wire:click="toggleSection('skills')">Toggle</button>
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
                <button class="btn-primary" wire:click="toggleSection('certifications')">Toggle</button>
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
