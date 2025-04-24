<x-master-layout>
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Edit Semester Coordinator</h1>
            <a href="{{ route('semestercoordinator.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to List
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('semestercoordinator.update', $semesterCoordinator->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ old('name', $semesterCoordinator->name) }}" required>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" value="{{ old('email', $semesterCoordinator->email) }}" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password (leave empty to keep current)</label>
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="department_id" class="block text-gray-700 font-bold mb-2">Department</label>
                    <select name="department_id" id="department_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $semesterCoordinator->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="semester_id" class="block text-gray-700 font-bold mb-2">Semester</label>
                    <select name="semester_id" id="semester_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
                        <option value="">Select Semester</option>
                        @foreach($semesters as $semester)
                        <option value="{{ $semester->id }}" {{ old('semester_id', $semesterCoordinator->semester_id) == $semester->id ? 'selected' : '' }}>
                            {{ $semester->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('semester_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Update Semester Coordinator
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-master-layout> 