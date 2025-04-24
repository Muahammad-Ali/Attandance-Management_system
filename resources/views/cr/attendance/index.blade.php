<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - CR Dashboard</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

<div class="flex min-h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="lg:block hidden w-72 bg-white border-r">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-indigo-700">CR Dashboard</h1>
            <nav class="mt-6 space-y-2">
                <a href="{{ route('cr.dashboard') }}" class="flex items-center px-4 py-2 bg-indigo-100 text-indigo-700 rounded-md font-medium transition hover:bg-indigo-200">
                    <i class="fas fa-home mr-2"></i> Dashboard
                </a>
                <a href="{{ route('cr.attendance.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-md transition">
                    <i class="fas fa-clipboard-check mr-2"></i> Teacher Attendance
                </a>
                <a href="{{ route('cr.feedback.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-indigo-50 rounded-md transition">
                    <i class="fas fa-comment-alt mr-2"></i> Subject Feedback
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Teacher Attendance Records</h1>
            <a href="{{ route('cr.attendance.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-2"></i> Record Attendance
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    @foreach(['Date','Teacher','Subject','Semester','Status','Actions'] as $header)
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ $header }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse($attendances as $attendance)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $attendance->date->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $attendance->day }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $attendance->teacher->name }}</div>
                        </td>
                        <td class="px-6 py-4">
    <div class="text-sm text-gray-900">{{ $attendance->assignedSubject->subject_name ?? 'N/A' }}</div>
    <div class="text-xs text-gray-500">{{ $attendance->assignedSubject->subject_code ?? '' }}</div>
</td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $attendance->semester->name }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($attendance->status === 'present') bg-green-100 text-green-800
                                @elseif($attendance->status === 'absent') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium space-x-3">
                            <a href="{{ route('cr.attendance.show', $attendance) }}" class="text-indigo-600 hover:text-indigo-900 transition">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('cr.attendance.edit', $attendance) }}" class="text-yellow-600 hover:text-yellow-900 transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('cr.attendance.destroy', $attendance) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 transition" onclick="return confirm('Are you sure you want to delete this record?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No attendance records found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $attendances->links() }}
        </div>
    </main>
</div>

</body>

</html>
