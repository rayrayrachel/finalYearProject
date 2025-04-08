<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CV Component') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <livewire:c-v-component />
    </div>
</x-app-layout>
