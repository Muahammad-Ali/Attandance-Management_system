<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Create Teacher</h1>
    </div>

    <!-- Teacher Registration Form -->
    <div class="bg-white p-6 rounded-lg shadow-md w-3/4 mx-auto">
        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-100 text-green-800 p-3 rounded-md mb-4 text-center">
            Teacher created successfully!
        </div>

        <form id="teacherForm">
            <!-- Input Fields in a Row -->
            <div class="flex space-x-4">
                <!-- Teacher Name -->
                <div class="w-1/4">
                    <label class="block text-gray-700 font-medium mb-2" for="name">Teacher Name</label>
                    <input type="text" id="name" class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200 focus:border-indigo-300" required>
                </div>

                <!-- Teacher Email -->
                <div class="w-1/4">
                    <label class="block text-gray-700 font-medium mb-2" for="email">Email</label>
                    <input type="email" id="email" class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200 focus:border-indigo-300" required>
                </div>

                <!-- Teacher Password -->
                <div class="w-1/4">
                    <label class="block text-gray-700 font-medium mb-2" for="password">Password</label>
                    <input type="password" id="password" class="w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-indigo-200 focus:border-indigo-300" required>
                </div>

                <!-- Show Password Checkbox -->
                {{-- <div class="w-1/4 flex items-end">
                    <input type="checkbox" id="showPassword" class="mr-2">
                    <label for="showPassword" class="text-gray-700">Show Password</label>
                </div> --}}
            </div>

            <!-- Submit Button -->
            <div class="mt-4 text-center">
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">Create Teacher</button>
            </div>
        </form>
    </div>

    <!-- Teacher List Table -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md w-3/4 mx-auto">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Teacher List</h2>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">S.No</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Teacher Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Password</th>
                </tr>
            </thead>
            <tbody id="teacherList">
                <!-- Newly added teachers will be displayed here -->
            </tbody>
        </table>
    </div>

    <!-- JavaScript for Handling Form Submission -->
    <script>
        let teacherCount = 0; // Serial number counter

        document.getElementById('teacherForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get input values
            let name = document.getElementById('name').value.trim();
            let email = document.getElementById('email').value.trim();
            let password = document.getElementById('password').value.trim();

            if (name === "" || email === "" || password === "") {
                alert("Please fill in all fields.");
                return;
            }

            // Increment serial number
            teacherCount++;

            // Add new teacher to the list
            let tableBody = document.getElementById('teacherList');
            let newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="border border-gray-300 px-4 py-2">${teacherCount}</td>
                <td class="border border-gray-300 px-4 py-2">${name}</td>
                <td class="border border-gray-300 px-4 py-2">${email}</td>
                <td class="border border-gray-300 px-4 py-2">${password}</td>
            `;
            tableBody.appendChild(newRow);

            // Show success message
            document.getElementById('successMessage').classList.remove('hidden');

            // Clear Input Fields
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';

            // Hide success message after 3 seconds
            setTimeout(() => {
                document.getElementById('successMessage').classList.add('hidden');
            }, 3000);
        });

        // Show/Hide Password
        document.getElementById('showPassword').addEventListener('change', function() {
            let passwordField = document.getElementById('password');
            passwordField.type = this.checked ? "text" : "password";
        });
    </script>
</x-master-layout>
