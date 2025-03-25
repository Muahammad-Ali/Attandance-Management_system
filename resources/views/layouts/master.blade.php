<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="md:!pl-0" id="main">
    <div class="flex h-screen">

        {{-- sidebar --}}
        <aside class="lg:w-70">
            <x-sidebar />
        </aside>

        <div class="flex-1 p-4 max-lg:w-full ">
            <header class="flex items-center justify-end mb-8 max-lg:justify-between">
                {{-- toggle button --}}
                <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                    aria-controls="default-sidebar" type="button"
                    class="inline-flex items-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    {{-- open sidebar toggle icon --}}
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>


                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" type="button">
                    <img src="{{ asset('images/profile.png') }}" alt="Profile"
                        class="w-8 h-8 rounded-full cursor-pointer">
                </button>

                <!-- user profile dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden bg-black divide-y divide-gray-800 rounded-lg shadow w-44">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-700" aria-labelledby="dropdownHoverButton">
                            <!-- Authentication -->
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                    this.closest('form').submit();"
                                    class="block px-4 py-2 hover:bg-red-500 hover:text-black dark:hover:bg-gray-600 dark:hover:text-black"><i
                                        class="mr-2 fas fa-power-off"></i>Logout</a>
                            </li>
                        </ul>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <div class="lg:p-6">
                {{ $slot }}
            </div>
        </div>

    </div>


   {{-- CDN chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{ $script ?? '' }}

</body>

</html>
