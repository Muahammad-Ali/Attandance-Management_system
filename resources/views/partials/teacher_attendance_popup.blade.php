@if($teacher)
    <h3 class="text-lg font-semibold mb-2">Assigned Subjects</h3>
    <ul class="list-disc list-inside mb-4">
        @forelse($teacher->assignedSubjects as $subject)
            <li>{{ $subject->subject_name }} (Semester: {{ $subject->semester }})</li>
        @empty
            <li>No subjects assigned.</li>
        @endforelse
    </ul>

    <h3 class="text-lg font-semibold mb-2">Recent Attendance</h3>
    <ul class="list-disc list-inside">
        @forelse($teacher->attendances->take(10) as $att)
            <li>{{ $att->date->format('M d, Y') }} - {{ ucfirst($att->status) }}</li>
        @empty
            <li>No attendance records found.</li>
        @endforelse
    </ul>
@else
    <p>No data found for this teacher.</p>
@endif
