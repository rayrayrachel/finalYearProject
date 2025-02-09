<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job List') }}
        </h2>
    </x-slot>
    <div class="page-container">
        <livewire:job-list />
    </div>
</x-app-layout>
