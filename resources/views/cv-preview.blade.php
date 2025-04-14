<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview CV') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <livewire:cv-preview :cv-id="$cvId" />
    </div>
</x-app-layout>
