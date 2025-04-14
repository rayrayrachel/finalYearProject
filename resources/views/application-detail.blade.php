<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview Application') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <livewire:application-detail :applicationId="$applicationId" />
    </div>
</x-app-layout>
