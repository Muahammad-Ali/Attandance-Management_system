<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Assign Subject & Teacher</h1>
    </div>

    <!-- Subject Assignment Form -->
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-6xl mx-auto transition-transform duration-500 hover:scale-[1.02]">
        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-100 text-green-800 p-4 rounded-lg mb-4 text-center transition-opacity duration-500">
            Subject assigned successfully!
        </div>

        <form id="subjectForm" action="{{ route('subject.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Subject Name</label>
                    <input id="subject_name" name="subject_name" type="text" required
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Assign Teacher</label>
                    <select id="teacher_name" name="teacher_id" required
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Select Teacher</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Select CR</label>
                    <select id="cr_section" name="cr_id" required
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Select CR</option>
                        @foreach($crs as $cr)
                            <option value="{{ $cr->id }}">{{ $cr->cr_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Section</label>
                    <input name="section" type="text" required
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Semester</label>
                    <input id="semester" name="semester" type="text" required
                        class="w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <div class="text-center pt-4">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition duration-300 shadow-md">
                    Assign Subject
                </button>
            </div>
        </form>
    </div>

    <!-- Assigned Subject List Table -->
    <div class="mt-10 bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-6xl mx-auto overflow-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Assigned Subjects</h2>

        <table class="min-w-full text-left border-collapse border border-gray-300 text-base sm:text-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">S.No</th>
                    <th class="border border-gray-300 px-4 py-2">Subject Name</th>
                    <th class="border border-gray-300 px-4 py-2">Assigned Teacher</th>
                    <th class="border border-gray-300 px-4 py-2">Section</th>
                    <th class="border border-gray-300 px-4 py-2">Semester</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody id="subjectList">
                @foreach($assignedSubjects as $index => $subject)
                    <tr>
                        <td class="border px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $subject->subject_name }}</td>
                        <td class="border px-4 py-2">{{ $subject->teacher->name }}</td>
                        <td class="border px-4 py-2">{{ $subject->cr->section }}</td>
                        <td class="border px-4 py-2">{{ $subject->semester }}</td>
                        <td class="border px-4 py-2 space-x-2">
                            <a href="{{ route('admin.subjects.show', $subject->id) }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">View</a>

                            <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>

                            <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this subject?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>


        </table>
    </div>

    <!-- JavaScript for Handling Form Submission -->
    <script>
        let subjectCount = {{ count($assignedSubjects) }}; // Initialize with backend count


            const subject_name = document.getElementById('subject_name').value.trim();
            const teacher_name = document.getElementById('teacher_name').options[document.getElementById('teacher_name').selectedIndex].text;
            const cr_section = document.getElementById('cr_section').options[document.getElementById('cr_section').selectedIndex].text;
            const semester = document.getElementById('semester').value.trim();

            if (!subject_name || !teacher_name || !cr_section || !semester) {
                alert("Please fill in all fields.");
                return;
            }

            subjectCount++;

            const tableBody = document.getElementById('subjectList');
            const newRow = document.createElement('tr');
            newRow.classList.add('opacity-0', 'transition-opacity', 'duration-500');

            newRow.innerHTML = `
                <td class="border px-4 py-2">${subjectCount}</td>
                <td class="border px-4 py-2">${subject_name}</td>
                <td class="border px-4 py-2">${teacher_name}</td>
                <td class="border px-4 py-2">${cr_section}</td>
                <td class="border px-4 py-2">${semester}</td>
            `;
            tableBody.appendChild(newRow);

            setTimeout(() => newRow.classList.remove('opacity-0'), 100);

            const successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('hidden');
            successMessage.classList.add('opacity-100');

            // Reset inputs
            document.getElementById('subjectForm').reset();

            setTimeout(() => {
                successMessage.classList.add('opacity-0');
                setTimeout(() => successMessage.classList.add('hidden'), 500);
            }, 3000);

    </script>
</x-master-layout>
