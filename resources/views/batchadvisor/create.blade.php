<x-master-layout>
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Add New Batch Advisor</h1>
            <a href="{{ route('batchadvisor.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to List
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('batchadvisor.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ old('name') }}" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="department_id" class="block text-gray-700 font-bold mb-2">Department</label>
                    <select name="department_id" id="department_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="batch" class="block text-gray-700 font-bold mb-2">Batch</label>
                    <input type="text" name="batch" id="batch" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ old('batch') }}" required>
                    @error('batch')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Create Batch Advisor
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout> 