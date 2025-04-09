<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Create Teacher</h1>
    </div>

    <!-- Teacher Registration Form -->
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-5xl mx-auto transition-all duration-300">
        <!-- Success Message -->
        <div id="successMessage" class="hidden bg-green-100 text-green-800 p-4 rounded-lg mb-4 text-center">
            🎉 Teacher created successfully!
        </div>

        <form id="teacherForm" action="{{ route('teacher.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="name">Teacher Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1" for="password">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400">
                </div>
            </div>

            <div class="text-center pt-4">
                <button type="submit"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-md shadow-md hover:bg-indigo-700 transition-transform transform hover:scale-105">
                    Create Teacher
                </button>
            </div>
        </form>
    </div>

    <!-- Teacher List Table -->
    <div class="mt-10 bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-5xl mx-auto overflow-x-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Teacher List</h2>

        <table class="min-w-full border border-gray-300 text-base">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-6 py-3 text-left">S.No</th>
                    <th class="border px-6 py-3 text-left">Teacher Name</th>
                    <th class="border px-6 py-3 text-left">Email</th>
                    <th class="border px-6 py-3 text-left">Password</th>
                </tr>
            </thead>
            <tbody id="teacherList">
                @php $i = 1; @endphp
                @foreach ($teachers as $teacher)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-6 py-3">{{ $i++ }}</td>
                        <td class="border px-6 py-3">{{ $teacher->name }}</td>
                        <td class="border px-6 py-3">{{ $teacher->email }}</td>
                        <td class="border px-6 py-3">********</td> <!-- Secure by design -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript to Simulate Adding Teacher (optional enhancement) -->
    <script>


            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!name || !email || !password) {
                alert('Please fill in all fields.');
                return;
            }

            const tableBody = document.getElementById('teacherList');
            const rowCount = tableBody.rows.length + 1;

            const newRow = document.createElement('tr');
            newRow.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            newRow.innerHTML = `
                <td class="border px-6 py-3">${rowCount}</td>
                <td class="border px-6 py-3">${name}</td>
                <td class="border px-6 py-3">${email}</td>
                <td class="border px-6 py-3">********</td>
            `;
            tableBody.appendChild(newRow);

            setTimeout(() => newRow.classList.remove('opacity-0'), 100);

            document.getElementById('successMessage').classList.remove('hidden');

            // Clear inputs
            this.reset();

            setTimeout(() => {
                document.getElementById('successMessage').classList.add('hidden');
            }, 3000);
        
    </script>
</x-master-layout>
