<div>
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
                <a href="{{ route('edit-profile') }}" wire:navigate>
                    <button class="btn-primary">EDIT</button>
                </a>
            </div>
        </div>

    </section>


    {{-- Personal Statement --}}
    <section class="bg-blue">
        <div class="element-container-blue">
            <div class=" flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold">Personal Statement</h2>

                @if (!$selectedPersonalStatement)
                    <button wire:click="toggleSection('personal_statement')" class="btn-secondary">
                        {{ $showPersonalStatementOptions ? 'CLOSE' : 'ADD' }}
                    </button>
                @endif
            </div>
            @if ($selectedPersonalStatement)
                <div class="element-container flex items-center justify-between mb-2">

                    <p class="italic">{{ $selectedPersonalStatement }}</p>
                    <button wire:click="removeSelectedStatement" class="delete-button">REMOVE</button>
                </div>
            @else
                <p class="text-gray-500">No personal statement selected yet.</p>
            @endif
        </div>
        <div>
            @if ($showPersonalStatementOptions && !$selectedPersonalStatement)
                <div>
                    <livewire:personal-statement-component :creatingCV="true" />
                </div>
            @endif
        </div>
    </section>

    {{-- Experience --}}
    <section class="bg-blue">
        <div class="element-container-blue">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold">Professional Experiences</h2>

                @if (count($selectedProfessionalExperienceIds) < 5)
                    <button wire:click="toggleSection('professional_experience')" class="btn-secondary">
                        {{ $showProfessionalExperiences ? 'CLOSE' : 'ADD' }}
                    </button>
                @endif


            </div>

            @if (count($selectedProfessionalExperiences) > 0)
                <div class=" space-y-4">

                    @foreach ($selectedProfessionalExperiences as $experience)
                        <div class="element-container flex items-center justify-between mb-2">
                            <div>
                                <p><strong>Job Title:</strong> {{ $experience->job_title }}</p>
                                <p><strong>Company:</strong> {{ $experience->company_name }}</p>
                                <p><strong>Location:</strong> {{ $experience->location }}</p>
                                <p><strong>Start Date:</strong> {{ $experience->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $experience->end_date ?? 'Present' }}</p>
                                <p><strong>Key Achievements:</strong> {{ $experience->key_achievements }}</p>
                                <p><strong>Quantifiable Results:</strong> {{ $experience->quantifiable_results }}</p>
                            </div>
                            <button wire:click="removeSelectedExperience({{ $experience->id }})"
                                class="delete-button">REMOVE</button>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No professional experience selected yet.</p>
            @endif
        </div>

        @if ($showProfessionalExperiences && count($selectedProfessionalExperiences) < 5)
            <div>
                <livewire:professional-experience-component :creatingCV="true" />
            </div>
        @endif

        @if ($addSelectedExperienceError)
            <div class="alert-error">{{ $addSelectedExperienceError }}</div>
        @endif

    </section>



    {{-- Education --}}
    <section class="bg-blue">
        <div class="element-container-blue">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold">Education</h2>

                @if (count($selectedEducationIds) < 5)
                    <button wire:click="toggleSection('education')" class="btn-secondary">
                        {{ $showEducations ? 'CLOSE' : 'ADD' }}
                    </button>
                @endif
            </div>

            @if (count($selectedEducations) > 0)
                <div class="space-y-4">
                    @foreach ($selectedEducations as $education)
                        <div class="element-container flex items-center justify-between mb-2">
                            <div>
                                <p><strong>Degree:</strong> {{ $education->degree }}</p>
                                <p><strong>Field of Study:</strong> {{ $education->field_of_study }}</p>
                                <p><strong>University:</strong> {{ $education->university_name }}</p>
                                <p><strong>Graduation Date:</strong> {{ $education->graduation_date }}</p>
                                <p><strong>Grade:</strong> {{ $education->grade }}</p>
                                <p><strong>Project:</strong> {{ $education->project }}</p>
                            </div>
                            <button wire:click="removeSelectedEducation({{ $education->id }})" class="delete-button">
                                REMOVE
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No education selected yet.</p>
            @endif
        </div>

        @if ($showEducations && count($selectedEducations) < 5)
            <div>
                <livewire:education-component :creatingCV="true" />
            </div>
        @endif

        @if ($addSelectedEducationError)
            <div class="alert-error">{{ $addSelectedEducationError }}</div>
        @endif
    </section>


    {{-- Skills --}}

    <section class="bg-blue">
        <div class="element-container-blue">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold">Skills</h2>

                @if (count($selectedSkillIds) < 5)
                    <button wire:click="toggleSection('skill')" class="btn-secondary">
                        {{ $showSkills ? 'CLOSE' : 'ADD' }}
                    </button>
                @endif
            </div>

            @if (count($selectedSkills) > 0)
                <div class="space-y-4">
                    @foreach ($selectedSkills as $skill)
                        <div class="element-container flex items-center justify-between mb-2">
                            <div>
                                <p><strong>Skill Name:</strong> {{ $skill->skills }}</p>
                            </div>
                            <button wire:click="removeSelectedSkill({{ $skill->id }})"
                                class="delete-button">REMOVE</button>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No skills selected yet.</p>
            @endif
        </div>

        @if ($showSkills && count($selectedSkills) < 5)
            <div>
                <livewire:skill-component :creatingCV="true" />
            </div>
        @endif
        @if ($addSelectedSkillError)
            <div class="alert-error">{{ $addSelectedSkillError }}</div>
        @endif
    </section>


    {{-- Certifications --}}

    <section class="bg-blue">
        <div class="element-container-blue">
            <div class=" flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold">Certification</h2>

                @if (!$selectedCertification)
                    <button wire:click="toggleSection('certification')" class="btn-secondary">
                        {{ $showCertificationOptions ? 'CLOSE' : 'ADD' }}
                    </button>
                @endif
            </div>
            @if ($selectedCertification)
                <div class="element-container flex items-center justify-between mb-2">
                    @php
                        $certification = \App\Models\Certification::find($selectedCertificationId);
                    @endphp
                    <div>
                        @if ($certification)
                            <p><strong>Languages Spoken:</strong> {{ $certification->languages_spoken ?? 'N/A' }}</p>
                            <p><strong>Certifications:</strong> {{ $certification->certifications ?? 'N/A' }}</p>
                            <p><strong>Awards:</strong> {{ $certification->awards ?? 'N/A' }}</p>
                            <p><strong>Publications:</strong> {{ $certification->publications ?? 'N/A' }}</p>
                            <p><strong>Presentations:</strong> {{ $certification->presentations ?? 'N/A' }}</p>
                            <p><strong>Relevant Activities:</strong> {{ $certification->relevant_activities ?? 'N/A' }}
                            </p>
                            <p><strong>Hobbies and Interests:</strong>
                                {{ $certification->hobbies_and_interests ?? 'N/A' }}
                            </p>
                        @else
                            <p>No certification selected.</p>
                        @endif
                    </div>
                    <button wire:click="removeSelectedCertification" class="delete-button">REMOVE</button>
                </div>
            @else
                <p class="text-gray-500">No certification selected yet.</p>
            @endif

        </div>
        <div>
            @if ($showCertificationOptions && !$selectedCertification)
                <div>
                    <livewire:certification-component :creatingCV="true" />
                </div>
            @endif
        </div>
    </section>

    {{-- Save Button --}}
    <div class="element-container-blue text-center">
        <button wire:click="createCV" class="welcoming-button">GENERATE</button>
    </div>

</div>
