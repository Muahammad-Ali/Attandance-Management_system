<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Assign Subject & Teacher</h1>
    </div>

    <!-- Subject Assignment Form -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-4/5 mx-auto transition-transform duration-500 hover:scale-105">
        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-100 text-green-800 p-3 rounded-md mb-4 text-center transition-opacity duration-500">
            🎉 Subject assigned successfully!
        </div>

        <form id="subjectForm">
            <!-- Input Fields in a Row -->
            <div class="grid grid-cols-3 gap-6">
                <!-- Subject Name -->
                <div class="w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="subject_name">Subject Name</label>
                    <input type="text" id="subject_name" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- Assign Teacher -->
                <div class="w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="teacher_name">Assign Teacher</label>
                    <input type="text" id="teacher_name" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- CR Section -->
                <div class="w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="cr_section">CR Section</label>
                    <input type="text" id="cr_section" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- Semester -->
                <div class="w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="semester">Semester</label>
                    <input type="text" id="semester" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-md shadow-md hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105">Assign Subject</button>
            </div>
        </form>
    </div>

    <!-- Assigned Subject List Table -->
    <div class="mt-8 bg-white p-8 rounded-lg shadow-lg w-4/5 mx-auto transition-transform duration-500 hover:scale-105">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Assigned Subjects</h2>

        <table class="w-full border-collapse border border-gray-300 text-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border border-gray-300 px-6 py-3">S.No</th>
                    <th class="border border-gray-300 px-6 py-3">Subject Name</th>
                    <th class="border border-gray-300 px-6 py-3">Assigned Teacher</th>
                    <th class="border border-gray-300 px-6 py-3">CR Section</th>
                    <th class="border border-gray-300 px-6 py-3">Semester</th>
                </tr>
            </thead>
            <tbody id="subjectList">
                <!-- Newly assigned subjects will be displayed here -->
            </tbody>
        </table>
    </div>

    <!-- JavaScript for Handling Form Submission -->
    <script>
        let subjectCount = 0; // Serial number counter

        document.getElementById('subjectForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get input values
            let subject_name = document.getElementById('subject_name').value.trim();
            let teacher_name = document.getElementById('teacher_name').value.trim();
            let cr_section = document.getElementById('cr_section').value.trim();
            let semester = document.getElementById('semester').value.trim();

            if (subject_name === "" || teacher_name === "" || cr_section === "" || semester === "") {
                alert("Please fill in all fields.");
                return;
            }

            // Increment serial number
            subjectCount++;

            // Add new subject to the list with fade-in effect
            let tableBody = document.getElementById('subjectList');
            let newRow = document.createElement('tr');
            newRow.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            newRow.innerHTML = `
                <td class="border border-gray-300 px-6 py-3">${subjectCount}</td>
                <td class="border border-gray-300 px-6 py-3">${subject_name}</td>
                <td class="border border-gray-300 px-6 py-3">${teacher_name}</td>
                <td class="border border-gray-300 px-6 py-3">${cr_section}</td>
                <td class="border border-gray-300 px-6 py-3">${semester}</td>
            `;
            tableBody.appendChild(newRow);

            // Trigger fade-in effect
            setTimeout(() => {
                newRow.classList.remove('opacity-0');
            }, 100);

            // Show success message with fade effect
            let successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('hidden');
            successMessage.classList.add('opacity-100', 'transition-opacity', 'duration-500');

            // Clear Input Fields`
            document.getElementById('subject_name').value = '';
            document.getElementById('teacher_name').value = '';
            document.getElementById('cr_section').value = '';
            document.getElementById('semester').value = '';

            // Hide success message after 3 seconds
            setTimeout(() => {
                successMessage.classList.add('opacity-0');
                setTimeout(() => successMessage.classList.add('hidden'), 500);
            }, 3000);
        });
    </script>
</x-master-layout>
