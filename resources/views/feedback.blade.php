<x-master-layout>
    <!-- Main Content Area -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Feedback's</h1>
    </div>

    <!-- Filter Dropdown -->
    <div class="mb-4">
        <label for="statusFilter" class="text-gray-700 font-medium">Filter by Status:</label>
        <select id="statusFilter" class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
            <option value="all">All</option>
            <option value="completed">Completed</option>
            <option value="uncompleted">Uncompleted</option>
        </select>
    </div>

    <!-- Feedback Table with Increased Width -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full max-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CR</th>
                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher</th>
                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                    <th class="w-1/4 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feedback</th>
                    <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="feedbackTable">
                <!-- Sample Data -->
                <tr class="feedback-row" data-status="completed" data-feedback="Great performance, keep it up!" data-student="Muhammad">
                    <td class="px-6 py-4 whitespace-nowrap">Muhammad</td>
                    <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                    <td class="px-6 py-4 whitespace-nowrap">5th</td>
                    <td class="px-6 py-4 whitespace-nowrap">A</td>
                    <td class="px-6 py-4 whitespace-nowrap cursor-pointer text-blue-600 underline open-feedback-modal">Feedback</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="status-badge px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Completed
                        </span>
                    </td>
                </tr>
                <tr class="feedback-row" data-status="uncompleted" data-feedback="Needs improvement in assignments." data-student="Abc">
                    <td class="px-6 py-4 whitespace-nowrap">Abc</td>
                    <td class="px-6 py-4 whitespace-nowrap">Booking</td>
                    <td class="px-6 py-4 whitespace-nowrap">5th</td>
                    <td class="px-6 py-4 whitespace-nowrap">A</td>
                    <td class="px-6 py-4 whitespace-nowrap cursor-pointer text-blue-600 underline open-feedback-modal">Feedback</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="status-badge px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Uncompleted
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal for Feedback -->
    <div id="feedbackModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-xl font-semibold mb-4" id="modalTitle">Write Feedback</h2>
            <textarea id="feedbackInput" class="w-full p-2 border border-gray-300 rounded-md" rows="4"></textarea>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="approveFeedback" class="bg-green-500 text-white px-4 py-2 rounded-md">Approve</button>
                <button id="declineFeedback" class="bg-red-500 text-white px-4 py-2 rounded-md">Decline</button>
                <button id="closeModal" class="bg-gray-300 px-4 py-2 rounded-md">Close</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Filtering and Modal -->
    <script>
        // Filter logic
        document.getElementById('statusFilter').addEventListener('change', function () {
            let selectedStatus = this.value;
            let rows = document.querySelectorAll('.feedback-row');

            rows.forEach(row => {
                if (selectedStatus === 'all' || row.getAttribute('data-status') === selectedStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Modal Logic
        document.querySelectorAll('.open-feedback-modal').forEach(item => {
            item.addEventListener('click', function () {
                let row = this.closest('.feedback-row'); // Get parent row
                let feedbackText = row.getAttribute('data-feedback'); // Get feedback
                let studentName = row.getAttribute('data-student'); // Get student name

                document.getElementById('modalTitle').innerText = `Feedback for ${studentName}`; // Set title
                document.getElementById('feedbackInput').value = feedbackText; // Set feedback text

                document.getElementById('feedbackModal').classList.remove('hidden'); // Show modal
            });
        });

        // Close Modal
        document.getElementById('closeModal').addEventListener('click', function () {
            document.getElementById('feedbackModal').classList.add('hidden');
        });

        // Approve Button
        document.getElementById('approveFeedback').addEventListener('click', function () {
            alert('Feedback Approved!');
            document.getElementById('feedbackModal').classList.add('hidden');
        });

        // Decline Button
        document.getElementById('declineFeedback').addEventListener('click', function () {
            alert('Feedback Declined!');
            document.getElementById('feedbackModal').classList.add('hidden');
        });
    </script>
</x-master-layout>
