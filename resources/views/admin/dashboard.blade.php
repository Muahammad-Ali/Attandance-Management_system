<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-4">Welcome to the Admin Dashboard</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">Teachers</h3>
                            <p class="text-3xl font-bold">{{ $teacherCount }}</p>
                            <a href="#" class="text-blue-600 hover:underline">View all</a>
                        </div>
                        
                        <div class="bg-green-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">Class Representatives</h3>
                            <p class="text-3xl font-bold">{{ $crCount }}</p>
                            <a href="#" class="text-green-600 hover:underline">View all</a>
                        </div>
                        
                        <div class="bg-yellow-100 p-4 rounded-lg shadow">
                            <h3 class="text-lg font-semibold">Subjects</h3>
                            <p class="text-3xl font-bold">{{ $subjectCount }}</p>
                            <a href="#" class="text-yellow-600 hover:underline">View all</a>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Quick Links</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('teacher') }}" class="bg-indigo-100 p-4 rounded-lg shadow hover:bg-indigo-200">
                                <h4 class="font-medium">Manage Teachers</h4>
                            </a>
                            <a href="{{ route('cr') }}" class="bg-pink-100 p-4 rounded-lg shadow hover:bg-pink-200">
                                <h4 class="font-medium">Manage CRs</h4>
                            </a>
                            <a href="{{ route('subject') }}" class="bg-purple-100 p-4 rounded-lg shadow hover:bg-purple-200">
                                <h4 class="font-medium">Manage Subjects</h4>
                            </a>
                            <a href="{{ route('admin.attendance.index') }}" class="bg-teal-100 p-4 rounded-lg shadow hover:bg-teal-200">
                                <h4 class="font-medium">View Attendance</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 