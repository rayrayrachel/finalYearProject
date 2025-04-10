<div>
    <div class="element-container">
        <div class="input-div flex items-start w-full">
            <textarea wire:model="newStatement" placeholder="Add a personal statement..." class="input-field flex-grow resize-y"
                rows="1"></textarea>
            <button wire:click="createPersonalStatement" class="btn-primary ml-auto">Create</button>
        </div>
    </div>
    <div class="element-container-transparent">

        @foreach ($personalStatements as $statement)
            <div class="element-container flex justify-between items-center">
                <div class="flex gap-2 w-full">
                    @if ($editingStatementId === $statement->id)
                        <textarea wire:model="editedStatement" class="input-field flex-grow resize-y" rows="1"></textarea>
                        <button wire:click="saveEditedPersonalStatement" class="btn-primary ml-auto">Save</button>
                    @else
                        <p class="flex-1">{{ $statement->statement }}</p>

                        <button wire:click="editPersonalStatement({{ $statement->id }})"
                            class="edit-button ml-auto">Edit</button>
                    @endif
                    <button wire:click="deletePersonalStatement({{ $statement->id }})"
                        class="delete-button">Delete</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{ $personalStatements->links(data: ['scrollTo' => false]) }}
    </div>
</div>
