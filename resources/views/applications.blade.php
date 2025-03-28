<x-master-layout>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Student Applications</h1>
    </div>

    <!-- Student Applications Table -->
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registration No.</th>
                    <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student Name</th>
                    <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                    <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Sample Data - Replace with Dynamic Data -->
                <tr class="student-row" data-reg="REG123" data-student="Muhammad Ali" data-subject="Mathematics" data-application="I am interested in Mathematics because I love problem-solving and calculations. I wish to enhance my skills in this subject.">
                    <td class="px-6 py-4 whitespace-nowrap">REG123</td>
                    <td class="px-6 py-4 whitespace-nowrap">Muhammad Ali</td>
                    <td class="px-6 py-4 whitespace-nowrap">Mathematics</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="view-btn bg-blue-500 text-white px-4 py-2 rounded-md">View</button>
                        <button class="approve-btn bg-green-500 text-white px-4 py-2 rounded-md ml-2">Approve</button>
                        <button class="decline-btn bg-red-500 text-white px-4 py-2 rounded-md ml-2">Decline</button>
                    </td>
                </tr>
                <tr class="student-row" data-reg="REG456" data-student="Ayesha Khan" data-subject="Physics" data-application="Physics has always fascinated me. I enjoy understanding the laws of nature and experimenting with physical concepts.">
                    <td class="px-6 py-4 whitespace-nowrap">REG456</td>
                    <td class="px-6 py-4 whitespace-nowrap"> Khan</td>
                    <td class="px-6 py-4 whitespace-nowrap">Physics</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button class="view-btn bg-blue-500 text-white px-4 py-2 rounded-md">View</button>
                        <button class="approve-btn bg-green-500 text-white px-4 py-2 rounded-md ml-2">Approve</button>
                        <button class="decline-btn bg-red-500 text-white px-4 py-2 rounded-md ml-2">Decline</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- View Application Modal -->
    <div id="viewModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
            <h2 class="text-xl font-semibold mb-4">Student Application</h2>
            <p class="text-gray-700"><strong>Registration No:</strong> <span id="modalReg"></span></p>
            <p class="text-gray-700"><strong>Student Name:</strong> <span id="modalStudent"></span></p>
            <p class="text-gray-700"><strong>Subject:</strong> <span id="modalSubject"></span></p>
            <p class="text-gray-700 mt-4"><strong>Application Material:</strong></p>
            <p id="modalApplication" class="text-gray-600 p-4 border border-gray-300 rounded-md bg-gray-100"></p>
            <div class="mt-4 flex justify-end">
                <button id="closeViewModal" class="bg-gray-300 px-4 py-2 rounded-md">Close</button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            <h2 class="text-xl font-semibold mb-4">Confirm Action</h2>
            <p class="text-gray-700 mb-4" id="modalMessage"></p>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="confirmAction" class="bg-blue-500 text-white px-4 py-2 rounded-md">Confirm</button>
                <button id="closeConfirmModal" class="bg-gray-300 px-4 py-2 rounded-md">Cancel</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for View, Approve, and Decline -->
    <script>
        let selectedStudent = null;
        let actionType = "";

        // View Button Click
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                let row = this.closest('.student-row');
                document.getElementById('modalReg').innerText = row.dataset.reg;
                document.getElementById('modalStudent').innerText = row.dataset.student;
                document.getElementById('modalSubject').innerText = row.dataset.subject;
                document.getElementById('modalApplication').innerText = row.dataset.application;
                document.getElementById('viewModal').classList.remove('hidden');
            });
        });

        // Close View Modal
        document.getElementById('closeViewModal').addEventListener('click', function () {
            document.getElementById('viewModal').classList.add('hidden');
        });

        // Approve Button Click
        document.querySelectorAll('.approve-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                selectedStudent = this.closest('.student-row');
                actionType = "approve";
                showConfirmationModal(`Are you sure you want to approve ${selectedStudent.dataset.student}'s application?`);
            });
        });

        // Decline Button Click
        document.querySelectorAll('.decline-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                selectedStudent = this.closest('.student-row');
                actionType = "decline";
                showConfirmationModal(`Are you sure you want to decline ${selectedStudent.dataset.student}'s application?`);
            });
        });

        // Show Confirmation Modal
        function showConfirmationModal(message) {
            document.getElementById('modalMessage').innerText = message;
            document.getElementById('confirmationModal').classList.remove('hidden');
        }

        // Close Confirmation Modal
        document.getElementById('closeConfirmModal').addEventListener('click', function () {
            document.getElementById('confirmationModal').classList.add('hidden');
        });

        // Confirm Action
        document.getElementById('confirmAction').addEventListener('click', function () {
            if (selectedStudent && actionType) {
                alert(`${selectedStudent.dataset.student}'s application has been ${actionType}d!`);
                document.getElementById('confirmationModal').classList.add('hidden');
            }
        });
    </script>
</x-master-layout>
