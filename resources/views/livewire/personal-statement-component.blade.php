<div>
    {{-- Create New Statement --}}
    <div class="element-container">
        <h3>Create A New Personal Statement:</h3>
        <div class="flex items-center gap-2 w-full">
            <textarea wire:model="newStatement" placeholder="Add a personal statement..." class="input-field flex-grow resize-y"
                rows="1"></textarea>
            <button wire:click="createPersonalStatement" class="editing-button">CREATE</button>
            <button wire:click="checkLSTM" class="match-button2">RATE</button>

            @if ($jobId)
                <button wire:click="checkPersonalStatementMatch" class="match-button">MATCH</button>
            @endif

        </div>
        @livewire('cv-matcher-component')
        @livewire('check-statement')


    </div>

    @error('newStatement')
        <div class="alert-error">The statement created must not be greater than 1000 characters.</div>
    @enderror

    {{-- Statement History --}}
    <div class="element-container-transparent">
        <h3>List of Personal Statement History:</h3>

        @forelse ($personalStatements as $statement)
            <div
                class="element-container flex justify-between items-center {{ $selectedPersonalStatementId === $statement->id ? 'bg-blue-100 border-blue-400 border-l-4' : '' }}">
                <div class="flex items-center gap-2 w-full">
                    @if ($editingStatementId === $statement->id)
                        <textarea wire:model="editedStatement" class="input-field flex-grow resize-y" rows="1"></textarea>
                        <button wire:click="saveEditedPersonalStatement" class="editing-button">SAVE</button>
                        <button wire:click="$set('editingStatementId', null)" class="cancel-button">CANCEL</button>
                    @else
                        <p class="flex-1 overflow-hidden">{{ $statement->statement }}</p>
                        @if ($creatingCV)
                            <button wire:click="select({{ $statement->id }})" class="editing-button">SELECT</button>
                        @endif
                        <button wire:click="editPersonalStatement({{ $statement->id }})"
                            class="edit-button ml-auto">EDIT</button>
                        @if (!$creatingCV)
                            <button wire:click="deletePersonalStatement({{ $statement->id }})"
                                class="delete-button">DELETE</button>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center text-gray-600 mt-4">
                You haven't added any personal statements yet.
            </div>
        @endforelse

        {{-- Pagination --}}
        <div class="pagination">
            {{ $personalStatements->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
