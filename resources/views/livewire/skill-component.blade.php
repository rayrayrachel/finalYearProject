<div>
    <div class="element-container">
        <div class="flex items-center w-full">
            <input type="text" wire:model="newSkill" placeholder="Add a new skill..." class="input-field flex-grow">
            <button wire:click="createSkill" class="btn-primary">CREATE</button>
        </div>

    </div>
    @error('newSkill')
        <div class="alert-error">{{ $message }}</div>
    @enderror

    <div class="element-container-transparent">
        @forelse ($skills as $skill)
            <div class="element-container flex justify-between items-center">
                <div class="flex gap-2 w-full">
                    @if ($editingSkillId === $skill->id)
                        <input type="text" wire:model="editedSkill" class="input-field flex-grow"
                            placeholder="Edit your skill...">
                        <button wire:click="saveEditedSkill" class="btn-primary ">SAVE</button>
                    @else
                        <p class="flex-1">{{ $skill->skills }}</p>
                        <button wire:click="editSkill({{ $skill->id }})" class="edit-button ">EDIT</button>
                    @endif
                    <button wire:click="deleteSkill({{ $skill->id }})" class="delete-button">DELETE</button>
                </div>

            </div>
            @if ($editingSkillId === $skill->id)
                @error('editedSkill')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            @endif
        @empty
            <div class="text-center">
                Try to add a skill.
            </div>
        @endforelse
    </div>

    <div class="pagination">
        {{ $skills->links(data: ['scrollTo' => false]) }}
    </div>
</div>
