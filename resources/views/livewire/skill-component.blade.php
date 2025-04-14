<div>
    <div class="element-container">
        <h3>Create A New Skill:</h3>

        <div class="flex items-center w-full">
            <input type="text" wire:model="newSkill" placeholder="Add a new skill..." class="input-field flex-grow">
            <button wire:click="createSkill" class="editing-button">CREATE</button>
        </div>
    </div>

    @error('newSkill')
        <div class="alert-error">The skill added must not be greater than 255 characters.</div>
    @enderror

    <div class="element-container-transparent">
        <h3>List of Skills History:</h3>

        @forelse ($skills as $skill)
            <div class="element-container flex justify-between items-center">
                <div class="flex gap-2 w-full items-center"
                    {{ $selectedSkill === $skill->id ? 'bg-blue-100 border-blue-400 border-l-4' : '' }}">
                    @if ($editingSkillId === $skill->id)
                        <input type="text" wire:model="editedSkill" class="input-field flex-grow"
                            placeholder="Edit your skill...">
                        <button wire:click="saveEditedSkill" class="editing-button">SAVE</button>
                        <button wire:click="$set('editingSkillId', null)" class="cancel-button">CANCEL</button>
                    @else
                        <p class="flex-1">{{ $skill->skills }}</p>

                        @if ($creatingCV)
                            <button wire:click="select({{ $skill->id }})" class="editing-button">SELECT</button>
                        @endif
                        <button wire:click="editSkill({{ $skill->id }})" class="edit-button">EDIT</button>
                        @if (!$creatingCV)
                            <button wire:click="deleteSkill({{ $skill->id }})" class="delete-button">DELETE</button>
                        @endif
                    @endif
                </div>
            </div>

            @if ($editingSkillId === $skill->id)
                @error('editedSkill')
                    <div class="alert-error">The skill updated must not be greater than 255 characters.</div>
                @enderror
            @endif
        @empty
            <div class="text-center text-gray-600 mt-4">
                You haven't added any skills yet.
            </div>
        @endforelse

        <div class="pagination">
            {{ $skills->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
