@extends('layouts.app')

@section('content')
<div class="container px-6 mx-auto grid">
    <div class="flex items-center justify-between my-6">
        <h2 class="text-2xl font-semibold text-gray-700">
            Feedback Details
        </h2>
        <a href="{{ route('cr.feedback.index') }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-600 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 my-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Subject Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Subject Information</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="mb-2">
                        <span class="font-medium text-gray-600">Name:</span>
                        <span class="ml-2 text-gray-800">{{ $feedback->subject->subject_name }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600">Code:</span>
                        <span class="ml-2 text-gray-800">{{ $feedback->subject->subject_code }}</span>
                    </div>
                </div>
            </div>

            <!-- Teacher Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Teacher Information</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div>
                        <span class="font-medium text-gray-600">Name:</span>
                        <span class="ml-2 text-gray-800">{{ $feedback->teacher->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Semester Information -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Semester Information</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div>
                        <span class="font-medium text-gray-600">Name:</span>
                        <span class="ml-2 text-gray-800">{{ $feedback->semester->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Rating -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Rating</h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $feedback->rating)
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm text-gray-600">({{ $feedback->rating }}/5)</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Comments</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-800 whitespace-pre-line">{{ $feedback->comments ?? 'No comments provided.' }}</p>
            </div>
        </div>

        <!-- Metadata Section -->
        <div class="mt-6 text-sm text-gray-600">
            <p>Created: {{ $feedback->created_at->format('M d, Y h:i A') }}</p>
            @if($feedback->created_at != $feedback->updated_at)
                <p>Last Updated: {{ $feedback->updated_at->format('M d, Y h:i A') }}</p>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="mt-6 flex space-x-3">
            <a href="{{ route('cr.feedback.edit', $feedback) }}" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-yellow-600 border border-transparent rounded-lg active:bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:shadow-outline-yellow">
                <i class="fas fa-edit mr-1"></i> Edit
            </a>
            <form action="{{ route('cr.feedback.destroy', $feedback) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                    <i class="fas fa-trash mr-1"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 