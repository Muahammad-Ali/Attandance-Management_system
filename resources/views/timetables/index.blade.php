<x-master-layout>
    <div class="container mx-auto px-4 py-10">
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 animate-fadeIn">📅 Timetable Management</h1>
            <p class="text-gray-600 mt-3 text-lg">Select a Programs and semester to view or manage timetables.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded shadow animate-fadeIn">
                {{ session('success') }}
            </div>
        @endif

        @if($departments->isEmpty())
            <div class="bg-white rounded-xl shadow-lg p-10 text-center animate-fadeIn">
                <h2 class="text-2xl font-semibold text-gray-800 mb-3">No Programs Found</h2>
                <p class="text-gray-500 mb-5">Please create Programs and semesters before managing timetables.</p>
                <a href="{{ route('departments.create') }}"
                   class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-all">
                     Create Programs
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 animate-fadeInSlow ">
                @foreach($departments as $department)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                        <div class="bg-indigo-600 p-5 ">
                            <h2 class="text-2xl font-bold text-white ">{{ $department->name }}</h2>
                            <p class="text-indigo-200 text-sm mt-1 ">Code: {{ $department->code }}</p>
                        </div>

                        <div class="p-5">
                            @if($department->semesters->isEmpty())
                                <div class="text-center py-6">
                                    <p class="text-gray-500 mb-4">No semesters found.</p>
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('semesters.create') }}?department_id={{ $department->id }}"
                                           class="bg-indigo-100 text-indigo-700 px-3 py-2 rounded hover:bg-indigo-200 text-sm">
                                            ➕ Add Semester
                                        </a>
                                        <a href="{{ route('semesters.create-bulk') }}?department_id={{ $department->id }}"
                                           class="bg-green-100 text-green-700 px-3 py-2 rounded hover:bg-green-200 text-sm">
                                            📄 Create All Semesters
                                        </a>
                                    </div>
                                </div>
                            @else


                            <div class="grid grid-cols-2 gap-4">
                                @foreach($department->semesters->sortBy('semester_number') as $semester)
                                    <a href="{{ route('timetables.semester', $semester->id) }}"
                                       class="flex flex-col justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-all text-center min-h-[100px] w-full">

                                       <div class="flex-1 flex items-center justify-center">
                                           <p class="font-semibold text-gray-800 text-lg">
                                               {{ $semester->name ?? 'Semester ' . $semester->semester_number }}
                                           </p>
                                       </div>

                                       @if($semester->is_active)
                                           <div class="mt-2 flex justify-center">
                                               <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded">Active</span>
                                           </div>
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

    <!-- Animations -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.8s ease forwards;
        }

        @keyframes fadeInSlow {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInSlow {
            animation: fadeInSlow 1.2s ease forwards;
        }
    </style>
</x-master-layout>
