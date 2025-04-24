<x-master-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-6">Batch Advisor Dashboard</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold">Welcome, {{ Auth::guard('batchadvisor')->user()->name }}</h2>
            </div>

            <div class="border-t pt-4">
                <h3 class="text-lg font-semibold mb-2">Your Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Email</p>
                        <p class="font-medium">{{ Auth::guard('batchadvisor')->user()->email }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Batch</p>
                        <p class="font-medium">{{ Auth::guard('batchadvisor')->user()->batch }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Department</p>
                        <p class="font-medium">{{ Auth::guard('batchadvisor')->user()->department->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Batch Information</h3>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-blue-800">You are managing students from batch {{ Auth::guard('batchadvisor')->user()->batch }}.</p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="#" class="bg-blue-100 hover:bg-blue-200 p-4 rounded-lg">
                        <h4 class="font-medium mb-1">View Attendance</h4>
                        <p class="text-sm text-gray-600">Check student attendance records</p>
                    </a>
                    <a href="#" class="bg-green-100 hover:bg-green-200 p-4 rounded-lg">
                        <h4 class="font-medium mb-1">Student Performance</h4>
                        <p class="text-sm text-gray-600">Track academic performance</p>
                    </a>
                    <a href="#" class="bg-purple-100 hover:bg-purple-200 p-4 rounded-lg">
                        <h4 class="font-medium mb-1">Applications</h4>
                        <p class="text-sm text-gray-600">Review student applications</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-master-layout> 