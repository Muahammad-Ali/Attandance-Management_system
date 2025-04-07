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
                    Admin Dashboard
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
                        <a class="text-black" href="{{ route('feedback') }}">Feedback</a>

                    </div>
                </div>
            </div>

            <div class="p-4 space-y-2">
                <div class="flex items-center ml-6 space-x-1">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M6.40001 3.99999C6.40019 4.56729 6.19941 5.11632 5.83329 5.54966C5.46717 5.983 4.95938 6.27264 4.40001 6.36719V9.63279C4.99337 9.73309 5.5274 10.0526 5.89627 10.5281C6.26514 11.0036 6.44193 11.6003 6.3916 12.1999C6.34128 12.7996 6.06751 13.3585 5.62456 13.7658C5.1816 14.1732 4.60179 14.3992 4.00001 14.3992C3.39823 14.3992 2.81842 14.1732 2.37546 13.7658C1.93251 13.3585 1.65874 12.7996 1.60842 12.1999C1.55809 11.6003 1.73488 11.0036 2.10375 10.5281C2.47262 10.0526 3.00665 9.73309 3.60001 9.63279V6.36799C3.1489 6.29174 2.72899 6.08814 2.38974 5.78118C2.0505 5.47421 1.80606 5.07668 1.68523 4.63541C1.5644 4.19415 1.57221 3.72754 1.70774 3.29057C1.84328 2.8536 2.10089 2.46447 2.45022 2.16904C2.79955 1.8736 3.22605 1.68417 3.67946 1.62306C4.13287 1.56196 4.59429 1.63172 5.00937 1.82413C5.42445 2.01655 5.77589 2.32359 6.02227 2.70909C6.26865 3.09459 6.39971 3.54248 6.40001 3.99999ZM9.48321 5.48319C9.44605 5.52044 9.40191 5.55 9.35332 5.57016C9.30472 5.59033 9.25262 5.60071 9.20001 5.60071C9.1474 5.60071 9.0953 5.59033 9.0467 5.57016C8.99811 5.55 8.95397 5.52044 8.91681 5.48319L7.31681 3.88319C7.27956 3.84604 7.25001 3.8019 7.22984 3.7533C7.20968 3.7047 7.1993 3.65261 7.1993 3.59999C7.1993 3.54738 7.20968 3.49528 7.22984 3.44669C7.25001 3.39809 7.27956 3.35395 7.31681 3.31679L8.91681 1.71679C8.99192 1.64168 9.09379 1.59949 9.20001 1.59949C9.30623 1.59949 9.4081 1.64168 9.48321 1.71679C9.55832 1.7919 9.60052 1.89377 9.60052 1.99999C9.60052 2.10621 9.55832 2.20808 9.48321 2.28319L8.56561 3.19999H10C10.7426 3.19999 11.4548 3.49499 11.9799 4.02009C12.505 4.5452 12.8 5.25739 12.8 5.99999V9.73599C13.3674 9.93556 13.8393 10.3409 14.1221 10.8717C14.405 11.4025 14.4784 12.0201 14.3276 12.6024C14.1769 13.1847 13.8131 13.6892 13.3082 14.0161C12.8033 14.343 12.1941 14.4684 11.6011 14.3676C11.0081 14.2668 10.4746 13.9471 10.106 13.4717C9.7375 12.9964 9.56084 12.4 9.611 11.8006C9.66115 11.2012 9.93447 10.6425 10.3769 10.235C10.8193 9.82745 11.3985 9.60085 12 9.59999V5.99999C12 5.46956 11.7893 4.96085 11.4142 4.58578C11.0392 4.21071 10.5304 3.99999 10 3.99999H8.56561L9.48321 4.91679C9.52046 4.95395 9.55002 4.99809 9.57018 5.04669C9.59035 5.09528 9.60073 5.14738 9.60073 5.19999C9.60073 5.25261 9.59035 5.3047 9.57018 5.3533C9.55002 5.4019 9.52046 5.44604 9.48321 5.48319Z"
                            fill="#99A1B7" />
                    </svg>

                    <!-- Additional Item Request -->
                    <span class="space-y-2 font-semibold text-gray-500">Features</span>
                </div>

                <div class="flex items-center px-1 space-x-1 text-slate-500 ml-9">
                    <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.71 7.28997L4.3 4.69997C4.3927 4.60746 4.46625 4.49757 4.51643 4.3766C4.56661 4.25562 4.59244 4.12594 4.59244 3.99497C4.59244 3.864 4.56661 3.73432 4.51643 3.61335C4.46625 3.49237 4.3927 3.38248 4.3 3.28997L1.71 0.699971C1.08 0.0799712 0 0.519971 0 1.40997V6.57997C0 7.47997 1.08 7.91997 1.71 7.28997Z"
                            fill="#99A1B7" />
                    </svg>
                    <a class="text-black" href="{{ route('applications') }}">Applications</a>
                </div>

                <div class="flex items-center px-1 space-x-1 text-center text-gray-800 ml-9">
                    <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.71 7.28997L4.3 4.69997C4.3927 4.60746 4.46625 4.49757 4.51643 4.3766C4.56661 4.25562 4.59244 4.12594 4.59244 3.99497C4.59244 3.864 4.56661 3.73432 4.51643 3.61335C4.46625 3.49237 4.3927 3.38248 4.3 3.28997L1.71 0.699971C1.08 0.0799712 0 0.519971 0 1.40997V6.57997C0 7.47997 1.08 7.91997 1.71 7.28997Z"
                            fill="#99A1B7" />
                    </svg>

                    <a class="text-black"  href="{{ route('teacher') }}">Teacher</a>

                </div>

                <div class="flex items-center px-1 space-x-1 text-center text-gray-800 ml-9">
                    <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.71 7.28997L4.3 4.69997C4.3927 4.60746 4.46625 4.49757 4.51643 4.3766C4.56661 4.25562 4.59244 4.12594 4.59244 3.99497C4.59244 3.864 4.56661 3.73432 4.51643 3.61335C4.46625 3.49237 4.3927 3.38248 4.3 3.28997L1.71 0.699971C1.08 0.0799712 0 0.519971 0 1.40997V6.57997C0 7.47997 1.08 7.91997 1.71 7.28997Z"
                            fill="#99A1B7" />
                    </svg>

                    <a class="text-black" href="{{ route('cr') }}">cr</a>

                </div>

                <div class="flex items-center px-1 space-x-1 text-center text-gray-800 ml-9">
                    <svg width="5" height="8" viewBox="0 0 5 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.71 7.28997L4.3 4.69997C4.3927 4.60746 4.46625 4.49757 4.51643 4.3766C4.56661 4.25562 4.59244 4.12594 4.59244 3.99497C4.59244 3.864 4.56661 3.73432 4.51643 3.61335C4.46625 3.49237 4.3927 3.38248 4.3 3.28997L1.71 0.699971C1.08 0.0799712 0 0.519971 0 1.40997V6.57997C0 7.47997 1.08 7.91997 1.71 7.28997Z"
                            fill="#99A1B7" />
                    </svg>

                    <a class="text-black" href="{{ route('subject') }}">Subject</a>

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
