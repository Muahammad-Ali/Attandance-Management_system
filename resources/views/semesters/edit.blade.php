@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Semester</h1>
        <a href="{{ route('semesters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-900 transition">
            Back to Semesters
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <form method="POST" action="{{ route('semesters.update', $semester) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                <select id="department_id" name="department_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $semester->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="semester_number" class="block text-sm font-medium text-gray-700">Semester Number</label>
                <select id="semester_number" name="semester_number" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ old('semester_number', $semester->semester_number) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('semester_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name (Optional)</label>
                <input type="text" name="name" id="name" value="{{ old('name', $semester->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $semester->start_date ? $semester->start_date->format('Y-m-d') : '') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $semester->end_date ? $semester->end_date->format('Y-m-d') : '') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="is_active" class="inline-flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $semester->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Active Semester</span>
                </label>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-900 transition">
                    Update Semester
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 