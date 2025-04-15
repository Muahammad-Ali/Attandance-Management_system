<div class="flex h-screen border-r ">
    <!-- Sidebar -->
    <aside
        class="fixed top-0 left-0 z-40 h-full px-4 py-6 overflow-auto capitalize transition-transform -translate-x-full bg-white w-72 lg:translate-x-0"
        aria-label="Sidebar" id="default-sidebar">
        <!-- Heading -->
        <div class=" text-folly">
            <h1 class="text-xl font-bold ">
                Attendance Management
                <span class="text-2xl">System</span>
            </h1>
        </div>

        <!-- Sidebar Links -->
        <nav class="mt-2">
            <div class="flex items-center justify-between px-3 py-1 space-x-3 text-white rounded-md bg-folly w-fit">
                <div>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.66667 6V2H14V6H8.66667ZM2 8.66667V2H7.33333V8.66667H2ZM8.66667 14V7.33333H14V14H8.66667ZM2 14V10H7.33333V14H2Z"
                            fill="white" />
                    </svg>
                </div>
                <div>
                    {{-- <a href="{{ route('dashboard') }}" class="font-bold">
                        @if (auth()->user()->hasRole('SuperAdmin'))
                            SuperAdmin Dashboard
                        @elseif (auth()->user()->hasRole('Admin'))
                            Admin Dashboard
                        @elseif (auth()->user()->hasRole('User'))
                            Employee Dashboard
                        @endif
                    </a> --}}
                    Teacher Dashboard
                </div>
            </div>

            <!-- Additional Sections -->
            <div class="p-4">
                <!-- Meal -->
                <div class="daily-meal-count">
                    <div class="flex items-center ml-6 space-x-1">
                        <LayoutDashboard />

                        <a href="{{ route('dashboard') }}" class="flex items-center py-2 font-semibold text-gray-500 rounded-lg">
                            Dashboard
                        </a>
                    </div>
                    {{-- Daily Meal Count --}}
                    <div class="flex items-center space-x-1 text-slate-500 ml-9">
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.71 7.28997L4.3 4.69997C4.3927 4.60746 4.46625 4.49757 4.51643 4.3766C4.56661 4.25562 4.59244 4.12594 4.59244 3.99497C4.59244 3.864 4.56661 3.73432 4.51643 3.61335C4.46625 3.49237 4.3927 3.38248 4.3 3.28997L1.71 0.699971C1.08 0.0799712 0 0.519971 0 1.40997V6.57997C0 7.47997 1.08 7.91997 1.71 7.28997Z"
                                fill="#99A1B7" />
                        </svg>
                        <a class="text-black" href="{{ route('teachersubjects') }}">See Attendances</a>

                    </div>
                    <div class="flex items-center space-x-1 text-slate-500 ml-9">
                        <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.71 7.28997L4.3 4.69997C4.3927 4.60746 4.46625 4.49757 4.51643 4.3766C4.56661 4.25562 4.59244 4.12594 4.59244 3.99497C4.59244 3.864 4.56661 3.73432 4.51643 3.61335C4.46625 3.49237 4.3927 3.38248 4.3 3.28997L1.71 0.699971C1.08 0.0799712 0 0.519971 0 1.40997V6.57997C0 7.47997 1.08 7.91997 1.71 7.28997Z"
                                fill="#99A1B7" />
                        </svg>
                        <a class="text-black" href="{{ route('teachersubjects') }}">Assign Subject</a>

                    </div>
                </div>
            </div>





            </div>


        </nav>

    </aside>



</div>

<script type="text/javascript">
    // document.addEventListener('DOMContentLoaded', () => {
    //     const button = document.getElementById('menu-button');
    //     const menu = document.getElementById('menu');

    //     button.addEventListener('click', () => {
    //         const isExpanded = button.getAttribute('aria-expanded') === 'true';
    //         button.setAttribute('aria-expanded', !isExpanded);
    //         menu.classList.toggle('hidden', isExpanded);
    //         menu.classList.toggle('show', !isExpanded);
    //     });

    //     // Optional: Close the menu when clicking outside
    //     document.addEventListener('click', (event) => {
    //         if (!button.contains(event.target) && !menu.contains(event.target)) {
    //             button.setAttribute('aria-expanded', 'false');
    //             menu.classList.add('hidden');
    //             menu.classList.remove('show');
    //         }
    //     });
    // });
</script>
