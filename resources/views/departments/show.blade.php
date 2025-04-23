<x-master-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $department->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('departments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                    Back to List
                </a>
                <a href="{{ route('departments.edit', $department->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-colors">
                    Edit
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Department Details Card -->
            <div class="bg-white rounded-lg shadow-md p-6 md:col-span-1">
                <h2 class="text-xl font-semibold mb-4">Programs Details</h2>
                <div class="space-y-3">
                    <div>
                        <span class="font-bold">Name:</span>
                        <span>{{ $department->name }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Code:</span>
                        <span>{{ $department->code ?: 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="font-bold">Description:</span>
                        <p class="mt-1">{{ $department->description ?: 'No description available.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Semesters Card -->
            <div class="bg-white rounded-lg shadow-md p-6 md:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Semesters</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('semesters.create') }}?department_id={{ $department->id }}" class="bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition-colors text-sm">
                            Add Semester
                        </a>
                        <a href="{{ route('semesters.create-bulk') }}?department_id={{ $department->id }}" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition-colors text-sm">
                            Create All (1-8)
                        </a>
                    </div>
                </div>

                @if($department->semesters->isEmpty())
                    <div class="text-gray-500 text-center py-4">
                        No semesters found for this department.
                    </div>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($department->semesters->sortBy('semester_number') as $semester)
                            <a href="{{ route('timetables.semester', $semester->id) }}"
                               class="block p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors">
                                <div class="text-lg font-medium">Semester {{ $semester->semester_number }}</div>
                                @if($semester->is_active)
                                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Active</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
