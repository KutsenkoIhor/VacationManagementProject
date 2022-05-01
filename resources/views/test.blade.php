<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Vacation Management</title>
    <link rel="shortcut icon" href="{{"/image/vacation.svg"}}" type="image/svg">
</head>
<body>

<div class="min-h-full">
    <header class="pb-24 bg-gradient-to-r from-gray-900 via-gray-800 to-green-600">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="relative flex flex-wrap items-center justify-center lg:justify-between">
                <!-- Logo -->
                <div class="absolute left-0 py-5 flex-shrink-0 lg:static">
                    <a href="{{route('dashboard')}}">
                        <span class="sr-only">Workflow</span>
                            <img class="h-12 w-auto" src="{{"/image/logo_white.png"}}" alt="" >
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
                                <img class="h-8 w-8 rounded-full" src="{{$userParameters->getGoogleAvatar()}}" alt="">
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

                                <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="w-full py-8 lg:border-t lg:border-white lg:border-opacity-20">
                    <div class="lg:grid lg:grid-cols-3 lg:gap-8 lg:items-center">
                        <!-- Left nav -->
                        <div class="hidden lg:block lg:col-span-2">
                            <nav class="flex space-x-4">
                                <a href="{{route('dashboard')}}" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10" aria-current="page"> Home (1234)</a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Vacations history (1234) </a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Employee vacation list (23) </a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> List of all employees (234)</a>
                            </nav>
                        </div>
                    </div>
                    <div class="lg:grid lg:grid-cols-3 lg:gap-8 lg:items-center">
                        <div class="hidden lg:block lg:col-span-2">
                            <nav class="flex space-x-4">
                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Setting holy days (4)</a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> List of countries and cities (4)</a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Role default holidays (4)</a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Manage HR (4)</a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Manage PM (4)</a>

                                <a href="#" class="text-white text-sm font-medium rounded-md bg-white bg-opacity-0 px-3 py-2 hover:bg-opacity-10"> Manage domains (4)</a>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Menu button -->
                <div class="absolute right-0 flex-shrink-0 lg:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="bg-transparent p-2 rounded-md inline-flex items-center justify-center text-cyan-200 hover:text-white hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-white" aria-expanded="false" id="mobile_user_menu_button">
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




{{--        <div class="pop_up" id = "pop_up_menu">--}}

        <!-- Mobile menu, show/hide based on mobile menu state. -->
        <div class="mobile_menu_pop_up" id = "mobile_pop_up_menu">
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
                <div class="z-30 absolute top-0 inset-x-0 max-w-3xl mx-auto w-full p-2 transition transform origin-top" >
                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y divide-gray-200">
                        <div class="pt-3 pb-2">
                            <div class="flex items-center justify-between px-4">
                                <div>
                                    <img class="h-10 w-auto" src="{{"/image/logo.png"}}" alt="Workflow">
                                </div>
                                <div class="-mr-2">
                                    <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500" id = "mobile_user_close_menu_button">
                                        <span class="sr-only">Close menu</span>
                                        <!-- Heroicon name: outline/x -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mt-3 px-2 space-y-1">
                                <a href="{{route('dashboard')}}" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Home</a>

                                <a href="#" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Vacations history</a>
                            </div>
                        </div>
                        <div class="pt-4 pb-2">

                            <div class="flex items-center px-5">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{$userParameters->getGoogleAvatar()}}" alt="">
                                </div>
                                <div class="ml-3 min-w-0 flex-1">
                                    <div class="text-base font-medium text-gray-800 truncate">{{$userParameters->getFirstName() . " " . $userParameters->getLastName()}}</div>
                                    <div class="text-sm font-medium text-gray-500 truncate">{{$userParameters->getEmail()}}</div>
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

                                <a href="{{route('logout')}}" class="block rounded-md px-3 py-2 text-base text-gray-900 font-medium hover:bg-gray-100 hover:text-gray-800">Sign out</a>
                            </div>
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
            <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-2 lg:gap-8">
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
                                            <img class="mx-auto h-20 w-20 rounded-full" src="{{$userParameters->getGoogleAvatar()}}" alt="">
                                        </div>
                                        <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                            <p class="text-sm font-medium text-gray-600">Welcome back,</p>
                                            <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{$userParameters->getFirstName() . " " . $userParameters->getLastName()}} </p>
                                            <p class="text-sm font-medium text-gray-600">{{$userParameters->getEmail()}}</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 flex justify-center sm:mt-0">
                                        <a href="{{route('createVacation')}}" class="flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Holiday request </a>
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
