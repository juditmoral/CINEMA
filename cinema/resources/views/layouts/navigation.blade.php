<nav x-data="{ open: false }" class="bg-transparent">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}">
                        <div class="w-24 h-24 "> <!-- Ajusta el tamaño aquí -->
                            @include('components.application-logo')
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-red-500 transition">
                        {{ __('Registrar-se') }}
                    </x-nav-link>
                </div>

                @auth
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('tiquets')" :active="request()->routeIs('tiquets')" class="text-white hover:text-red-500 transition">
                        {{ __('Tiquets') }}
                    </x-nav-link>
                </div>
                @endauth

                

                <!-- Localization Links -->
                <div class="pl-10 hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-white hover:text-red-500 transition">
                                <div>{{ App::currentLocale() }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current text-white hover:text-red-500 h-4 w-4 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @foreach (['ca', 'en', 'es'] as $l)
                                @if ($l != App::currentLocale())
                                    <x-dropdown-link :href="url('/lang/'.$l)" class="text-black hover:text-red-500 transition">
                                        {{ $l }}
                                    </x-dropdown-link>
                                @endif
                            @endforeach
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            @auth
                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-red-500 transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current text-white hover:text-red-500 h-4 w-4 transition" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="text-black hover:text-red-500 transition">
                                {{ __('Perfil') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="text-black hover:text-red-500 transition" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Sortir') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-red-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-red-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-white hover:text-red-500 transition">
                {{ __('Registrar-se') }}
            </x-responsive-nav-link>
        </div>

        @auth
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('tiquets')" :active="request()->routeIs('tiquets')" class="text-white hover:text-red-500 transition">
                {{ __('Tiquets') }}
            </x-responsive-nav-link>
        </div>
        @endauth


        


    </div>
</nav>
