<x-master-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add Class to Timetable</h1>
            <a href="{{ route('timetables.semester', $semester->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                Back to Timetable
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700">{{ $semester->department->name }} - Semester {{ $semester->semester_number }}</h2>
            </div>

            <form action="{{ route('timetables.store') }}" method="POST">
                @csrf
                <input type="hidden" name="semester_id" value="{{ $semester->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Subject Selection -->
                    <div>
                        <label for="subject_id" class="block text-gray-700 font-bold mb-2">Subject <span class="text-red-500">*</span></label>
                        <select name="subject_id" id="subject_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Teacher Selection -->
                    <div>
                        <label for="teacher_id" class="block text-gray-700 font-bold mb-2">Teacher <span class="text-red-500">*</span></label>
                        <select name="teacher_id" id="teacher_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Teacher</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @error('teacher_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CR Selection -->
                    <div>
                        <label for="cr_id" class="block text-gray-700 font-bold mb-2">Class Representative</label>
                        <select name="cr_id" id="cr_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select CR (Optional)</option>
                            @foreach($crs as $cr)
                                <option value="{{ $cr->id }}">{{ $cr->cr_name }} ({{ $cr->reg_no }})</option>
                            @endforeach
                        </select>
                        @error('cr_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Day Selection -->
                    <div>
                        <label for="day" class="block text-gray-700 font-bold mb-2">Day <span class="text-red-500">*</span></label>
                        <select name="day" id="day" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Day</option>
                            @foreach($days as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('day')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block text-gray-700 font-bold mb-2">Start Time <span class="text-red-500">*</span></label>
                        <input type="time" name="start_time" id="start_time" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('start_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block text-gray-700 font-bold mb-2">End Time <span class="text-red-500">*</span></label>
                        <input type="time" name="end_time" id="end_time" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('end_time')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Classroom -->
                    <div>
                        <label for="classroom" class="block text-gray-700 font-bold mb-2">Classroom</label>
                        <input type="text" name="classroom" id="classroom" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="e.g., Room 101">
                        @error('classroom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label for="notes" class="block text-gray-700 font-bold mb-2">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Any additional information about this class"></textarea>
                        @error('notes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                        Add to Timetable
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout> 