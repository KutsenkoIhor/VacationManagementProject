<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="min-h-full">
    <header class="pb-24 bg-gradient-to-r from-sky-800 to-cyan-600">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="relative flex flex-wrap items-center justify-center lg:justify-between">
                <!-- Logo -->
                <div class="absolute left-0 py-5 flex-shrink-0 lg:static">
                    <a href="#">
                        <span class="sr-only">Workflow</span>
                        <!-- https://tailwindui.com/img/logos/workflow-mark-cyan-200.svg -->
                        <svg class="h-8 w-auto" fill="none" viewBox="0 0 35 32" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#A5F3FC" d="M15.258 26.865a4.043 4.043 0 01-1.133 2.917A4.006 4.006 0 0111.253 31a3.992 3.992 0 01-2.872-1.218 4.028 4.028 0 01-1.133-2.917c.009-.698.2-1.382.557-1.981.356-.6.863-1.094 1.47-1.433-.024.109.09-.055 0 0l1.86-1.652a8.495 8.495 0 002.304-5.793c0-2.926-1.711-5.901-4.17-7.457.094.055-.036-.094 0 0A3.952 3.952 0 017.8 7.116a3.975 3.975 0 01-.557-1.98 4.042 4.042 0 011.133-2.918A4.006 4.006 0 0111.247 1a3.99 3.99 0 012.872 1.218 4.025 4.025 0 011.133 2.917 8.521 8.521 0 002.347 5.832l.817.8c.326.285.668.551 1.024.798.621.33 1.142.826 1.504 1.431a3.902 3.902 0 01-1.504 5.442c.033-.067-.063.036 0 0a8.968 8.968 0 00-3.024 3.183 9.016 9.016 0 00-1.158 4.244zM19.741 5.123c0 .796.235 1.575.676 2.237a4.01 4.01 0 001.798 1.482 3.99 3.99 0 004.366-.873 4.042 4.042 0 00.869-4.386 4.02 4.02 0 00-1.476-1.806 3.994 3.994 0 00-5.058.501 4.038 4.038 0 00-1.175 2.845zM23.748 22.84c-.792 0-1.567.236-2.226.678a4.021 4.021 0 00-1.476 1.806 4.042 4.042 0 00.869 4.387 3.99 3.99 0 004.366.873A4.01 4.01 0 0027.08 29.1a4.039 4.039 0 00-.5-5.082 4 4 0 00-2.832-1.18zM34 15.994c0-.796-.235-1.574-.675-2.236a4.01 4.01 0 00-1.798-1.483 3.99 3.99 0 00-4.367.873 4.042 4.042 0 00-.869 4.387 4.02 4.02 0 001.476 1.806 3.993 3.993 0 002.226.678 4.003 4.003 0 002.832-1.18A4.04 4.04 0 0034 15.993z M5.007 11.969c-.793 0-1.567.236-2.226.678a4.021 4.021 0 00-1.476 1.807 4.042 4.042 0 00.869 4.386 4.001 4.001 0 004.366.873 4.011 4.011 0 001.798-1.483 4.038 4.038 0 00-.5-5.08 4.004 4.004 0 00-2.831-1.181z" />
                        </svg>
                    </a>
                </div>

                <!-- Right section on desktop -->
                <div class="hidden lg:ml-4 lg:flex lg:items-center lg:py-5 lg:pr-0.5">
                    <button type="button" class="flex-shrink-0 p-1 text-cyan-200 rounded-full hover:text-white hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-4 relative flex-shrink-0">
                        <div>
                            <button type="button" class="bg-white rounded-full flex text-sm ring-2 ring-white ring-opacity-20 focus:outline-none focus:ring-opacity-100" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>

                        <!--
                          Dropdown menu, show/hide based on menu state.

                          Entering: ""
                            From: ""
                            To: ""
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
                        <div class="pop_up" id = "pop_up_menu">
                            <div class="origin-top-right z-40 absolute -right-2 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>

                                <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="w-full py-5 lg:border-t lg:border-white lg:border-opacity-20">
                    <div class="lg:grid lg:grid-cols-3 lg:gap-8 lg:items-center">
                        <!-- Left nav -->
                        <div class="hidden lg:block lg:col-span-2">
                            <nav class="flex space-x-4">
                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10" aria-current="page"> Home </a>

                                <a href="#" class="text-cyan-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Profile </a>

                                <a href="#" class="text-cyan-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Resources </a>

                                <a href="#" class="text-cyan-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Company Directory </a>

                                <a href="#" class="text-cyan-100 text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Openings </a>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Menu button -->
                <div class="absolute right-0 flex-shrink-0 lg:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="bg-transparent p-2 rounded-md inline-flex items-center justify-center text-cyan-200 hover:text-white hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!--
                          Heroicon name: outline/menu

                          Menu open: "hidden", Menu closed: "block"
                        -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!--
                          Heroicon name: outline/x

                          Menu open: "block", Menu closed: "hidden"
                        -->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on mobile menu state. -->
        <div class="lg:hidden">
            <!--
              Mobile menu overlay, show/hide based on mobile menu state.

              Entering: "duration-150 ease-out"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "duration-150 ease-in"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="z-20 fixed inset-0 bg-black bg-opacity-25" aria-hidden="true"></div>

            <!--
              Mobile menu, show/hide based on mobile menu state.

              Entering: "duration-150 ease-out"
                From: "opacity-0 scale-95"
                To: "opacity-100 scale-100"
              Leaving: "duration-150 ease-in"
                From: "opacity-100 scale-100"
                To: "opacity-0 scale-95"
            -->
            <div class="z-30 absolute top-0 inset-x-0 max-w-3xl mx-auto w-full p-2 transition transform origin-top">
                <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y divide-gray-200">
                    <div class="pt-3 pb-2">
                        <div class="flex items-center justify-between px-4">
                            <div>
                                <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-cyan-600.svg" alt="Workflow">
                            </div>
                            <div class="-mr-2">
                                <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500">
                                    <span class="sr-only">Close menu</span>
                                    <!-- Heroicon name: outline/x -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Home</a>

                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Profile</a>

                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Resources</a>

                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Company Directory</a>

                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Openings</a>
                        </div>
                    </div>
                    <div class="pt-4 pb-2">

                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </div>
                            <div class="ml-3 min-w-0 flex-1">
                                <div class="text-base font-medium text-gray-800 truncate">Chelsea Hagon</div>
                                <div class="text-sm font-medium text-gray-500 truncate">chelsea.hagon@example.com</div>
                            </div>
                            <button type="button" class="ml-auto flex-shrink-0 bg-white p-1 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Your Profile</a>

                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Settings</a>

                            <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="-mt-24 pb-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="sr-only">Profile</h1>
            <!-- Main 3 column grid -->
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-3 lg:gap-8">
                <!-- Left column -->
                <div class="grid grid-cols-1 gap-4 lg:col-span-2">
                    <!-- Welcome panel -->
                    <section aria-labelledby="profile-overview-title">
                        <div class="rounded-lg bg-white overflow-hidden shadow">
                            <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                            <div class="bg-white p-6">
                                <div class="sm:flex sm:items-center sm:justify-between">
                                    <div class="sm:flex sm:space-x-5">
                                        <div class="flex-shrink-0">
                                            <img class="mx-auto h-20 w-20 rounded-full" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                        </div>
                                        <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                            <p class="text-sm font-medium text-gray-600">Welcome back,</p>
                                            <p class="text-xl font-bold text-gray-900 sm:text-2xl">Chelsea Hagon</p>
                                            <p class="text-sm font-medium text-gray-600">Human Resources Manager</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 flex justify-center sm:mt-0">
                                        <a href="#" class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> View profile </a>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                                <div class="px-6 py-5 text-sm font-medium text-center">
                                    <span class="text-gray-900">12</span>
                                    <span class="text-gray-600">Vacation days left</span>
                                </div>

                                <div class="px-6 py-5 text-sm font-medium text-center">
                                    <span class="text-gray-900">4</span>
                                    <span class="text-gray-600">Sick days left</span>
                                </div>

                                <div class="px-6 py-5 text-sm font-medium text-center">
                                    <span class="text-gray-900">2</span>
                                    <span class="text-gray-600">Personal days left</span>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 lg:max-w-7xl">
            <div class="border-t border-gray-200 py-8 text-sm text-gray-500 text-center sm:text-left"><span class="block sm:inline">&copy; 2021 Tailwind Labs Inc.</span> <span class="block sm:inline">All rights reserved.</span></div>
        </div>
    </footer>
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
