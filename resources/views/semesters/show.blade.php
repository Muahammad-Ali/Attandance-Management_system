@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Semester Details</h1>
        <div>
            <a href="{{ route('semesters.edit', $semester) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-700 transition mr-2">
                Edit Semester
            </a>
            <a href="{{ route('semesters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-900 transition">
                Back to Semesters
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-6">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Basic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Department</h3>
                    <p class="mt-1 text-lg">{{ $semester->department->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Semester Number</h3>
                    <p class="mt-1 text-lg">{{ $semester->semester_number }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Name</h3>
                    <p class="mt-1 text-lg">{{ $semester->name ?: 'Not specified' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Status</h3>
                    <p class="mt-1">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $semester->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $semester->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Start Date</h3>
                    <p class="mt-1 text-lg">{{ $semester->start_date ? $semester->start_date->format('M d, Y') : 'Not specified' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">End Date</h3>
                    <p class="mt-1 text-lg">{{ $semester->end_date ? $semester->end_date->format('M d, Y') : 'Not specified' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Timetables for This Semester</h2>
            
            @if($semester->timetables->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CR</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($semester->timetables as $timetable)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $timetable->day }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $timetable->start_time }} - {{ $timetable->end_time }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $timetable->subject->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $timetable->teacher->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $timetable->cr->cr_name ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No timetables have been created for this semester yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection 