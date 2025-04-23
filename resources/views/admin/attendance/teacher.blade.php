@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Teacher Attendance Statistics</h1>
        <p class="text-gray-600">View detailed attendance statistics for individual teachers</p>
    </div>

    <!-- Filters -->
    <div class="p-4 mb-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-semibold text-gray-700">Select Teacher and Period</h2>
        <form action="{{ route('admin.attendance.teacher') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <!-- Teacher Selection -->
            <div>
                <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-1">Teacher</label>
                <select id="teacher_id" name="teacher_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                    @foreach($teachers as $t)
                        <option value="{{ $t->id }}" {{ $teacher->id == $t->id ? 'selected' : '' }}>
                            {{ $t->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Month Selection -->
            <div>
                <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                <input type="month" id="month" name="month" value="{{ request('month', \Carbon\Carbon::now()->format('Y-m')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
            </div>
            
            <!-- Subject Selection -->
            <div>
                <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <select id="subject_id" name="subject_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->subject_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Teacher Info & Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Teacher Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Teacher Information</h3>
            <div class="space-y-3">
                <div class="flex border-b border-gray-200 pb-2">
                    <span class="font-medium w-24">Name:</span>
                    <span>{{ $teacher->name }}</span>
                </div>
                <div class="flex border-b border-gray-200 pb-2">
                    <span class="font-medium w-24">Email:</span>
                    <span>{{ $teacher->email }}</span>
                </div>
                <div class="flex border-b border-gray-200 pb-2">
                    <span class="font-medium w-24">Subjects:</span>
                    <span>{{ $subjects->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Attendance Stats -->
        <div class="bg-white rounded-lg shadow-md p-6 md:col-span-2">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Attendance Statistics</h3>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-green-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['present'] }}</div>
                    <div class="text-sm text-gray-600">Present</div>
                    <div class="mt-2 text-green-600 font-medium">{{ $stats['present_percentage'] }}%</div>
                </div>
                
                <div class="bg-red-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-red-600">{{ $stats['absent'] }}</div>
                    <div class="text-sm text-gray-600">Absent</div>
                    <div class="mt-2 text-red-600 font-medium">{{ $stats['absent_percentage'] }}%</div>
                </div>
                
                <div class="bg-yellow-50 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['late'] }}</div>
                    <div class="text-sm text-gray-600">Late</div>
                    <div class="mt-2 text-yellow-600 font-medium">{{ $stats['late_percentage'] }}%</div>
                </div>
            </div>
            
            <div class="mt-4 pt-4 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-700">Total Classes: <span class="font-medium">{{ $stats['total'] }}</span></span>
                    <span class="text-sm text-gray-700">
                        Period: <span class="font-medium">{{ \Carbon\Carbon::parse(request('month', \Carbon\Carbon::now()->format('Y-m')))->format('F Y') }}</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Records -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Attendance Records</h3>
        </div>
        
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Time
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Recorded By
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($attendances as $attendance)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-500">{{ $attendance->day }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $attendance->subject->subject_name }}</div>
                        <div class="text-xs text-gray-500">{{ $attendance->subject->subject_code }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $attendance->start_time }} - {{ $attendance->end_time }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $attendance->status == 'present' ? 'bg-green-100 text-green-800' : 
                              ($attendance->status == 'absent' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ ucfirst($attendance->status) }}
                        </span>
                        @if($attendance->remarks)
                        <div class="text-xs text-gray-500 mt-1">
                            {{ $attendance->remarks }}
                        </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $attendance->recordedBy->cr_name }}</div>
                        <div class="text-xs text-gray-500">{{ $attendance->recordedBy->reg_no }}</div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No attendance records found for this period
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
            {{ $attendances->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>
@endsection 