@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Subject Feedback</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cr.feedback.store') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="subject_id" class="col-md-4 col-form-label text-md-right">Subject</label>
                            <div class="col-md-6">
                                <select id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" name="subject_id" required>
                                    <option value="">Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }} ({{ $subject->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="teacher_id" class="col-md-4 col-form-label text-md-right">Teacher</label>
                            <div class="col-md-6">
                                <select id="teacher_id" class="form-control @error('teacher_id') is-invalid @enderror" name="teacher_id" required>
                                    <option value="">Select Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="semester_id" class="col-md-4 col-form-label text-md-right">Semester</label>
                            <div class="col-md-6">
                                <select id="semester_id" class="form-control @error('semester_id') is-invalid @enderror" name="semester_id" required>
                                    <option value="">Select Semester</option>
                                    @foreach($semesters as $semester)
                                        <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                            {{ $semester->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('semester_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">Rating</label>
                            <div class="col-md-6">
                                <select id="rating" class="form-control @error('rating') is-invalid @enderror" name="rating" required>
                                    <option value="">Select Rating</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">Comments</label>
                            <div class="col-md-6">
                                <textarea id="comments" class="form-control @error('comments') is-invalid @enderror" name="comments" rows="4">{{ old('comments') }}</textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit Feedback
                                </button>
                                <a href="{{ route('cr.feedback.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 