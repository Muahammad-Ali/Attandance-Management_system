<x-master-layout>
    <div class="text-center my-8">
        <h1 class="text-3xl font-bold text-gray-800">📘 My Assigned Subjects</h1>
    </div>

    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-lg max-w-6xl mx-auto">
        @if($mySubjects->isEmpty())
            <p class="text-gray-600 text-center">No subjects assigned yet.</p>
        @else
            <table class="min-w-full border border-gray-300 text-base text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">S.No</th>
                        <th class="border px-4 py-2">Subject Name</th>
                        <th class="border px-4 py-2">CR Section</th>
                        <th class="border px-4 py-2">Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mySubjects as $index => $subject)
                        <tr>
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $subject->subject_name }}</td>
                            <td class="border px-4 py-2">{{ $subject->cr->section ?? 'N/A' }}</td>
                            <td class="border px-4 py-2">{{ $subject->semester }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-master-layout>
