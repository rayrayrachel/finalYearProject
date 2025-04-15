<div class="element-container" x-data="{ section: 'null' }">

    {{-- Job Detail --}}
    <div>
        <h2 class="cv-section-heading text-center ">Job Details</h2>
        @livewire('job-detail', ['jobId' => $jobId, 'from' => 'null'])
    </div>



    {{-- Selected CV --}}
    <h2 class="cv-section-heading text-center ">CV For This Application</h2>

    <div class="element-container">

        @if ($cvid)
            <div class="flex">
                <button class="delete-button ml-auto" wire:click="removeSelectedCV">
                    REMOVE
                </button>
            </div>
            <livewire:cv-preview :cv-id="$cvid" />
        @else
            No CV selected or tailored.
        @endif
    </div>

    @if ($cvChosen === false)
        <div class="flex mb-6">
            <button class="mx-2" @click="section = 'createCV'"
                :class="section === 'createCV' ? 'btn-primary' : 'edit-button'">
                TAILOR CV
            </button>
            <button class="mx-2" @click="section = 'cvHistory'"
                :class="section === 'cvHistory' ? 'btn-primary' : 'edit-button'">
                SELECT CV
            </button>

            <button class="mx-2 ml-auto" @click="section = 'null'"
                :class="section === 'null' ? 'btn-primary' : 'edit-button'">
                CLOSE
            </button>
        </div>

        {{-- Create CV --}}
        <div x-show="section === 'createCV'" x-transition>
            <h2 class="cv-section-heading text-center ">Tailor A CV for This Application</h2>
            <livewire:create-c-v-page :createApplication="true" />

        </div>

        {{-- CV History --}}
        <div x-show="section === 'cvHistory'" x-transition>
            <h2 class="cv-section-heading text-center ">Select A CV</h2>
            @livewire('c-v-history', ['creatingApplication' => true])
        </div>
    @else
        <div class="cv-section-heading text-center">
            <h2>Cover Letter</h2>
        </div>

        <div class="element-container">
            <textarea wire:model="coverLetter" placeholder="Write your cover letter here..." class="input-field w-max"
                rows="5"></textarea>

        </div>

        <!-- Apply Button -->
        <div class="flex mb-6">
            <button class="text-center welcoming-button" wire:click="submitApplication">
                APPLY
            </button>
        </div>
    @endif



</div>
