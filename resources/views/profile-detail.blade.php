<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    
    <div class="page-container">
        <div class="element-container">
            <livewire:profile-detail :userId="Auth::id()" />
        </div>
    </div>
</x-app-layout>
