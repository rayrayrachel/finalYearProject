<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Page') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <livewire:application-page :jobId="$jobId" />
    </div>
</x-app-layout>
