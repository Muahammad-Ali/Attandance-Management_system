<x-master-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">CR Details</h2>
        <ul class="space-y-2">
            <li><strong>Name:</strong> {{ $cr->cr_name }}</li>
            <li><strong>Email:</strong> {{ $cr->cr_email }}</li>
            <li><strong>Reg No:</strong> {{ $cr->reg_no }}</li>
            <li><strong>Section:</strong> {{ $cr->section }}</li>
            <li><strong>Semester:</strong> {{ $cr->semester }}</li>
        </ul>
        <div class="mt-4 text-center">
            <a href="{{ route('admin.cr.index') }}" class="text-indigo-600 hover:underline">← Back to list</a>
        </div>
    </div>
</x-master-layout>
