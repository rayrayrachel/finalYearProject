<div>
    <h1 class="highlighted-headers">{{ $profile->user_name }} {{ __('\'s Information') }}</h1>

    <div class="profile-information-container">
        <div class="profile-information-picture-container">
            @if ($profile->profile_picture)
                <img src="{{ asset('storage/' . $profile->profile_picture) }}"
                    alt="Profile picture of {{ $profile->user_name }}" class="profile-information-picture">
            @else
                <img src="{{ asset('images/default-pfp.gif') }}" alt="Default profile image"
                    class="profile-information-picture">
            @endif
        </div>

        <div class="profile-information-text-container space-y-2">

            <p class="profile-info">
                <strong>
                    @if ($profile->is_company)
                        {{ __('About Company:') }}
                    @else
                        {{ __('About Me:') }}
                    @endif
                </strong>
                {{ $profile->bio ?? 'No information provided' }}
            </p>

            <p class="profile-info">
                <strong>
                    @if ($profile->is_company)
                        {{ __('Official Website:') }}
                    @else
                        {{ __('Related Website:') }}
                    @endif
                </strong>
                @if ($profile->website)
                    <a href="{{ $profile->website }}" target="_blank" class="text-blue-500">
                        {{ $profile->website }}
                    </a>
                @else
                    {{ 'Not provided' }}
                @endif
            </p>

            <p class="profile-info">
                <strong>{{ __('Location:') }}</strong> {{ $profile->location ?? 'Not provided' }}
            </p>

            @if ($profile->date_of_birth)
                <p class="profile-info">
                    <strong>
                        @if ($profile->is_company)
                            {{ __('Company Start Date:') }}
                        @else
                            {{ __('Date of Birth:') }}
                        @endif
                    </strong>
                    {{ $profile->date_of_birth ?? 'Not provided' }}
                    <strong>{{ __('Years:') }}</strong>

                    @if ($profile->is_company)
                        {{ \Carbon\Carbon::parse($profile->date_of_birth)->age }} {{ __('years') }}
                    @else
                        {{ \Carbon\Carbon::parse($profile->date_of_birth)->age }} {{ __('years old') }}
                    @endif
                </p>
            @else
                <p class="profile-info"><strong>
                        @if ($profile->is_company)
                            {{ __('Company Start Date:') }}
                        @else
                            {{ __('Date of Birth:') }}
                        @endif
                    </strong> {{ 'Not provided' }}</p>
            @endif

            <p class="profile-info"><strong>{{ __('Account Created:') }}</strong>
                {{ $profile->created_at->diffForHumans() ?? 'Not provided' }}
            </p>
        </div>
    </div>

</div>
