@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <i class="fas fa-comment-alt mr-2"></i> View Feedback
        </h1>
        <a href="{{ route('cr.feedback.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Feedback Details</h3>
                <div class="space-y-3">
                    <div class="flex border-b border-gray-200 pb-2">
                        <span class="font-medium w-32">Subject:</span>
                        <span>{{ $feedback->subject->subject_name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 pb-2">
                        <span class="font-medium w-32">Teacher:</span>
                        <span>{{ $feedback->teacher->teacher_name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 pb-2">
                        <span class="font-medium w-32">Semester:</span>
                        <span>{{ $feedback->semester->semester_name }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 pb-2">
                        <span class="font-medium w-32">Rating:</span>
                        <div class="flex text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->rating)
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                            <span class="ml-2 text-gray-700">{{ $feedback->rating }}/5</span>
                        </div>
                    </div>
                    <div class="flex border-b border-gray-200 pb-2">
                        <span class="font-medium w-32">Created:</span>
                        <span>{{ $feedback->created_at->format('M d, Y g:i A') }}</span>
                    </div>
                    <div class="flex border-b border-gray-200 pb-2">
                        <span class="font-medium w-32">Updated:</span>
                        <span>{{ $feedback->updated_at->format('M d, Y g:i A') }}</span>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Comments</h3>
                <div class="bg-gray-50 p-4 rounded-md shadow-inner h-full">
                    <p class="whitespace-pre-line">{{ $feedback->comments }}</p>
                </div>
            </div>
        </div>
        
        <div class="flex space-x-3 mt-6">
            <a href="{{ route('cr.feedback.edit', $feedback->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md inline-flex items-center">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <form action="{{ route('cr.feedback.destroy', $feedback->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md inline-flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 