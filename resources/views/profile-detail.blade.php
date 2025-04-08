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

        <div class="element-container-transparent mb-4">
            <livewire:company-stats :companyId="$profileId" />
        </div>

        <div class="element-container-transparent" id="job-list-part" style="display:;">
            <h3 class="text-lg font-semibold mb-2">Jobs From This Company </h3>
            <livewire:job-list :companyId="$profileId" />
        </div>

        <div class="element-container-transparent" id="comment-part" style="display:none;">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold mb-2">Thoughts On This Company</h3>

                @auth
                    <button id="toggleCommentButton" onclick="toggleCommentSection()"
                        class="bg-[#36c73b] text-white py-2 px-4 rounded">
                        Add Comment
                    </button>
                @endauth
            </div>

            <div id="commentSection" class="flex gap-4 hidden">
                <div class="w-2/3 h-full">
                    <livewire:comment-list :companyId="$profileId" class="h-full" />
                </div>

                <div class="w-1/3">
                    @auth
                        <livewire:create-comment :companyId="$profileId" />
                    @endauth
                </div>
            </div>

            <div id="commentListOnly">
                <livewire:comment-list :companyId="$profileId" class="h-full" wire:key="{{ $profileId }}" />
            </div>
        </div>

    </div>

    <script>
        Livewire.on('toggleSection', (section) => {
            const jobListPart = document.getElementById("job-list-part");
            const commentPart = document.getElementById("comment-part");

            if (section === 'jobs') {
                jobListPart.style.display = "";
                commentPart.style.display = "none";
            } else if (section === 'comments') {
                commentPart.style.display = "";
                jobListPart.style.display = "none";
            }
        });

        function toggleCommentSection() {
            const commentSection = document.getElementById("commentSection");
            const button = document.getElementById("toggleCommentButton");
            const commentListOnly = document.getElementById("commentListOnly");
            Livewire.dispatch('refreshCommentList');

            if (commentSection.classList.contains("hidden")) {
                commentSection.classList.remove("hidden");
                button.textContent = "Close Comment Section";
                button.classList.remove("bg-[#36c73b]");
                button.classList.add("bg-gray-300");

                commentListOnly.classList.add("hidden");
            } else {
                commentSection.classList.add("hidden");
                button.textContent = "Add Comment";
                button.classList.remove("bg-gray-300");
                button.classList.add("bg-[#36c73b]");

                commentListOnly.classList.remove("hidden");

            }
        }
    </script>
</x-app-layout>
