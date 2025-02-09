<div>
    <div>
        <div class="element-container">

            <div class="text-center py-20">
                <h1 class="text-4xl font-bold text-teal-600 mb-6"> AI Job Hunter hunts the best company and employee.
                </h1>
                <h3 class="text-gray-700 mb-8">Find your dream job with AI-powered CV optimization.</h3>

                <x-nav-link wire:navigate :href="route('register')" :active="request()->routeIs('register')"
                    class="register-btn text-lg text-indigo-600 hover:text-indigo-800 hover:transition duration-300 ease-in-out 
    focus:text-indigo-800 active:text-indigo-800">
                    {{ __('Register') }}
                </x-nav-link>

            </div>
        </div>

    </div>

</div>
