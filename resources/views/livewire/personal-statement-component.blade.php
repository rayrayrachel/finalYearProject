<div>
    <div class="element-container">
        <h3>Create A New Personal Statement:</h3>

        <div class="flex items-center w-full">
            <textarea wire:model="newStatement" placeholder="Add a personal statement..." class="input-field flex-grow resize-y"
                rows="1"></textarea>
            <button wire:click="createPersonalStatement" class="btn-primary ml-auto">CREATE</button>
        </div>
    </div>

    @error('newStatement')
        <div class="alert-error">{{ $message }}</div>
    @enderror
    <div class="element-container-transparent">
        <h3>List of Personal Statement History:</h3>
        @forelse ($personalStatements as $statement)
            <div class="element-container flex justify-between items-center">
                <div class="flex gap-2 w-full">
                    @if ($editingStatementId === $statement->id)
                        <textarea wire:model="editedStatement" class="input-field flex-grow resize-y" rows="1"></textarea>
                        <button wire:click="saveEditedPersonalStatement" class="btn-primary ml-auto">SAVE</button>
                    @else
                        <p class="flex-1 overflow-hidden">{{ $statement->statement }}</p>

                        <button wire:click="editPersonalStatement({{ $statement->id }})"
                            class="edit-button ml-auto">Edit</button>
                    @endif
                    <button wire:click="deletePersonalStatement({{ $statement->id }})"
                        class="delete-button">DELETE</button>
                </div>
            </div>
            @if ($editingStatementId === $statement->id)
                @error('editedStatement')
                    <div class="alert-error">{{ $message }}</div>
                @enderror
            @endif

        @empty
            <div class="text-center">
                Try to add a personal statement.
            </div>
        @endforelse

        <div class="pagination">
            {{ $personalStatements->links(data: ['scrollTo' => false]) }}
        </div>
    </div>

</div>
