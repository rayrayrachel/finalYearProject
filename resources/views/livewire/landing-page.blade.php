<div>
    <div>
        <div class="element-container">

            <div class="text-center py-20">
                <h1 class="welcoming-header"> AI Job Hunter hunts the best company and employee.
                </h1>
                <h3 class="welcoming-message">Find your dream job with AI-powered CV optimization.</h3>

                <x-nav-link wire:navigate :href="route('register')" :active="request()->routeIs('register')"
                    class="welcoming-button">
                    {{ __('Register') }}
                </x-nav-link>

            </div>
        </div>

    </div>

</div>
