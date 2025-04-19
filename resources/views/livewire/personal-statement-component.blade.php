<div>
    {{-- Create New Statement --}}
    <div class="element-container">
        <h3>Create A New Personal Statement:</h3>
        <div class="flex items-center gap-2 w-full">
            <textarea wire:model="newStatement" placeholder="Add a personal statement..." class="input-field flex-grow resize-y"
                rows="1"></textarea>
            <button wire:click="createPersonalStatement" class="editing-button">CREATE</button>

            @if ($jobId)
                <button wire:click="checkPersonalStatementMatch" class="edit-button">MATCH</button>
            @endif

        </div>
        <div>
            @if ($score !== null)
                <div class="p-4 bg-white rounded-lg shadow w-full max-w-full">
                    <h4 class="text-xl font-semibold mb-2 text-green-600">Match Score: {{ $score }}%</h4>

                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">Matched Keywords:</h5>
                        <ul class="flex flex-wrap gap-2 mt-2">
                            @foreach ($matchedKeywords as $keyword)
                                <li class="keyword-badge">{{ $keyword }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h5 class="font-medium text-gray-700">Missing Keywords:</h5>
                        <ul class="flex flex-wrap gap-2 mt-2">
                            @foreach (array_diff($totalKeywords, $matchedKeywords) as $keyword)
                                <li class="keyword-badge keyword-badge--missing">{{ $keyword }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Show any error message if job not found --}}
            @if (session()->has('error'))
                <div class="alert-error mt-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>
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
