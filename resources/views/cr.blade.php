<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Create Class Representative (CR)</h1>
    </div>

    <!-- CR Registration Form -->
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-6xl mx-auto transition-transform duration-500 hover:scale-[1.02]">
        @if(session('success'))
            <div id="successMessage" class="bg-green-100 text-green-800 p-4 rounded-lg mb-4 text-center">
                🎉 {{ session('success') }}
            </div>
        @endif

        <form id="crForm" action="{{ route('cr.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div>
                    <label for="cr_name" class="block font-medium text-gray-700 mb-1">CR Name</label>
                    <input type="text" name="cr_name" id="cr_name" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="cr_email" class="block font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="cr_email" id="cr_email" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="reg_no" class="block font-medium text-gray-700 mb-1">Reg No</label>
                    <input type="text" name="reg_no" id="reg_no" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="section" class="block font-medium text-gray-700 mb-1">Section</label>
                    <input type="text" name="section" id="section" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="semester" class="block font-medium text-gray-700 mb-1">Semester</label>
                    <input type="text" name="semester" id="semester" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
                </div>

                <div>
                    <label for="password" class="block font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-400">
                </div>
            </div>

            <div class="pt-6 text-center">
                <button type="submit"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-md shadow-md hover:bg-indigo-700 transition-all duration-300 transform hover:scale-105">
                    Create CR
                </button>
            </div>
        </form>
    </div>

    <!-- CR List Table -->
    <div class="mt-10 bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-6xl mx-auto overflow-x-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">CR List</h2>

        <table class="min-w-full text-left border-collapse border border-gray-300 text-base sm:text-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-6 py-3">S.No</th>
                    <th class="border px-6 py-3">CR Name</th>
                    <th class="border px-6 py-3">Email</th>
                    <th class="border px-6 py-3">Reg No</th>
                    <th class="border px-6 py-3">Section</th>
                    <th class="border px-6 py-3">Semester</th>
                </tr>
            </thead>
            <tbody id="crList">
                @php $i = 1; @endphp
                @foreach($crs as $cr)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-6 py-3">{{ $i++ }}</td>
                        <td class="border px-6 py-3">{{ $cr->cr_name }}</td>
                        <td class="border px-6 py-3">{{ $cr->cr_email }}</td>
                        <td class="border px-6 py-3">{{ $cr->reg_no }}</td>
                        <td class="border px-6 py-3">{{ $cr->section }}</td>
                        <td class="border px-6 py-3">{{ $cr->semester }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript for Form Handling -->
    <script>
        let crCount = {{ count($crs) }};

        document.getElementById('crForm').addEventListener('submit', function(e) {
            // Don't prevent default as we want the form to submit normally
            // This is just to update the table preview

            let cr_name = document.getElementById('cr_name').value.trim();
            let cr_email = document.getElementById('cr_email').value.trim();
            let reg_no = document.getElementById('reg_no').value.trim();
            let section = document.getElementById('section').value.trim();
            let semester = document.getElementById('semester').value.trim();

            if (!cr_name || !cr_email || !reg_no || !section || !semester) {
                return; // Let the HTML validation handle this
            }

            // Preview will be shown after redirect with success message
        });
    </script>
</x-master-layout>
