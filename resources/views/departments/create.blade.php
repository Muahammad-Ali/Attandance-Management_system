<x-master-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Add New Department</h1>
            <a href="{{ route('departments.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition-colors">
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('departments.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Department Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="code" class="block text-gray-700 font-bold mb-2">Department Code</label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('code') border-red-500 @enderror"
                           placeholder="e.g., CS, DS">
                    @error('code')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition-colors">
                        Create Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout> 