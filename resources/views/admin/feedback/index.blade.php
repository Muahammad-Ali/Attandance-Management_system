<x-master-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Subject Feedback</h1>
        <p class="text-gray-600">Manage feedback submissions from Class Representatives</p>
    </div>

    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">Success!</span> {{ session('success') }}
    </div>
    @endif

    <!-- Filters -->
    <div class="p-4 mb-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-semibold text-gray-700">Filter Feedback</h2>
        <form action="{{ route('admin.feedback.index') }}" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-4">
            <!-- Teacher Filter -->
            <div>
                <label for="teacher_id" class="block text-sm font-medium text-gray-700 mb-1">Teacher</label>
                <select id="teacher_id" name="teacher_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Teachers</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ request('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Subject Filter -->
            <div>
                <label for="subject_id" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                <select id="subject_id" name="subject_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->subject_name }} ({{ $subject->subject_code }})
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Semester Filter -->
            <div>
                <label for="semester_id" class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
                <select id="semester_id" name="semester_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Semesters</option>
                    @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ request('semester_id') == $semester->id ? 'selected' : '' }}>
                            {{ $semester->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Filter Buttons -->
            <div class="flex items-end space-x-3">
                <button type="submit" class="px-4 py-2 font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none">
                    Filter
                </button>
                <a href="{{ route('admin.feedback.index') }}" class="px-4 py-2 font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Feedback Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Subject
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Teacher
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Semester
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rating
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Submitted By
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($feedbacks as $feedback)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $feedback->subject->subject_name }}</div>
                        <div class="text-sm text-gray-500">{{ $feedback->subject->subject_code }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $feedback->teacher->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $feedback->semester->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $feedback->rating)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-1 text-sm text-gray-500">({{ $feedback->rating }}/5)</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $feedback->cr->cr_name }}</div>
                        <div class="text-sm text-gray-500">{{ $feedback->cr->section }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $feedback->created_at->format('M d, Y') }}</div>
                        <div class="text-sm text-gray-500">{{ $feedback->created_at->format('h:i A') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button type="button" onclick="viewFeedback({{ $feedback->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">View</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        No feedback records found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
            {{ $feedbacks->links() }}
        </div>
    </div>

    <!-- Feedback Detail Modal -->
    <div id="feedbackModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalTitle">
                                Feedback Details
                            </h3>
                            <div class="mt-4 border-t border-gray-200 pt-4">
                                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Subject</label>
                                        <p id="modalSubject" class="mt-1 text-sm text-gray-900"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Teacher</label>
                                        <p id="modalTeacher" class="mt-1 text-sm text-gray-900"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Semester</label>
                                        <p id="modalSemester" class="mt-1 text-sm text-gray-900"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Rating</label>
                                        <div id="modalRating" class="flex mt-1"></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Submitted By</label>
                                        <p id="modalCR" class="mt-1 text-sm text-gray-900"></p>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Date Submitted</label>
                                        <p id="modalDate" class="mt-1 text-sm text-gray-900"></p>
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Comments</label>
                                        <div class="mt-1 p-2 bg-gray-50 rounded">
                                            <p id="modalComments" class="text-sm text-gray-900"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>

@push('scripts')
<script>
    function viewFeedback(id) {
        // In a real application, you'd fetch the data via AJAX
        // For this example, we'll use the data that's already in the table
        const feedbacks = @json($feedbacks);
        const feedback = feedbacks.data.find(f => f.id === id);
        
        if (feedback) {
            document.getElementById('modalTitle').textContent = 'Feedback Details';
            document.getElementById('modalSubject').textContent = `${feedback.subject.subject_name} (${feedback.subject.subject_code})`;
            document.getElementById('modalTeacher').textContent = feedback.teacher.name;
            document.getElementById('modalSemester').textContent = feedback.semester.name;
            
            // Rating stars
            const ratingDiv = document.getElementById('modalRating');
            ratingDiv.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('svg');
                star.classList.add('w-5', 'h-5');
                star.setAttribute('fill', 'currentColor');
                star.setAttribute('viewBox', '0 0 20 20');
                
                if (i <= feedback.rating) {
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.add('text-gray-300');
                }
                
                star.innerHTML = '<path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>';
                ratingDiv.appendChild(star);
            }
            
            const ratingText = document.createElement('span');
            ratingText.classList.add('ml-2', 'text-sm', 'text-gray-700');
            ratingText.textContent = `${feedback.rating}/5`;
            ratingDiv.appendChild(ratingText);
            
            document.getElementById('modalCR').textContent = feedback.cr.cr_name;
            
            // Format date
            const date = new Date(feedback.created_at);
            document.getElementById('modalDate').textContent = date.toLocaleString();
            
            document.getElementById('modalComments').textContent = feedback.comments || 'No comments provided.';
            
            // Show modal
            document.getElementById('feedbackModal').classList.remove('hidden');
        }
    }
    
    function closeModal() {
        document.getElementById('feedbackModal').classList.add('hidden');
    }
</script>
@endpush 