@extends('layouts.app')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex items-center justify-between my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Edit Feedback
        </h2>
        <a href="{{ route('cr.feedback.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>

    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">Success!</span> {{ session('success') }}
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <form action="{{ route('cr.feedback.update', $feedback) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid gap-6 mb-4 md:grid-cols-2">
                <!-- Subject -->
                <div>
                    <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Subject <span class="text-red-500">*</span>
                    </label>
                    <select id="subject_id" name="subject_id" class="block w-full mt-1 text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                        <option value="">Select subject</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $feedback->subject_id) == $subject->id ? 'selected' : '' }}>
                                {{ $subject->subject_name }} ({{ $subject->subject_code }})
                            </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Teacher -->
                <div>
                    <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Teacher <span class="text-red-500">*</span>
                    </label>
                    <select id="teacher_id" name="teacher_id" class="block w-full mt-1 text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                        <option value="">Select teacher</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $feedback->teacher_id) == $teacher->id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Semester -->
                <div>
                    <label for="semester_id" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Semester <span class="text-red-500">*</span>
                    </label>
                    <select id="semester_id" name="semester_id" class="block w-full mt-1 text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                        <option value="">Select semester</option>
                        @foreach ($semesters as $semester)
                            <option value="{{ $semester->id }}" {{ old('semester_id', $feedback->semester_id) == $semester->id ? 'selected' : '' }}>
                                {{ $semester->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('semester_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Rating <span class="text-red-500">*</span>
                    </label>
                    <select id="rating" name="rating" class="block w-full mt-1 text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>
                        <option value="">Select rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating', $feedback->rating) == $i ? 'selected' : '' }}>
                                {{ $i }} - {{ $i == 1 ? 'Poor' : ($i == 2 ? 'Fair' : ($i == 3 ? 'Good' : ($i == 4 ? 'Very Good' : 'Excellent'))) }}
                            </option>
                        @endfor
                    </select>
                    @error('rating')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Comments -->
            <div class="mb-4">
                <label for="comments" class="block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Comments <span class="text-red-500">*</span>
                </label>
                <textarea id="comments" name="comments" rows="4" class="block w-full mt-1 text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" required>{{ old('comments', $feedback->comments) }}</textarea>
                @error('comments')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end mt-6 space-x-3">
                <a href="{{ route('cr.feedback.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-100 focus:outline-none focus:shadow-outline-gray">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update Feedback
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 