<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-container">
 <div class="p-6 text-gray-900">
                    @if (auth()->user()->profile && auth()->user()->profile->is_company)
                        <p>You're logged in as a Company!</p>
                        <div>
                            <h3>Your Job Listings</h3>
                            <livewire:job-list :userId="auth()->user()->profile->id" :context="'company-dashboard'" />
                        </div>
                    @else
                        <p>You're logged in as a Hunter!</p>
                    @endif

                </div>

    </div>
</x-app-layout>
