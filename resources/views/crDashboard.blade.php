<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - CR Dashboard</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex min-h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="lg:block hidden w-72 bg-white border-r">
            <!-- You can create a CR sidebar later -->
            <div class="p-6">
                <h1 class="text-xl font-bold">CR Dashboard</h1>
                <nav class="mt-6 space-y-2">
                    <a href="{{ route('cr.dashboard') }}" class="block px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md">
                        <i class="fas fa-home mr-2"></i> Dashboard
                    </a>
                    <a href="{{ route('cr.attendance.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-md">
                        <i class="fas fa-clipboard-check mr-2"></i> Teacher Attendance
                    </a>
                    <a href="{{ route('cr.feedback.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-md">
                        <i class="fas fa-comment-alt mr-2"></i> Subject Feedback
                    </a>
                </nav>
            </div>
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
                    <span class="text-sm font-medium">
                        @if(Auth::guard('cr')->check())
                            {{ Auth::guard('cr')->user()->cr_name }}
                        @else
                            Guest
                        @endif
                    </span>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100">
                                <svg class="h-4 w-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
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

            <!-- Main Content -->
            <main class="flex-1 p-6">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Welcome to CR Dashboard</h1>
                    <p class="text-gray-600 mt-2">Manage attendance and view class information</p>
                </div>

                @if(Auth::guard('cr')->check())
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Your Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-600">Name</p>
                                <p class="font-medium">{{ Auth::guard('cr')->user()->cr_name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Email</p>
                                <p class="font-medium">{{ Auth::guard('cr')->user()->cr_email }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Registration Number</p>
                                <p class="font-medium">{{ Auth::guard('cr')->user()->reg_no }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Section</p>
                                <p class="font-medium">{{ Auth::guard('cr')->user()->section }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600">Semester</p>
                                <p class="font-medium">{{ Auth::guard('cr')->user()->semester }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned Semesters Section -->
                    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Your Assigned Semesters</h2>
                        
                        @php
                            $cr = Auth::guard('cr')->user();
                        @endphp
                        
                        @if($cr->semesters->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($cr->semesters as $semester)
                                    <div class="border rounded-lg p-4 bg-indigo-50">
                                        <div class="font-semibold text-indigo-700">
                                            {{ $semester->department->name }} - Semester {{ $semester->semester_number }}
                                        </div>
                                        <div class="text-sm text-gray-600 mt-1">
                                            {{ $semester->name ?: 'Semester ' . $semester->semester_number }}
                                        </div>
                                        @if($semester->start_date && $semester->end_date)
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $semester->start_date->format('M d, Y') }} - {{ $semester->end_date->format('M d, Y') }}
                                            </div>
                                        @endif
                                        <div class="mt-3">
                                            <a href="#" 
                                               onclick="showTimetable({{ $semester->id }})"
                                               class="text-indigo-600 text-sm hover:text-indigo-800">
                                                View Timetable <i class="fas fa-chevron-right ml-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-gray-500">You are not assigned to any semesters yet.</div>
                        @endif
                    </div>

                    <!-- Timetable Display Section (Hidden by default) -->
                    @if(isset($cr))
                        @foreach($cr->semesters as $semester)
                            <div id="timetable-{{ $semester->id }}" class="timetable-section bg-white shadow-md rounded-lg p-6 mb-6 hidden">
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-xl font-semibold">
                                        {{ $semester->department->name }} - Semester {{ $semester->semester_number }} Timetable
                                    </h2>
                                    <button onclick="hideTimetable({{ $semester->id }})" class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                
                                @php
                                    $timetablesByDay = $semester->timetables->groupBy('day');
                                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                @endphp
                                
                                <!-- Days of the Week Tabs -->
                                <div class="mb-6">
                                    <div class="border-b border-gray-200">
                                        <nav class="-mb-px flex space-x-2">
                                            @foreach($days as $day)
                                                <button class="day-tab px-4 py-2 font-medium text-sm {{ isset($timetablesByDay[$day]) ? 'text-indigo-600 border-b-2 border-indigo-500' : 'text-gray-500 hover:text-gray-700' }}"
                                                        data-semesterid="{{ $semester->id }}"
                                                        data-day="{{ $day }}">
                                                    {{ $day }}
                                                    @if(isset($timetablesByDay[$day]))
                                                        <span class="ml-1 bg-indigo-100 text-indigo-800 text-xs px-1.5 py-0.5 rounded">
                                                            {{ $timetablesByDay[$day]->count() }}
                                                        </span>
                                                    @endif
                                                </button>
                                            @endforeach
                                        </nav>
                                    </div>
                                </div>
                                
                                <!-- Timetable Content -->
                                @if($semester->timetables->isEmpty())
                                    <div class="text-center py-8 text-gray-500">
                                        No classes have been scheduled for this semester yet.
                                    </div>
                                @else
                                    @foreach($days as $day)
                                        <div id="day-{{ $semester->id }}-{{ $day }}" class="day-content {{ isset($timetablesByDay[$day]) ? '' : 'hidden' }}">
                                            @if(isset($timetablesByDay[$day]))
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead class="bg-gray-50">
                                                        <tr>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach($timetablesByDay[$day]->sortBy('start_time') as $timetable)
                                                            <tr>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="text-sm text-gray-900">
                                                                        {{ \Carbon\Carbon::parse($timetable->start_time)->format('h:i A') }} - 
                                                                        {{ \Carbon\Carbon::parse($timetable->end_time)->format('h:i A') }}
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $timetable->subject->subject_name ?? 'N/A' }}
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="text-sm text-gray-500">
                                                                        {{ $timetable->teacher->name ?? 'N/A' }}
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 whitespace-nowrap">
                                                                    <div class="text-sm text-gray-500">
                                                                        {{ $timetable->classroom ?? 'N/A' }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="text-center py-8 text-gray-500">
                                                    No classes scheduled for {{ $day }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    @endif
                @else
                    <div class="bg-red-100 text-red-700 p-4 rounded-md">
                        You are not logged in as a CR. Please log in.
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script>
        // Timetable display functionality
        function showTimetable(semesterId) {
            // Hide all timetable sections
            document.querySelectorAll('.timetable-section').forEach(section => {
                section.classList.add('hidden');
            });
            
            // Show the selected timetable
            document.getElementById(`timetable-${semesterId}`).classList.remove('hidden');
            
            // Scroll to the timetable
            document.getElementById(`timetable-${semesterId}`).scrollIntoView({ behavior: 'smooth' });
        }
        
        function hideTimetable(semesterId) {
            document.getElementById(`timetable-${semesterId}`).classList.add('hidden');
        }
        
        // Tab functionality for each timetable
        document.addEventListener('DOMContentLoaded', function() {
            const dayTabs = document.querySelectorAll('.day-tab');
            
            dayTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const semesterId = tab.getAttribute('data-semesterid');
                    const day = tab.getAttribute('data-day');
                    
                    // Hide all day content for this semester
                    document.querySelectorAll(`[id^="day-${semesterId}-"]`).forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Reset all tabs for this semester
                    document.querySelectorAll(`.day-tab[data-semesterid="${semesterId}"]`).forEach(t => {
                        t.classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-500');
                        t.classList.add('text-gray-500', 'hover:text-gray-700');
                    });
                    
                    // Show the selected day and activate its tab
                    document.getElementById(`day-${semesterId}-${day}`).classList.remove('hidden');
                    tab.classList.add('text-indigo-600', 'border-b-2', 'border-indigo-500');
                    tab.classList.remove('text-gray-500', 'hover:text-gray-700');
                });
            });
        });
    </script>
</body>

</html> 