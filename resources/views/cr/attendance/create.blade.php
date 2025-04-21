@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Record Teacher Attendance</h4>
                    <a href="{{ route('cr.attendance.index') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('cr.attendance.store') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="teacher_id" class="form-label fw-bold">Teacher</label>
                                <select id="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" required>
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subject_id" class="form-label fw-bold">Subject</label>
                                <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required>
                                    <option value="">Select Subject</option>
                                    @foreach($assignedSubjects as $subject)
                                    <option
                                        value="{{ $subject->id }}"
                                        data-semester="{{ $subject->semester }}"
                                        data-teacher="{{ $subject->teacher_id }}"
                                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject_name }} (Teacher: {{ $subject->teacher->name ?? 'N/A' }})
                                    </option>
                                @endforeach

                                </select>
                                @error('subject_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="semester_id" class="form-label fw-bold">Semester</label>
                                <select id="semester_id" class="form-control @error('semester_id') is-invalid @enderror" name="semester_id" required>
                                    <option value="">Select Semester</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                            {{ $semester->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('semester_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date" class="form-label fw-bold">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                @error('date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label for="day" class="form-label fw-bold">Day</label>
                                <select id="day" class="form-control @error('day') is-invalid @enderror" name="day" required>
                                    <option value="Monday" {{ old('day') == 'Monday' ? 'selected' : '' }}>Monday</option>
                                    <option value="Tuesday" {{ old('day') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                    <option value="Wednesday" {{ old('day') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                    <option value="Thursday" {{ old('day') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                    <option value="Friday" {{ old('day') == 'Friday' ? 'selected' : '' }}>Friday</option>
                                    <option value="Saturday" {{ old('day') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                </select>
                                @error('day')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="start_time" class="form-label fw-bold">Start Time</label>
                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                                @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="end_time" class="form-label fw-bold">End Time</label>
                                <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                                @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label fw-bold">Status</label>
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                    <option value="late" {{ old('status') == 'late' ? 'selected' : '' }}>Late</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="remarks" class="form-label fw-bold">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100 py-2">
                                    <i class="fas fa-save me-2"></i> Record Attendance
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Additional styles to fix UI issues */
.form-control, .form-select {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

.btn-primary {
    color: #fff;
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0b5ed7;
    border-color: #0a58ca;
}
</style>

@push('scripts')
<script>
    // Set day based on date
    document.addEventListener('DOMContentLoaded', function() {
        // Initial set of day based on date
        const dateInput = document.getElementById('date');
        if (dateInput && dateInput.value) {
            const date = new Date(dateInput.value);
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const day = days[date.getDay()];
            const daySelect = document.getElementById('day');
            if (daySelect) {
                daySelect.value = day;
            }
        }

        // Set up event listener for date changes
        if (dateInput) {
            dateInput.addEventListener('change', function() {
                const date = new Date(this.value);
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                const day = days[date.getDay()];
                const daySelect = document.getElementById('day');
                if (daySelect) {
                    daySelect.value = day;
                }
            });
        }

        // Update semester when subject changes
        const subjectSelect = document.getElementById('subject_id');
        const semesterSelect = document.getElementById('semester_id');

        if (subjectSelect && semesterSelect) {
            subjectSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption && selectedOption.dataset.semester) {
                    semesterSelect.value = selectedOption.dataset.semester;
                }
            });

            // Trigger change if there's a pre-selected value
            if (subjectSelect.value) {
                subjectSelect.dispatchEvent(new Event('change'));
            }
        }
    });
</script>
@endpush
@endsection
