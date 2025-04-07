<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-800">Create Class Representative (CR)</h1>
    </div>

    <!-- CR Registration Form -->
    <div class="bg-white p-8 rounded-lg shadow-lg w-4/5 mx-auto transition-transform duration-500 hover:scale-105">
        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-100 text-green-800 p-3 rounded-md mb-4 text-center transition-opacity duration-500">
            🎉 CR created successfully!
        </div>

        <form id="crForm">
            <!-- Input Fields in a Single Row -->
            <div class="flex space-x-6">
                <!-- CR Name -->
                <div class="w-1/5">
                    <label class="block text-gray-700 font-medium mb-2" for="cr_name">CR Name</label>
                    <input type="text" id="cr_name" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- CR Email -->
                <div class="w-1/5">
                    <label class="block text-gray-700 font-medium mb-2" for="cr_email">Email</label>
                    <input type="email" id="cr_email" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- Registration Number -->
                <div class="w-1/5">
                    <label class="block text-gray-700 font-medium mb-2" for="reg_no">Reg No</label>
                    <input type="text" id="reg_no" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- Section -->
                <div class="w-1/5">
                    <label class="block text-gray-700 font-medium mb-2" for="section">Section</label>
                    <input type="text" id="section" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>

                <!-- Semester -->
                <div class="w-1/5">
                    <label class="block text-gray-700 font-medium mb-2" for="semester">Semester</label>
                    <input type="text" id="semester" class="w-full border border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all duration-300" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-md shadow-md hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105">Create CR</button>
            </div>
        </form>
    </div>

    <!-- CR List Table -->
    <div class="mt-8 bg-white p-8 rounded-lg shadow-lg w-4/5 mx-auto transition-transform duration-500 hover:scale-105">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">CR List</h2>

        <table class="w-full border-collapse border border-gray-300 text-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="border border-gray-300 px-6 py-3">S.No</th>
                    <th class="border border-gray-300 px-6 py-3">CR Name</th>
                    <th class="border border-gray-300 px-6 py-3">Email</th>
                    <th class="border border-gray-300 px-6 py-3">Reg No</th>
                    <th class="border border-gray-300 px-6 py-3">Section</th>
                    <th class="border border-gray-300 px-6 py-3">Semester</th>
                </tr>
            </thead>
            <tbody id="crList">
                <!-- Newly added CRs will be displayed here -->
            </tbody>
        </table>
    </div>

    <!-- JavaScript for Handling Form Submission -->
    <script>
        let crCount = 0; // Serial number counter

        document.getElementById('crForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get input values
            let cr_name = document.getElementById('cr_name').value.trim();
            let cr_email = document.getElementById('cr_email').value.trim();
            let reg_no = document.getElementById('reg_no').value.trim();
            let section = document.getElementById('section').value.trim();
            let semester = document.getElementById('semester').value.trim();

            if (cr_name === "" || cr_email === "" || reg_no === "" || section === "" || semester === "") {
                alert("Please fill in all fields.");
                return;
            }

            // Increment serial number
            crCount++;

            // Add new CR to the list with fade-in effect
            let tableBody = document.getElementById('crList');
            let newRow = document.createElement('tr');
            newRow.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            newRow.innerHTML = `
                <td class="border border-gray-300 px-6 py-3">${crCount}</td>
                <td class="border border-gray-300 px-6 py-3">${cr_name}</td>
                <td class="border border-gray-300 px-6 py-3">${cr_email}</td>
                <td class="border border-gray-300 px-6 py-3">${reg_no}</td>
                <td class="border border-gray-300 px-6 py-3">${section}</td>
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

            // Clear Input Fields
            document.getElementById('cr_name').value = '';
            document.getElementById('cr_email').value = '';
            document.getElementById('reg_no').value = '';
            document.getElementById('section').value = '';
            document.getElementById('semester').value = '';

            // Hide success message after 3 seconds
            setTimeout(() => {
                successMessage.classList.add('opacity-0');
                setTimeout(() => successMessage.classList.add('hidden'), 500);
            }, 3000);
        });
    </script>
</x-master-layout>
