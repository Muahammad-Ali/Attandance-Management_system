<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex min-h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="lg:block hidden w-72 bg-white border-r">
            <x-sidebar />
        </aside>

        <!-- Main Layout -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="flex items-center justify-between px-4 py-4 shadow-sm bg-white">
                <div class="lg:hidden">
                    <!-- Mobile Sidebar Toggle (if needed in future) -->
                    <button id="toggleSidebar" class="text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="flex items-center space-x-4 ml-auto">
                    <!-- <span class="text-sm font-medium">{{ Auth::user()->name }}</span> -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            {{--  --}}

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="flex-1 px-4 py-6 sm:px-6 lg:px-8 w-full">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
