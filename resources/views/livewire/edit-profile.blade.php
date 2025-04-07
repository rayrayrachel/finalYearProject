<div class="element-container">
    <form wire:submit.prevent="updateProfile" class="space-y-6">
        @csrf

        <h2 class="text-2xl font-semibold text-gray-700">Edit Your Profile</h2>

        <div class="form-group">
            <label for="bio" class="form-label">{{ $isCompany ? 'Company Description' : 'Bio' }}</label>
            <textarea id="bio" wire:model="bio" class="form-input"></textarea>
            @error('bio')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="website" class="form-label">{{ $isCompany ? 'Official Website' : 'Website' }}</label>
            <input type="url" id="website" wire:model="website" class="form-input">
            @error('website')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" id="profile_picture" wire:model="profile_picture" class="form-input">
            @error('profile_picture')
                <span class="form-error">{{ $message }}</span>
            @enderror
            <div class="edit-pfp-container">
                @if ($profile_picture && is_object($profile_picture))
                    <div class="mt-3">
                        <p class="text-sm text-gray-500">Preview:</p>
                        <img src="{{ $profile_picture->temporaryUrl() }}" class="edit-pfp"
                            alt="New profile picture preview">
                    </div>
                @elseif ($profile_picture)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500">Current:</p>
                        <img src="{{ asset('storage/' . $profile_picture) }}" class="edit-pfp"
                            alt="Current profile picture">
                    </div>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="location" class="form-label">Location</label>
            <input type="text" id="location" wire:model="location" class="form-input">
            @error('location')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_of_birth"
                class="form-label">{{ $isCompany ? 'Company Start Date' : 'Date of Birth' }}</label>
            <input type="date" id="date_of_birth" wire:model="date_of_birth" class="form-input">
            @error('date_of_birth')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <button type="submit" class="btn-primary">Update Profile</button>
        </div>
    </form>

    @if (session()->has('message'))
        <div class="alert-success mt-4">
            {{ session('message') }}
        </div>
    @endif
</div>
