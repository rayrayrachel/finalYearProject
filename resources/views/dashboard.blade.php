<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="p-6 text-gray-900">
            @if (auth()->user()->profile && auth()->user()->profile->is_company)
                <div class="flex justify-between items-center">
                    <span>
                        <h1
                            style="font-size: 2rem; font-weight: bold; color: #333; text-align: center; margin: 20px 0; letter-spacing: 1px; line-height: 1.2;">
                            Your Job Listings
                        </h1>
                    </span>
                    <span>
                        <div class="mb-4">
                            <a href="{{ route('create-job') }}" class="btn btn-primary">
                                {{ __('CREATE JOB') }}
                            </a>

                            <livewire:create-job>
                        </div>
                        <div class="mb-4">
                            <a href="{{ route('create-job') }}" class="btn btn-primary">
                                {{ __('Profile') }}
                            </a>
                        </div>
                    </span>
                </div>
                <livewire:job-list :userId="auth()->user()->profile->id" :context="'company-dashboard'" />
            @else
                <p>You're logged in as a Hunter!</p>
            @endif
        </div>
    </div>
</x-app-layout>
