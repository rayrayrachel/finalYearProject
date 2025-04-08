<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="navbar-sticky-top">

    <div class="bg-teal-200 border-b border-white-100">
        <div class="below-sticky">
            <div class="max-w-7xl mx-auto px-2 sm:px-2 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="sm:ms-5 shrink-0 flex items-center">
                            @auth
                                <div class="shrink-0 flex items-center">
                                    <a href="{{ route('dashboard') }}" wire:navigate>
                                        <x-application-logo class="logo" />
                                    </a>
                                </div>
                            @endauth

                            @guest
                                <div class="shrink-0 flex items-center">
                                    <a href="{{ route('landing-page') }}" wire:navigate>
                                        <x-application-logo class="logo" />
                                    </a>
                                </div>
                            @endguest
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-2 sm:-my-px sm:ms-5 sm:flex justify-center">
                            @auth
                                <x-nav-link wire:navigate :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                                    onclick="window.dispatchEvent(new Event('DashboardClicked'))"
                                    class="w-20 text-center hover:bg-teal-600 hover:text-white justify-center {{ request()->routeIs('dashboard') ? 'bg-teal-600 text-white' : '' }}">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @endauth

                            @guest
                                <x-nav-link wire:navigate :href="route('landing-page')" :active="request()->routeIs('landing-page')"
                                    class="w-20 text-center hover:bg-teal-600 hover:text-white justify-center {{ request()->routeIs('landing-page') ? 'bg-teal-600 text-white' : '' }}">
                                    {{ __('Welcome') }}
                                </x-nav-link>
                            @endguest
                            <x-nav-link wire:navigate :href="route('job-list')" :active="request()->routeIs('job-list')"
                                class="w-20 text-center hover:bg-teal-600 hover:text-white justify-center {{ request()->routeIs('job-list') ? 'bg-teal-600 text-white' : '' }}">
                                {{ __('Jobs') }}
                            </x-nav-link>
                            <x-nav-link wire:navigate :href="route('company-list')" :active="request()->routeIs('company-list')"
                                class="w-20 text-center hover:bg-teal-600 hover:text-white justify-center {{ request()->routeIs('company-list') ? 'bg-teal-600 text-white' : '' }}">
                                {{ __('Companies') }}
                            </x-nav-link>
                        </div>
                    </div>


                    <div class="flex items-center space-x-2 ml-auto">

                        @guest
                            <a href="{{ route('login') }}"
                                class="rounded-md px-2 py-2 text-teal-600 hover:bg-gray-100 transition">
                                {{ __('LOGIN') }}
                            </a>
                            <a href="{{ route('register') }}"
                                class="rounded-md px-2 py-2 text-teal-600  hover:bg-gray-100 transition">
                                {{ __('REGISTER') }}
                            </a>
                        @endguest

                        @auth
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">

                                            <div class="flex items-center gap-2">
                                                <div>
                                                    <div
                                                        class="overflow-hidden w-8 h-8 rounded-full">
                                                        <img src="{{ auth()->user()->profile && auth()->user()->profile->profile_picture
                                                            ? asset('storage/' . auth()->user()->profile->profile_picture)
                                                            : asset('images/default-pfp.png') }}"
                                                            alt="{{ auth()->user()->profile->name ?? 'Profile' }}"
                                                            class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                                    x-on:profile-updated.window="name = $event.detail.name"></div>

                                                <div class="ms-1">
                                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile')" wire:navigate>
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <button wire:click="logout" class="w-full text-start">
                                            <x-dropdown-link>
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </button>
                                    </x-slot>
                                </x-dropdown>
                            </div>

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button @click="open = ! open"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>



            @auth
                <!-- Responsive Navigation Menu -->
                <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate
                            onclick="window.dispatchEvent(new Event('DashboardClicked'))">

                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                                x-on:profile-updated.window="name = $event.detail.name"></div>
                            <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-responsive-nav-link>
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </button>
                        </div>
                    </div>
                </div>
            @endauth

        </div>
    </div>


</nav>
