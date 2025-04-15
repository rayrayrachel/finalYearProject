<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="page-container">
        @livewire('job-detail', ['jobId' => $jobId, 'from' => 'jobDetailPage'])
        @livewire('received-applications', ['jobId' => $jobId])
    </div>
</x-app-layout>
