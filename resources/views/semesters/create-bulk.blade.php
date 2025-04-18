@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Create All Semesters</h1>
        <a href="{{ route('semesters.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-200 active:bg-gray-900 transition">
            Back to Semesters
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <div class="mb-4 p-4 bg-yellow-50 border-l-4 border-yellow-400">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        This will create all 8 semesters (1-8) for the selected department. Only the first semester will be active by default.
                    </p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('semesters.store-bulk') }}">
            @csrf

            <div class="mb-4">
                <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                <select id="department_id" name="department_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date (Optional)</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('start_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (Optional)</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    @error('end_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- CR Assignment Section for bulk creation -->
            <div class="mb-6 border-t border-gray-200 pt-4">
                <div class="mb-4">
                    <label for="assign_cr" class="inline-flex items-center">
                        <input type="checkbox" name="assign_cr" id="assign_cr" value="1" {{ old('assign_cr') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm font-medium text-gray-700">Assign Class Representatives</span>
                    </label>
                </div>

                <div id="cr_assignment_section" class="bg-gray-50 p-4 rounded-md {{ old('assign_cr') ? '' : 'hidden' }}">
                    <p class="text-sm text-gray-500 mb-4">You can assign CRs to specific semesters after creation.</p>
                    
                    <div class="mb-4 border-l-4 border-indigo-300 pl-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">For the first semester</label>
                        
                        <div class="mb-4">
                            <label for="cr_selection_type" class="block text-sm font-medium text-gray-700">Select CR for first semester</label>
                            <div class="mt-2 space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="cr_selection_type" value="existing" class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ old('cr_selection_type') != 'new' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Use Existing CR</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="cr_selection_type" value="new" class="rounded-full border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" {{ old('cr_selection_type') == 'new' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Create New CR</span>
                                </label>
                            </div>
                        </div>

                        <div id="existing_cr_section" class="{{ old('cr_selection_type') == 'new' ? 'hidden' : '' }}">
                            <div class="mb-4">
                                <label for="cr_id" class="block text-sm font-medium text-gray-700">Select Existing CR</label>
                                <select id="cr_id" name="cr_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Select a CR</option>
                                    @foreach(App\Models\Cr::all() as $cr)
                                        <option value="{{ $cr->id }}" {{ old('cr_id') == $cr->id ? 'selected' : '' }}>
                                            {{ $cr->cr_name }} ({{ $cr->reg_no }}, {{ $cr->section }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('cr_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div id="new_cr_section" class="{{ old('cr_selection_type') != 'new' ? 'hidden' : '' }}">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label for="cr_name" class="block text-sm font-medium text-gray-700">CR Name</label>
                                    <input type="text" name="cr_name" id="cr_name" value="{{ old('cr_name') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('cr_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="cr_email" class="block text-sm font-medium text-gray-700">CR Email</label>
                                    <input type="email" name="cr_email" id="cr_email" value="{{ old('cr_email') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('cr_email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="reg_no" class="block text-sm font-medium text-gray-700">Registration Number</label>
                                    <input type="text" name="reg_no" id="reg_no" value="{{ old('reg_no') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('reg_no')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="section" class="block text-sm font-medium text-gray-700">Section</label>
                                    <input type="text" name="section" id="section" value="{{ old('section') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('section')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input type="password" name="password" id="password" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-900 transition">
                    Create All Semesters
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to toggle visibility of CR assignment sections
    document.addEventListener('DOMContentLoaded', function() {
        const assignCrCheckbox = document.getElementById('assign_cr');
        const crAssignmentSection = document.getElementById('cr_assignment_section');
        const crSelectionTypeRadios = document.querySelectorAll('input[name="cr_selection_type"]');
        const existingCrSection = document.getElementById('existing_cr_section');
        const newCrSection = document.getElementById('new_cr_section');

        // Toggle CR assignment section
        assignCrCheckbox.addEventListener('change', function() {
            crAssignmentSection.classList.toggle('hidden', !this.checked);
        });

        // Toggle between existing and new CR sections
        crSelectionTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                existingCrSection.classList.toggle('hidden', this.value === 'new');
                newCrSection.classList.toggle('hidden', this.value !== 'new');
            });
        });
    });
</script>
@endsection 