<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My CVs') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <livewire:c-v-history />
    </div>
</x-app-layout>
