<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create CV') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <livewire:create-c-v-page />
    </div>
</x-app-layout>
