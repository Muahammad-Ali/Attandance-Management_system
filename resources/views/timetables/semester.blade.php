<x-master-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $semester->department->name }} - Semester {{ $semester->semester_number }}</h1>
                <p class="text-gray-600">Timetable Schedule</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('timetables.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                    Back to Programs
                </a>
                <a href="{{ route('timetables.create', $semester->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                    Add Class
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Days of the Week Tabs -->
        <div class="mb-6">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex space-x-2">
                    @foreach($days as $day)
                        <button class="day-tab px-4 py-2 font-medium text-sm {{ isset($sortedTimetable[$day]) ? 'text-indigo-600 border-b-2 border-indigo-500' : 'text-gray-500 hover:text-gray-700' }}"
                                data-day="{{ $day }}">
                            {{ $day }}
                            @if(isset($sortedTimetable[$day]))
                                <span class="ml-1 bg-indigo-100 text-indigo-800 text-xs px-1.5 py-0.5 rounded">
                                    {{ $sortedTimetable[$day]->count() }}
                                </span>
                            @endif
                        </button>
                    @endforeach
                </nav>
            </div>
        </div>

        <!-- Timetable Content -->
        @if($semester->timetables->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <p class="text-gray-500 mb-4">No classes have been scheduled for this semester yet.</p>
                <a href="{{ route('timetables.create', $semester->id) }}" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                    Schedule First Class
                </a>
            </div>
        @else
            @foreach($days as $day)
                <div id="day-{{ $day }}" class="day-content {{ isset($sortedTimetable[$day]) ? '' : 'hidden' }}">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if(isset($sortedTimetable[$day]))
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CR</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Room</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($sortedTimetable[$day] as $timetable)
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
                                                    {{ $timetable->cr->cr_name ?? 'None' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">
                                                    {{ $timetable->classroom ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <a href="{{ route('timetables.edit', $timetable->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('timetables.destroy', $timetable->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this class?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="p-6 text-center text-gray-500">
                                No classes scheduled for {{ $day }}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        // Tab functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dayTabs = document.querySelectorAll('.day-tab');
            const dayContents = document.querySelectorAll('.day-content');

            // Show the first day with content by default
            const firstVisibleDay = document.querySelector('.day-content:not(.hidden)');
            if (firstVisibleDay) {
                const day = firstVisibleDay.id.replace('day-', '');
                document.querySelector(`.day-tab[data-day="${day}"]`).classList.add('text-indigo-600', 'border-b-2', 'border-indigo-500');
                document.querySelector(`.day-tab[data-day="${day}"]`).classList.remove('text-gray-500', 'hover:text-gray-700');
            }

            dayTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    const day = tab.getAttribute('data-day');

                    // Hide all content and reset all tabs
                    dayContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    dayTabs.forEach(t => {
                        t.classList.remove('text-indigo-600', 'border-b-2', 'border-indigo-500');
                        t.classList.add('text-gray-500', 'hover:text-gray-700');
                    });

                    // Show the selected content and activate the tab
                    document.getElementById(`day-${day}`).classList.remove('hidden');
                    tab.classList.add('text-indigo-600', 'border-b-2', 'border-indigo-500');
                    tab.classList.remove('text-gray-500', 'hover:text-gray-700');
                });
            });
        });
    </script>
</x-master-layout>
