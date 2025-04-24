<x-master-layout>
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Semester Coordinator Details</h1>
            <a href="{{ route('semestercoordinator.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back to List
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold mb-2">Basic Information</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-gray-500 text-sm">Name</label>
                            <p class="font-medium">{{ $semesterCoordinator->name }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 text-sm">Email</label>
                            <p class="font-medium">{{ $semesterCoordinator->email }}</p>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h2 class="text-lg font-semibold mb-2">Assignment Details</h2>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-gray-500 text-sm">Department</label>
                            <p class="font-medium">{{ $semesterCoordinator->department->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-gray-500 text-sm">Semester</label>
                            <p class="font-medium">{{ $semesterCoordinator->semester->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t flex justify-between">
                <a href="{{ route('semestercoordinator.edit', $semesterCoordinator->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Edit Details
                </a>
                <form action="{{ route('semestercoordinator.destroy', $semesterCoordinator->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this semester coordinator?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Delete Coordinator
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-master-layout> 