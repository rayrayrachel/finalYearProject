<div>
    <div class="element-container">
        <h3 class="mb-2">Add New Professional Experience:</h3>

        <div class="cv-form-grid">
            <!-- Job Title -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Job Title:
                </span>
                <input type="text" wire:model="job_title" class="cv-input-field" required>
            </label>
            @if ($errors->has('job_title'))
                <div class="alert-error">{{ $errors->first('job_title') }}</div>
            @endif

            <!-- Company Name -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Company Name:
                </span>
                <input type="text" wire:model="company_name" class="cv-input-field" required>
            </label>
            @if ($errors->has('company_name'))
                <div class="alert-error">{{ $errors->first('company_name') }}</div>
            @endif

            <!-- Location -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Location:
                </span>
                <input type="text" wire:model="location" class="cv-input-field" required>
            </label>
            @if ($errors->has('location'))
                <div class="alert-error">{{ $errors->first('location') }}</div>
            @endif

            <!-- Start Date -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Start Date:
                </span>
                <input type="date" wire:model="start_date" class="cv-input-field" required>
            </label>
            @if ($errors->has('start_date'))
                <div class="alert-error">{{ $errors->first('start_date') }}</div>
            @endif

            <!-- End Date -->
            <label class="cv-form-label">
                <span>
                    End Date:
                </span>
                <input type="date" wire:model="end_date" class="cv-input-field">
            </label>
            @if ($errors->has('end_date'))
                <div class="alert-error">{{ $errors->first('end_date') }}</div>
            @endif

            <!-- Key Achievements -->
            <label class="cv-form-label">
                <span>
                    Key Achievements:
                </span>
                <textarea wire:model="key_achievements" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('key_achievements'))
                <div class="alert-error">{{ $errors->first('key_achievements') }}</div>
            @endif

            <!-- Quantifiable Results -->
            <label class="cv-form-label">
                <span>
                    Quantifiable Results:
                </span>
                <textarea wire:model="quantifiable_results" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('quantifiable_results'))
                <div class="alert-error">{{ $errors->first('quantifiable_results') }}</div>
            @endif

            <div class="flex justify-end gap-2">
                <button wire:click="createExperience" class="editing-button">CREATE</button>
            </div>
        </div>
    </div>
    <div class="element-container-transparent mt-6">
        <h3 class="mb-2">Professional Experience:</h3>

        @forelse ($experiences as $experience)
            <div
                class="element-container flex flex-col gap-2 mb-2 
            {{ $selectedExperienceId === $experience->id ? 'bg-blue-100 border-blue-400 border-l-4' : '' }}">

                @if ($editingExperienceId === $experience->id)
                    <div class="cv-form-grid">
                        <!-- Job Title -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Job Title:
                            </span>
                            <input type="text" wire:model="editedExperience.job_title" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedExperience.job_title'))
                            <div class="alert-error">{{ $errors->first('editedExperience.job_title') }}</div>
                        @endif

                        <!-- Company Name -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Company Name:
                            </span>
                            <input type="text" wire:model="editedExperience.company_name" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedExperience.company_name'))
                            <div class="alert-error">{{ $errors->first('editedExperience.company_name') }}</div>
                        @endif

                        <!-- Location -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Location:
                            </span>
                            <input type="text" wire:model="editedExperience.location" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedExperience.location'))
                            <div class="alert-error">{{ $errors->first('editedExperience.location') }}</div>
                        @endif

                        <!-- Start Date -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Start Date:
                            </span>
                            <input type="date" wire:model="editedExperience.start_date" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedExperience.start_date'))
                            <div class="alert-error">{{ $errors->first('editedExperience.start_date') }}</div>
                        @endif

                        <!-- End Date -->
                        <label class="cv-form-label">
                            <span>
                                End Date:
                            </span>
                            <input type="date" wire:model="editedExperience.end_date" class="cv-input-field">
                        </label>
                        @if ($errors->has('editedExperience.end_date'))
                            <div class="alert-error">{{ $errors->first('editedExperience.end_date') }}</div>
                        @endif

                        <!-- Key Achievements -->
                        <label class="cv-form-label">
                            <span>
                                Key Achievements:
                            </span>
                            <textarea wire:model="editedExperience.key_achievements" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedExperience.key_achievements'))
                            <div class="alert-error">{{ $errors->first('editedExperience.key_achievements') }}</div>
                        @endif

                        <!-- Quantifiable Results -->
                        <label class="cv-form-label">
                            <span>
                                Quantifiable Results:
                            </span>
                            <textarea wire:model="editedExperience.quantifiable_results" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedExperience.quantifiable_results'))
                            <div class="alert-error">{{ $errors->first('editedExperience.quantifiable_results') }}
                            </div>
                        @endif

                        <div class="flex justify-end gap-2">
                            <button wire:click="saveEditedExperience" class="editing-button">SAVE</button>
                            <button wire:click="$set('editingExperienceId', null)" class="cancel-button">CANCEL</button>
                        </div>
                    </div>
                @else
                    <div>
                        <p><strong>{{ $experience->job_title }}</strong> at {{ $experience->company_name ?? '-' }}</p>
                        <p>{{ $experience->location }} | Started: {{ $experience->start_date ?? '-' }} | Ended:
                            {{ $experience->end_date ?? 'Present' }}</p>
                        <p>Key Achievements: {{ $experience->key_achievements ?? 'N/A' }}</p>
                        <p>Quantifiable Results: {{ $experience->quantifiable_results ?? 'N/A' }}</p>
                    </div>

                    <div class="flex justify-end gap-2">
                        @if ($creatingCV)
                            <button wire:click="select({{ $experience->id }})" class="editing-button">SELECT</button>
                        @endif
                        <button wire:click="editExperience({{ $experience->id }})" class="edit-button">EDIT</button>
                        @if (!$creatingCV)
                            {
                            <button wire:click="deleteExperience({{ $experience->id }})"
                                class="delete-button">DELETE</button>
                            }
                        @endif
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-gray-600 mt-4">
                You haven't added any professional experiences yet.
            </div>
        @endforelse

        <div class="pagination mt-4">
            {{ $experiences->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
