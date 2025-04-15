<x-master-layout>
    <div class="max-w-6xl mx-auto py-8 px-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Assigned Subjects for {{ $teacher->name }}</h2>

        @if($assignedSubjects->isEmpty())
            <p class="text-gray-600">You don't have any assigned subjects yet.</p>
        @else
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">Subject Name</th>
                        <th class="border px-4 py-2">Section</th>
                        <th class="border px-4 py-2">Semester</th>
                        <th class="border px-4 py-2">CR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignedSubjects as $subject)
                        <tr>
                            <td class="border px-4 py-2">{{ $subject->subject_name }}</td>
                            <td class="border px-4 py-2">{{ $subject->section }}</td>
                            <td class="border px-4 py-2">{{ $subject->semester }}</td>
                            <td class="border px-4 py-2">{{ $subject->cr->cr_name ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-master-layout>
