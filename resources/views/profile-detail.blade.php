<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Details') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="element-container">
            <livewire:profile-detail :profileId="$profileId" />
        </div>

        <div class="element-container">
            <livewire:comment-list :companyId="$profileId" />
        </div>
    </div>



</x-app-layout>
