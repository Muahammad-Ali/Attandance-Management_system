<x-master-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Timetable Management</h1>
            <p class="text-gray-600 mt-2">Select a department and semester to view or manage timetables</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($departments->isEmpty())
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">No Departments Found</h2>
                <p class="text-gray-600 mb-6">You need to create departments and semesters before you can manage timetables.</p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('departments.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                        Create Department
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($departments as $department)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-indigo-600 p-4">
                            <h2 class="text-xl font-bold text-white">{{ $department->name }}</h2>
                            <p class="text-indigo-100 text-sm">{{ $department->code }}</p>
                        </div>
                        <div class="p-4">
                            @if($department->semesters->isEmpty())
                                <div class="text-center py-8">
                                    <p class="text-gray-500 mb-4">No semesters found for this department</p>
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('semesters.create') }}?department_id={{ $department->id }}" 
                                           class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded hover:bg-indigo-200 text-sm">
                                            Add Semester
                                        </a>
                                        <a href="{{ route('semesters.create-bulk') }}?department_id={{ $department->id }}" 
                                           class="bg-green-100 text-green-700 px-3 py-1 rounded hover:bg-green-200 text-sm">
                                            Create All Semesters
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                    @foreach($department->semesters->sortBy('semester_number') as $semester)
                                        <a href="{{ route('timetables.semester', $semester->id) }}" 
                                           class="block p-3 bg-gray-50 rounded border border-gray-200 hover:bg-gray-100 transition-colors text-center">
                                            <div class="font-medium">Semester {{ $semester->semester_number }}</div>
                                            @if($semester->is_active)
                                                <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Active</span>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-master-layout>