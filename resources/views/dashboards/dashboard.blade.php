<x-master-layout>
    <!-- Main Content Area -->
    <main x-data="{ activeTable: null }">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Welcome to dashboard !</h1>
        </div>

        <div class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-3">
            <!-- Box 1 - Present -->
            <div
                class="p-4 bg-white border rounded-lg shadow-xl border-folly h-36 cursor-pointer hover:shadow-2xl transition-shadow"
                @click="activeTable = activeTable === 'present' ? null : 'present'">
                <div>
                    <i class="flex items-center justify-center mt-0 text-white rounded-md bg-folly w-9 h-9">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.00001 5.00002C8.00023 5.70915 7.74926 6.39543 7.2916 6.93711C6.83395 7.47878 6.19921 7.84083 5.50001 7.95902V12.041C6.2417 12.1664 6.90924 12.5658 7.37033 13.1602C7.83142 13.7545 8.0524 14.5004 7.9895 15.2499C7.92659 15.9995 7.58438 16.6981 7.03069 17.2073C6.477 17.7165 5.75223 17.9991 5.00001 17.9991C4.24779 17.9991 3.52301 17.7165 2.96932 17.2073C2.41563 16.6981 2.07342 15.9995 2.01051 15.2499C1.94761 14.5004 2.1686 13.7545 2.62968 13.1602C3.09077 12.5658 3.75831 12.1664 4.50001 12.041V7.96002C3.93612 7.86471 3.41122 7.6102 2.98717 7.2265C2.56311 6.8428 2.25756 6.34588 2.10653 5.7943C1.95549 5.24272 1.96525 4.65946 2.13467 4.11324C2.30409 3.56703 2.6261 3.08062 3.06277 2.71133C3.49943 2.34203 4.03255 2.10524 4.59931 2.02886C5.16607 1.95248 5.74286 2.03968 6.26171 2.2802C6.78056 2.52071 7.21985 2.90452 7.52783 3.3864C7.83581 3.86827 7.99963 4.42814 8.00001 5.00002ZM11.854 6.85402C11.8076 6.90058 11.7524 6.93753 11.6916 6.96273C11.6309 6.98794 11.5658 7.00091 11.5 7.00091C11.4342 7.00091 11.3691 6.98794 11.3084 6.96273C11.2476 6.93753 11.1925 6.90058 11.146 6.85402L9.14601 4.85402C9.09944 4.80758 9.0625 4.7524 9.03729 4.69165C9.01209 4.63091 8.99911 4.56579 8.99911 4.50002C8.99911 4.43425 9.01209 4.36913 9.03729 4.30839C9.0625 4.24764 9.09944 4.19247 9.14601 4.14602L11.146 2.14602C11.2399 2.05213 11.3672 1.99939 11.5 1.99939C11.6328 1.99939 11.7601 2.05213 11.854 2.14602C11.9479 2.23991 12.0006 2.36725 12.0006 2.50002C12.0006 2.6328 11.9479 2.76013 11.854 2.85402L10.707 4.00002H12.5C13.4283 4.00002 14.3185 4.36877 14.9749 5.02515C15.6313 5.68152 16 6.57176 16 7.50002V12.17C16.7093 12.4195 17.2991 12.9261 17.6527 13.5896C18.0063 14.2531 18.0979 15.0252 17.9095 15.7531C17.7211 16.4809 17.2663 17.1116 16.6352 17.5202C16.0041 17.9288 15.2426 18.0856 14.5013 17.9596C13.7601 17.8336 13.0932 17.4339 12.6325 16.8397C12.1719 16.2455 11.951 15.5 12.0137 14.7508C12.0764 14.0015 12.4181 13.3031 12.9711 12.7937C13.5241 12.2843 14.2481 12.0011 15 12V7.50002C15 6.83698 14.7366 6.2011 14.2678 5.73225C13.7989 5.26341 13.163 5.00002 12.5 5.00002H10.707L11.854 6.14602C11.9006 6.19247 11.9375 6.24764 11.9627 6.30839C11.9879 6.36913 12.0009 6.43425 12.0009 6.50002C12.0009 6.56579 11.9879 6.63091 11.9627 6.69166C11.9375 6.7524 11.9006 6.80758 11.854 6.85402Z"
                                fill="white" />
                        </svg>
                    </i>
                    <h1 class="mt-4 text-2xl font-extrabold">35</h1>
                    <p>Present/Today</p>
                </div>
            </div>

            <!-- Box 2 - Absent -->
            <div
                class="p-4 bg-white border rounded-lg shadow-xl border-folly h-36 cursor-pointer hover:shadow-2xl transition-shadow"
                @click="activeTable = activeTable === 'absent' ? null : 'absent'">
                <div class="">
                    <i class="flex items-center justify-center text-white rounded-md bg-folly w-9 h-9">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M23 12L20.56 9.22004L20.9 5.54004L17.29 4.72004L15.4 1.54004L12 3.00004L8.6 1.54004L6.71 4.72004L3.1 5.53004L3.44 9.21004L1 12L3.44 14.78L3.1 18.47L6.71 19.29L8.6 22.47L12 21L15.4 22.46L17.29 19.28L20.9 18.46L20.56 14.78L23 12ZM10 17L6 13L7.41 11.59L10 14.17L16.59 7.58004L18 9.00004L10 17Z"
                                fill="white" />
                        </svg>
                    </i>
                    <h1 class="mt-4 text-2xl font-extrabold">07</h1>
                    <p>Absent/Today</p>
                </div>
            </div>

            <!-- Box 3 - Monthly -->
            <div
                class="p-4 bg-white border rounded-lg shadow-xl border-folly h-36 cursor-pointer hover:shadow-2xl transition-shadow"
                @click="activeTable = activeTable === 'monthly' ? null : 'monthly'">
                <div class="">
                    <i class="flex items-center justify-center text-white rounded-md bg-folly w-9 h-9">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M1 0C0.734784 0 0.48043 0.105357 0.292893 0.292893C0.105357 0.48043 0 0.734784 0 1V15C0 16.354 0.897 17.498 2.129 17.872C2.3124 18.477 2.68224 19.0086 3.18573 19.3909C3.68921 19.7732 4.3006 19.9867 4.93263 20.0009C5.56466 20.0151 6.18502 19.8293 6.70516 19.4699C7.22529 19.1106 7.61862 18.5962 7.829 18H14.171C14.3814 18.5962 14.7747 19.1106 15.2948 19.4699C15.815 19.8293 16.4353 20.0151 17.0674 20.0009C17.6994 19.9867 18.3108 19.7732 18.8143 19.3909C19.3178 19.0086 19.6876 18.477 19.871 17.872C20.4871 17.6851 21.0266 17.305 21.41 16.7878C21.7934 16.2706 22.0003 15.6438 22 15V11C22 10.3434 21.8707 9.69321 21.6194 9.08658C21.3681 8.47996 20.9998 7.92876 20.5355 7.46447C20.0712 7.00017 19.52 6.63188 18.9134 6.3806C18.3068 6.12933 17.6566 6 17 6H13V1C13 0.734784 12.8946 0.48043 12.7071 0.292893C12.5196 0.105357 12.2652 0 12 0H1ZM14.171 16H13V8H17C17.7956 8 18.5587 8.31607 19.1213 8.87868C19.6839 9.44129 20 10.2044 20 11V15C19.9999 15.2652 19.8946 15.5195 19.707 15.707C19.4513 15.1714 19.0426 14.7237 18.5325 14.4205C18.0223 14.1173 17.4337 13.9722 16.8411 14.0036C16.2485 14.0349 15.6785 14.2414 15.2032 14.5967C14.7279 14.9521 14.3687 15.4404 14.171 16ZM4.293 16.293C4.38525 16.1975 4.49559 16.1213 4.6176 16.0689C4.7396 16.0165 4.87082 15.9889 5.0036 15.9877C5.13638 15.9866 5.26806 16.0119 5.39095 16.0622C5.51385 16.1125 5.6255 16.1867 5.7194 16.2806C5.81329 16.3745 5.88754 16.4862 5.93782 16.609C5.9881 16.7319 6.0134 16.8636 6.01225 16.9964C6.0111 17.1292 5.98351 17.2604 5.9311 17.3824C5.87869 17.5044 5.80251 17.6148 5.707 17.707C5.5184 17.8892 5.2658 17.99 5.0036 17.9877C4.7414 17.9854 4.49059 17.8802 4.30518 17.6948C4.11977 17.5094 4.0146 17.2586 4.01233 16.9964C4.01005 16.7342 4.11084 16.4816 4.293 16.293ZM16 17C16 16.7348 16.1054 16.4804 16.2929 16.2929C16.4804 16.1054 16.7348 16 17 16C17.2652 16 17.5196 16.1054 17.7071 16.2929C17.8946 16.4804 18 16.7348 18 17C18 17.2652 17.8946 17.5196 17.7071 17.7071C17.5196 17.8946 17.2652 18 17 18C16.7348 18 16.4804 17.8946 16.2929 17.7071C16.1054 17.5196 16 17.2652 16 17Z"
                                fill="white" />
                        </svg>
                    </i>
                    <h1 class="mt-4 text-2xl font-extrabold">21</h1>
                    <p>Attendance/This Month</p>
                </div>

            </div>
        </div>

        <!-- Tables Section -->
        <div class="space-y-4" x-cloak>
            <!-- Present Table -->
            <div x-show="activeTable === 'present'" x-transition>

                    <div class="mb-8">
                        <h1 class="text-2xl font-bold text-gray-800">Today's Attendance</h1>
                    </div>

                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 ">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">1</td>
                                    <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                                    <td class="px-6 py-4 whitespace-nowrap">5th</td>
                                    <td class="px-6 py-4 whitespace-nowrap">A</td>
                                    <td class="px-6 py-4 whitespace-nowrap">2023-09-20</td>
                                    <td class="px-6 py-4 whitespace-nowrap w-32">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 whitespace-nowrap">
                                            Present
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

            </div>

            <!-- Absent Table -->
            <div x-show="activeTable === 'absent'" x-transition>
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Today's Absent</h1>
                </div>
                <div class="bg-white rounded-lg shadow overflow-hidden">

                    <table class="min-w-full divide-y divide-gray-200 ">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">1</td>
                                <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap">5th</td>
                                <td class="px-6 py-4 whitespace-nowrap">A</td>
                                <td class="px-6 py-4 whitespace-nowrap">2023-09-20</td>
                                <td class="px-6 py-4 whitespace-nowrap w-32">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 whitespace-nowrap">
                                        Present
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Monthly Table -->
            <div x-show="activeTable === 'monthly'" x-transition>
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Monthly Attendance</h1>
                </div>
                <div class="bg-white w-full rounded-lg shadow overflow-hidden">

                    <table class="min-w-full divide-y divide-gray-200 ">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Serial No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teacher Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Section</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">1</td>
                                <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                                <td class="px-6 py-4 whitespace-nowrap">5th</td>
                                <td class="px-6 py-4 whitespace-nowrap">OOPS</td>
                                <td class="px-6 py-4 whitespace-nowrap">A</td>
                                <td class="px-6 py-4 whitespace-nowrap">2023-09-20</td>
                                <td class="px-6 py-4 whitespace-nowrap">Present</td>
                                <td class="px-6 py-4 whitespace-nowrap w-32">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 whitespace-nowrap">
                                        Present
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </main>
</x-master-layout>
