{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="p-6 text-gray-900">
            @if (auth()->user()->profile && auth()->user()->profile->is_company)
                                <div class="element-container">
                        <livewire:create-job>
                    </div>
                <div class="flex justify-between items-center">



                    <span>
                        <h1
                            style="font-size: 2rem; font-weight: bold; color: #333; text-align: center; margin: 20px 0; letter-spacing: 1px; line-height: 1.2;">
                            Your Job Listings
                        </h1>
                    </span>
                    <span>
                        {{-- <div class="mb-4">
                            <a href="{{ route('post-job') }}" class="btn btn-primary">
                                {{ __('CREATE JOB') }}
                            </a>
                        </div> --}}
{{-- 
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
</x-app-layout>  --}}


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="p-6 text-gray-900">
            @if (auth()->user()->profile && auth()->user()->profile->is_company)
                <div class="element-container">
                    <div class="create-job-form">
                        <div class="flex justify-between items-center ">
                            <h1
                                style="font-size: 2rem; font-weight: bold; color: #333; text-align: center; margin: 20px 0; letter-spacing: 1px; line-height: 1.2;">
                                Your Job Listings
                            </h1>
                            <button id="toggleCreateJobButton" onclick="toggleCreateJobForm()"
                                class="btn btn-primary bg-[#36c73b]">
                                Create Job
                            </button>
                        </div>

                        <div class="flex">
                            <div id="jobList" class="w-full transition-all">
                                <livewire:job-list :userId="auth()->user()->profile->id" :context="'company-dashboard'" />
                            </div>

                            <div id="createJobForm" class="hidden transition-all">
                                <div class="element-container w-full">
                                    <livewire:create-job />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>You're logged in as a Hunter!</p>
            @endif
        </div>
    </div>

    <script>
        function toggleCreateJobForm() {
            const form = document.getElementById("createJobForm");
            const button = document.getElementById("toggleCreateJobButton");
            const jobList = document.getElementById("jobList");

            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
                button.textContent = "CLOSE";
                jobList.classList.add("lg:w-2/3");
                button.classList.remove("bg-[#36c73b]");
                button.classList.add("bg-gray-300");
            } else {
                form.style.display = "none";
                button.textContent = "Create Job";
                jobList.classList.remove("lg:w-2/3");
                button.classList.remove("bg-gray-300");
                button.classList.add("bg-[#36c73b]");
            }
        }
    </script>
</x-app-layout>
