<x-master-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-center">Edit CR</h2>

        <form method="POST" action="{{ route('admin.cr.update', $cr->id) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <input type="text" name="cr_name" value="{{ $cr->cr_name }}" required class="w-full border p-2 rounded">
                <input type="email" name="cr_email" value="{{ $cr->cr_email }}" required class="w-full border p-2 rounded">
                <input type="text" name="reg_no" value="{{ $cr->reg_no }}" required class="w-full border p-2 rounded">
                <input type="text" name="section" value="{{ $cr->section }}" required class="w-full border p-2 rounded">
                <input type="text" name="semester" value="{{ $cr->semester }}" required class="w-full border p-2 rounded">
                <input type="password" name="password" placeholder="Leave blank to keep old password" class="w-full border p-2 rounded">
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</x-master-layout>
