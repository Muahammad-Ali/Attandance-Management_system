@extends('layouts.app')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex items-center justify-between my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Add Subject Feedback
        </h2>
        <a href="{{ route('cr.feedback.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Back to List
        </a>
    </div>

    @if (session('success'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
        <span class="font-medium">Success!</span> {{ session('success') }}
    </div>
    @endif

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
        <form action="{{ route('cr.feedback.store') }}" method="POST">
            @csrf
            
            <div class="grid gap-6 mb-6 md:grid-cols-2">
                <!-- Subject -->
                <div>
                    <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
                    <select id="subject_id" name="subject_id" class="block w-full mt-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('subject_id') border-red-600 focus:border-red-400 focus:ring-red-200 @enderror">
                        <option value="">Select Subject</option>
                        @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->subject_name }} ({{ $subject->subject_code }})
                        </option>
                        @endforeach
                    </select>
                    @error('subject_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teacher -->
                <div>
                    <label for="teacher_id" class="block text-sm font-medium text-gray-700">Teacher</label>
                    <select id="teacher_id" name="teacher_id" class="block w-full mt-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('teacher_id') border-red-600 focus:border-red-400 focus:ring-red-200 @enderror">
                        <option value="">Select Teacher</option>
                        @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('teacher_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Semester -->
                <div>
                    <label for="semester_id" class="block text-sm font-medium text-gray-700">Semester</label>
                    <select id="semester_id" name="semester_id" class="block w-full mt-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('semester_id') border-red-600 focus:border-red-400 focus:ring-red-200 @enderror">
                        <option value="">Select Semester</option>
                        @foreach ($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                            {{ $semester->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('semester_id')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                    <select id="rating" name="rating" class="block w-full mt-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('rating') border-red-600 focus:border-red-400 focus:ring-red-200 @enderror">
                        <option value="">Select Rating</option>
                        @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} - {{ $i == 1 ? 'Poor' : ($i == 2 ? 'Fair' : ($i == 3 ? 'Good' : ($i == 4 ? 'Very Good' : 'Excellent'))) }}
                        </option>
                        @endfor
                    </select>
                    @error('rating')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Comments -->
            <div class="mb-6">
                <label for="comments" class="block text-sm font-medium text-gray-700">Comments</label>
                <textarea id="comments" name="comments" rows="4" class="block w-full mt-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-purple-400 focus:ring focus:ring-purple-200 focus:ring-opacity-50 @error('comments') border-red-600 focus:border-red-400 focus:ring-red-200 @enderror">{{ old('comments') }}</textarea>
                @error('comments')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Please provide detailed feedback about your experience with this subject and teacher.</p>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" onclick="window.history.back()" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Submit Feedback
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 