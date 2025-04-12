<div>
    <div class="element-container">
        <h3 class="mb-2">Add New Education:</h3>

        <div class="cv-form-grid">
            <!-- Degree Field -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Degree:
                </span>
                <input type="text" wire:model="degree" class="cv-input-field" required>
            </label>
            @if ($errors->has('degree'))
                <div class="alert-error">{{ $errors->first('degree') }}</div>
            @endif

            <!-- Field of Study -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Field of Study:
                </span>
                <input type="text" wire:model="field_of_study" class="cv-input-field" required>
            </label>
            @if ($errors->has('field_of_study'))
                <div class="alert-error">{{ $errors->first('field_of_study') }}</div>
            @endif

            <!-- University Name -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    University Name:
                </span>
                <input type="text" wire:model="university_name" class="cv-input-field" required>
            </label>
            @if ($errors->has('university_name'))
                <div class="alert-error">{{ $errors->first('university_name') }}</div>
            @endif

            <!-- Graduation Date -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Graduation Date:
                </span>
                <input type="date" wire:model="graduation_date" class="cv-input-field" required>
            </label>
            @if ($errors->has('graduation_date'))
                <div class="alert-error">{{ $errors->first('graduation_date') }}</div>
            @endif

            <!-- Grade -->
            <label class="cv-form-label">
                <span>
                    Grade:
                </span>
                <input type="text" wire:model="grade" class="cv-input-field">
            </label>
            @if ($errors->has('grade'))
                <div class="alert-error">{{ $errors->first('grade') }}</div>
            @endif

            <div class="flex justify-end gap-2">
                <button wire:click="createEducation" class="editing-button">CREATE</button>
            </div>

        </div>
    </div>

    <div class="element-container-transparent mt-6">
        <h3 class="mb-2">Education History:</h3>

        @forelse ($educations as $education)
            <div class="element-container flex flex-col gap-2 mb-2">
                @if ($editingEducationId === $education->id)
                    <div class="cv-form-grid">
                        <!-- Degree Field (Editing) -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Degree:
                            </span>
                            <input type="text" wire:model="editedEducation.degree" class="cv-input-field" required>
                        </label>
                        @if ($errors->has('editedEducation.degree'))
                            <div class="alert-error">{{ $errors->first('editedEducation.degree') }}</div>
                        @endif

                        <!-- Field of Study (Editing) -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Field of Study:
                            </span>
                            <input type="text" wire:model="editedEducation.field_of_study" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedEducation.field_of_study'))
                            <div class="alert-error">{{ $errors->first('editedEducation.field_of_study') }}</div>
                        @endif

                        <!-- University Name (Editing) -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                University Name:
                            </span>
                            <input type="text" wire:model="editedEducation.university_name" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedEducation.university_name'))
                            <div class="alert-error">{{ $errors->first('editedEducation.university_name') }}</div>
                        @endif

                        <!-- Graduation Date (Editing) -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Graduation Date:
                            </span>
                            <input type="date" wire:model="editedEducation.graduation_date" class="cv-input-field"
                                required>
                        </label>
                        @if ($errors->has('editedEducation.graduation_date'))
                            <div class="alert-error">{{ $errors->first('editedEducation.graduation_date') }}</div>
                        @endif

                        <!-- Grade (Editing) -->
                        <label class="cv-form-label">
                            <span>
                                Grade:
                            </span>
                            <input type="text" wire:model="editedEducation.grade" class="cv-input-field">
                        </label>
                        @if ($errors->has('editedEducation.grade'))
                            <div class="alert-error">{{ $errors->first('editedEducation.grade') }}</div>
                        @endif

                        <div class="flex justify-end gap-2">
                            <button wire:click="saveEditedEducation" class="editing-button">SAVE</button>
                            <button wire:click="$set('editingEducationId', null)" class="cancel-button">CANCEL</button>

                        </div>
                    </div>
                @else
                    <div>
                        <p><strong>{{ $education->degree }}</strong> in {{ $education->field_of_study ?? '-' }}</p>
                        <p>{{ $education->university_name }} | Graduated: {{ $education->graduation_date ?? '-' }}</p>
                        <p>Grade: {{ $education->grade ?? 'N/A' }}</p>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button wire:click="editEducation({{ $education->id }})" class="edit-button">EDIT</button>
                        <button wire:click="deleteEducation({{ $education->id }})"
                            class="delete-button">DELETE</button>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-gray-600 mt-4">
                You haven't added any education records yet.
            </div>
        @endforelse

        <div class="pagination mt-4">
            {{ $educations->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
