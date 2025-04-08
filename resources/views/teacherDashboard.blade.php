<x-master-layout>
    @if(Auth::guard('teacher')->check())
        <h1 class="text-2xl font-bold text-center mt-10">
            Welcome, {{ Auth::guard('teacher')->user()->name }}
        </h1>
    @else
        <h1 class="text-2xl font-bold text-center mt-10 text-red-500">
            Unauthorized access. Please log in.
        </h1>
    @endif
</x-master-layout>
