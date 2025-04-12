<div>
    <div class="element-container">
        <h3 class="mb-2">Add New Certification:</h3>

        <form wire:submit.prevent="createCertification" class="cv-form-grid">
            <!-- Languages Spoken -->
            <label class="cv-form-label">
                <span>
                    <span class="star">*</span>
                    Languages Spoken:
                </span>
                <textarea wire:model="languages_spoken" class="cv-input-field" required></textarea>
            </label>
            @if ($errors->has('languages_spoken'))
                <div class="alert-error">{{ $errors->first('languages_spoken') }}</div>
            @endif

            <!-- Certifications -->
            <label class="cv-form-label">
                <span>
                    Certifications:
                </span>
                <textarea wire:model="certifications" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('certifications'))
                <div class="alert-error">{{ $errors->first('certifications') }}</div>
            @endif

            <!-- Awards -->
            <label class="cv-form-label">
                <span>
                    Awards:
                </span>
                <textarea wire:model="awards" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('awards'))
                <div class="alert-error">{{ $errors->first('awards') }}</div>
            @endif

            <!-- Publications -->
            <label class="cv-form-label">
                <span>
                    Publications:
                </span>
                <textarea wire:model="publications" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('publications'))
                <div class="alert-error">{{ $errors->first('publications') }}</div>
            @endif

            <!-- Presentations -->
            <label class="cv-form-label">
                <span>
                    Presentations:
                </span>
                <textarea wire:model="presentations" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('presentations'))
                <div class="alert-error">{{ $errors->first('presentations') }}</div>
            @endif

            <!-- Relevant Activities -->
            <label class="cv-form-label">
                <span>
                    Relevant Activities:
                </span>
                <textarea wire:model="relevant_activities" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('relevant_activities'))
                <div class="alert-error">{{ $errors->first('relevant_activities') }}</div>
            @endif

            <!-- Hobbies and Interests -->
            <label class="cv-form-label">
                <span>
                    Hobbies and Interests:
                </span>
                <textarea wire:model="hobbies_and_interests" class="cv-input-field"></textarea>
            </label>
            @if ($errors->has('hobbies_and_interests'))
                <div class="alert-error">{{ $errors->first('hobbies_and_interests') }}</div>
            @endif

            <div class="flex justify-end gap-2">
                <button type="submit" class="editing-button">CREATE</button>
            </div>
        </form>
    </div>

    <div class="element-container-transparent mt-6">
        <h3 class="mb-2">Certifications:</h3>

        @forelse ($certs  as $certification)
            <div class="element-container flex flex-col gap-2 mb-2">
                @if ($editingCertificationId === $certification->id)
                    <div class="cv-form-grid">
                        <!-- Languages Spoken -->
                        <label class="cv-form-label">
                            <span>
                                <span class="star">*</span>
                                Languages Spoken:
                            </span>
                            <textarea wire:model="editedCertification.languages_spoken" class="cv-input-field" required></textarea>
                        </label>
                        @if ($errors->has('editedCertification.languages_spoken'))
                            <div class="alert-error">{{ $errors->first('editedCertification.languages_spoken') }}</div>
                        @endif

                        <!-- Certifications -->
                        <label class="cv-form-label">
                            <span>
                                Certifications:
                            </span>
                            <textarea wire:model="editedCertification.certifications" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedCertification.certifications'))
                            <div class="alert-error">{{ $errors->first('editedCertification.certifications') }}</div>
                        @endif

                        <!-- Awards -->
                        <label class="cv-form-label">
                            <span>
                                Awards:
                            </span>
                            <textarea wire:model="editedCertification.awards" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedCertification.awards'))
                            <div class="alert-error">{{ $errors->first('editedCertification.awards') }}</div>
                        @endif

                        <!-- Publications -->
                        <label class="cv-form-label">
                            <span>
                                Publications:
                            </span>
                            <textarea wire:model="editedCertification.publications" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedCertification.publications'))
                            <div class="alert-error">{{ $errors->first('editedCertification.publications') }}</div>
                        @endif

                        <!-- Presentations -->
                        <label class="cv-form-label">
                            <span>
                                Presentations:
                            </span>
                            <textarea wire:model="editedCertification.presentations" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedCertification.presentations'))
                            <div class="alert-error">{{ $errors->first('editedCertification.presentations') }}</div>
                        @endif

                        <!-- Relevant Activities -->
                        <label class="cv-form-label">
                            <span>
                                Relevant Activities:
                            </span>
                            <textarea wire:model="editedCertification.relevant_activities" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedCertification.relevant_activities'))
                            <div class="alert-error">{{ $errors->first('editedCertification.relevant_activities') }}
                            </div>
                        @endif

                        <!-- Hobbies and Interests -->
                        <label class="cv-form-label">
                            <span>
                                Hobbies and Interests:
                            </span>
                            <textarea wire:model="editedCertification.hobbies_and_interests" class="cv-input-field"></textarea>
                        </label>
                        @if ($errors->has('editedCertification.hobbies_and_interests'))
                            <div class="alert-error">{{ $errors->first('editedCertification.hobbies_and_interests') }}
                            </div>
                        @endif

                        <div class="flex justify-end gap-2">
                            <button wire:click="saveEditedCertification" class="editing-button">SAVE</button>
                            <button wire:click="$set('editingCertificationId', null)"
                                class="cancel-button">CANCEL</button>
                        </div>
                    </div>
                @else
                    <div>
                        <p><strong>Languages Spoken:</strong> {{ $certification->languages_spoken ?? '-' }}</p>
                        <p><strong>Certifications:</strong> {{ $certification->certifications ?? '-' }}</p>
                        <p><strong>Awards:</strong> {{ $certification->awards ?? '-' }}</p>
                        <p><strong>Publications:</strong> {{ $certification->publications ?? '-' }}</p>
                        <p><strong>Presentations:</strong> {{ $certification->presentations ?? '-' }}</p>
                        <p><strong>Relevant Activities:</strong> {{ $certification->relevant_activities ?? '-' }}</p>
                        <p><strong>Hobbies and Interests:</strong> {{ $certification->hobbies_and_interests ?? '-' }}
                        </p>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button wire:click="editCertification({{ $certification->id }})"
                            class="edit-button">EDIT</button>
                        <button wire:click="deleteCertification({{ $certification->id }})"
                            class="delete-button">DELETE</button>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center text-gray-600 mt-4">
                You haven't added any certifications yet.
            </div>
        @endforelse

        <div class="pagination mt-4">
            {{ $certs ->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
