<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-container">
        <div class="p-6 text-gray-900">
            @if (auth()->user()->profile && auth()->user()->profile->is_company)
                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'JobListing')">JobListing</button>
                    <button id="defaultOpenTabCom" class="tablinks" onclick="openTab(event, 'Profile')">Profile</button>
                    <button class="tablinks" onclick="openTab(event, 'Applications')">Applications</button>
                    <button class="tablinks" onclick="openTab(event, 'Comments')">Comments</button>
                </div>
            @else
                <div class="tab">
                    <button class="tablinks" onclick="openTab(event, 'HunterApplications')">Applications</button>
                    <button id="defaultOpenTabHun" class="tablinks" onclick="openTab(event, 'Profile')">Profile</button>
                    <button class="tablinks" onclick="openTab(event, 'Comments')">Comments</button>
                    <button class="tablinks" onclick="openTab(event, 'MyCV')">My CV</button>

                </div>
            @endif

            <div id="JobListing" class="tabcontent">

                <div class="element-container">
                    <div class="create-job-form">
                        <div class="flex justify-between items-center ">
                            <h1
                                style="font-size: 2rem; font-weight: bold; color: #333; text-align: center; margin: 20px 0; letter-spacing: 1px; line-height: 1.2;">
                                Your Job Listings
                            </h1>
                            <button id="toggleCreateJobButton" onclick="toggleCreateJobForm()"
                                class="btn btn-primary bg-[#36c73b]">
                                CREATE JOB
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
            </div>

            <div id="Profile" class="tabcontent">
                <div class="element-container">
                    <div class="flex justify-between items-center">
                        <h1> Contact Infomration Displayed To Others </h1>
                        <a href="{{ route('edit-profile') }}" class="btn btn-primary align-item-end" wire:navigate>
                            EDIT
                        </a>
                    </div>
                    <livewire:profile-detail :profileID="Auth::id()" />
                </div>
            </div>


            <div id="Applications" class="tabcontent">
                <div class="element-container">
                    <h1>Applications</h1>
                    <p>TODO Applications .</p>
                </div>

            </div>


            <div id="HunterApplications" class="tabcontent">
                <div class="element-container">
                    <h1>Applications</h1>
                    <p>TODO Applications .</p>
                </div>
            </div>

            <div id="Comments" class="tabcontent">
                <div class="element-container">
                    <h1> Your Comments On Other Company </h1>
                    <livewire:comment-list :hunterId="Auth::id()" class="h-full"
                        wire:key="{{ 'user-comments-' . Auth::id() }}" />
                </div>
            </div>

            <div id="MyCV" class="tabcontent">
                <div class="element-container">
                    <h1>My CV</h1>
                    <livewire:c-v-page/>
                </div>
            </div>
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

        function openDefaultTab() {
            setTimeout(() => {
                const defaultTab = document.getElementById("defaultOpenTabCom") ?? document.getElementById(
                    "defaultOpenTabHun");
                if (defaultTab) {
                    defaultTab.click();
                } else {
                    console.warn("No default tab found.");
                }
            }, 100);
        }

        function openTab(evt, tabName) {
            const tabcontent = document.getElementsByClassName("tabcontent");
            for (let i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            const tablinks = document.getElementsByClassName("tablinks");
            for (let i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            const tab = document.getElementById(tabName);
            if (tab) {
                tab.style.display = "block";
                evt.currentTarget.className += " active";
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            openDefaultTab();
        });

        window.addEventListener("DashboardClicked", function() {
            openDefaultTab();

            fetch('/log-dashboard-click', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({})
                })
                .then(response => {
                    if (!response.ok) throw new Error("Failed to log click");
                    return response.json();
                })
                .then(data => console.log("Dashboard click logged:", data))
                .catch(error => console.error("Error logging dashboard click:", error));
        });

        Livewire.hook('message.processed', () => {
            openDefaultTab();
        });

        Livewire.on('DashboardClicked', () => {
            openDefaultTab();
        });
    </script>

</x-app-layout>
