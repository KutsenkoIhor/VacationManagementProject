<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery.js')}}"></script>
    <title>Vacation Management</title>
    <link rel="shortcut icon" href="{{"/image/vacation.svg"}}" type="image/svg">
</head>

<body>

<div class="min-h-full">

    {{--Push Notifications--}}
    <div class="push-notifications push-notifications push-notifications-block" id="push-notifications">
        <div class=" bg-gray-50 inline-block push-notifications-container shadow-xl  sm:p-4 rounded-lg">
            <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-green-200">
                <svg class="h-6 w-6 text-green-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="push-notifications-text"></h3>
            </div>
        </div>
    </div>

    <!-- mobile, show/hide -->
{{--    <div class="fixed inset-0 flex z-40 lg:hidden" role="dialog" aria-modal="true">--}}
{{--        <!----}}
{{--          Off-canvas menu overlay, show/hide based on off-canvas menu state.--}}

{{--          Entering: "transition-opacity ease-linear duration-300"--}}
{{--            From: "opacity-0"--}}
{{--            To: "opacity-100"--}}
{{--          Leaving: "transition-opacity ease-linear duration-300"--}}
{{--            From: "opacity-100"--}}
{{--            To: "opacity-0"--}}
{{--        -->--}}
{{--        <div class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>--}}

{{--        <!----}}
{{--          Off-canvas menu, show/hide based on off-canvas menu state.--}}

{{--          Entering: "transition ease-in-out duration-300 transform"--}}
{{--            From: "-translate-x-full"--}}
{{--            To: "translate-x-0"--}}
{{--          Leaving: "transition ease-in-out duration-300 transform"--}}
{{--            From: "translate-x-0"--}}
{{--            To: "-translate-x-full"--}}
{{--        -->--}}
{{--        <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-cyan-700">--}}
{{--            <!----}}
{{--              Close button, show/hide based on off-canvas menu state.--}}

{{--              Entering: "ease-in-out duration-300"--}}
{{--                From: "opacity-0"--}}
{{--                To: "opacity-100"--}}
{{--              Leaving: "ease-in-out duration-300"--}}
{{--                From: "opacity-100"--}}
{{--                To: "opacity-0"--}}
{{--            -->--}}
{{--            <div class="absolute top-0 right-0 -mr-12 pt-2">--}}
{{--                <button type="button"--}}
{{--                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">--}}
{{--                    <span class="sr-only">Close sidebar</span>--}}
{{--                    <!-- Heroicon name: outline/x -->--}}
{{--                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
{{--                         stroke="currentColor" aria-hidden="true">--}}
{{--                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}

{{--            <div class="flex-shrink-0 flex items-center px-4">--}}
{{--                <img class="h-8 w-auto"--}}
{{--                     src="https://tailwindui.com/img/logos/easywire-logo-cyan-300-mark-white-text.svg"--}}
{{--                     alt="Easywire logo">--}}
{{--            </div>--}}
{{--            <nav class="mt-5 flex-shrink-0 h-full divide-y divide-cyan-800 overflow-y-auto" aria-label="Sidebar">--}}
{{--                <div class="px-2 space-y-1">--}}
{{--                    <!-- Current: "bg-cyan-800 text-white", Default: "text-cyan-100 hover:text-white hover:bg-cyan-600" -->--}}
{{--                    <a href="#"--}}
{{--                       class="bg-cyan-800 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md"--}}
{{--                       aria-current="page">--}}
{{--                        <!-- Heroicon name: outline/home -->--}}
{{--                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>--}}
{{--                        </svg>--}}
{{--                        Home--}}
{{--                    </a>--}}

{{--                    <a href="#"--}}
{{--                       class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/clock -->--}}
{{--                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>--}}
{{--                        </svg>--}}
{{--                        History--}}
{{--                    </a>--}}

{{--                    <a href="#"--}}
{{--                       class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/scale -->--}}
{{--                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>--}}
{{--                        </svg>--}}
{{--                        Balances--}}
{{--                    </a>--}}

{{--                    <a href="#"--}}
{{--                       class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/credit-card -->--}}
{{--                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>--}}
{{--                        </svg>--}}
{{--                        Cards--}}
{{--                    </a>--}}

{{--                    <a href="#"--}}
{{--                       class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/user-group -->--}}
{{--                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>--}}
{{--                        </svg>--}}
{{--                        Recipients--}}
{{--                    </a>--}}

{{--                    <a href="#"--}}
{{--                       class="text-cyan-100 hover:text-white hover:bg-cyan-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">--}}
{{--                        <!-- Heroicon name: outline/document-report -->--}}
{{--                        <svg class="mr-4 flex-shrink-0 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg"--}}
{{--                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>--}}
{{--                        </svg>--}}
{{--                        Reports--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="mt-6 pt-6">--}}
{{--                    <div class="px-2 space-y-1">--}}
{{--                        <a href="#"--}}
{{--                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">--}}
{{--                            <!-- Heroicon name: outline/cog -->--}}
{{--                            <svg class="mr-4 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>--}}
{{--                            </svg>--}}
{{--                            Settings--}}
{{--                        </a>--}}

{{--                        <a href="#"--}}
{{--                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">--}}
{{--                            <!-- Heroicon name: outline/question-mark-circle -->--}}
{{--                            <svg class="mr-4 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>--}}
{{--                            </svg>--}}
{{--                            Help--}}
{{--                        </a>--}}

{{--                        <a href="#"--}}
{{--                           class="group flex items-center px-2 py-2 text-base font-medium rounded-md text-cyan-100 hover:text-white hover:bg-cyan-600">--}}
{{--                            <!-- Heroicon name: outline/shield-check -->--}}
{{--                            <svg class="mr-4 h-6 w-6 text-cyan-200" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>--}}
{{--                            </svg>--}}
{{--                            Privacy--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </nav>--}}
{{--        </div>--}}

{{--        <div class="flex-shrink-0 w-14" aria-hidden="true">--}}
{{--            <!-- Dummy element to force sidebar to shrink to fit close icon -->--}}
{{--        </div>--}}
{{--    </div>--}}

    <!-- Left menu -->

    {{--Sidebar--}}
    <div class="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
        <div class="flex flex-col flex-grow bg-gray-800 pt-5 pb-4 overflow-y-auto">
            <div class="flex items-center flex-shrink-0 px-4">
                <img class="h-8 w-auto" src="{{"/image/vacation.svg"}}" alt="Quantox logo">
                <div class="text-gray-100 items-center px-2 leading-6 font-medium pt-4 pl-4">
                    <h1>VACATION</h1>
                </div>

            </div>

            <nav class="mt-5 flex-1 flex flex-col divide-y divide-gray-700 overflow-y-auto" aria-label="Sidebar">
                <div class="px-2 space-y-1">

                    <a href="{{route('page.homePage')}}" id="sideBar_home"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_home_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Home
                    </a>

{{--                    @hasrole('Employee')--}}
{{--                    <a href="{{route('vacations.create.form')}}" id="sideBar_vacations"--}}
{{--                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">--}}
{{--                        <svg id="sideBar_vacations_svg" class="mr-4 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"--}}
{{--                                  d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>--}}
{{--                        </svg>--}}
{{--                        Vacation Request--}}
{{--                    </a>--}}
{{--                    @endhasrole--}}

                    <a href="{{ route('vacations.requestHistory') }}" id="sideBar_vacations_history"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_vacations_history_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        My Vacation Requests
                    </a>

                    @hasanyrole('PM|HR')
                    <a href="{{ route('vacations.requests') }}" id="sideBar_vacations_requests"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_vacations_requests_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Employees Vacation Requests
                    </a>
                    @endhasanyrole

                    @hasanyrole('PM|HR')
                    <a href="{{route('vacations.upcoming')}}" id="sideBar_vacations_overview"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_vacations_overview_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Vacation Overview
                    </a>
                    @endhasanyrole

                    <a href="{{route('page.listOfAllEmployees')}}" id="sideBar_list_of_all_employees"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_list_of_all_employees_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        List of all employees
                    </a>

                    <a href="{{route('page.listPm')}}" id="sideBar_PM_manage"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_PM_manage_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        PM management
                    </a>

                    <a href="{{route('page.listHr')}}" id="sideBar_HR_manage"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_HR_manage_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        HR management
                    </a>

                    @role('System Admin')
                    <a href="{{route('holidays.index')}}" id="sideBar_public_holiday"
                       class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_Public_holidays_svg" class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Public Holidays
                    </a>
                    @endrole


                    @if(auth()->user()->can('show countries') || auth()->user()->can('show cities'))

                        <a href="@if(auth()->user()->can('show countries')){{route('countries.index')}} @else {{route('cities.index')}} @endif" id="sideBar_settings_page"
                            class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                        <svg id="sideBar_settings_page_svg" class="svg-text-gray-400 group-hover:text-white mr-4 h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Settings
                        </a>

                    @elseif(auth()->user()->role('System Admin'))

                        <a href="{{route('roles.index')}}" id="sideBar_settings_page"
                           class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md">
                            <svg id="sideBar_settings_page_svg" class="svg-text-gray-400 group-hover:text-white mr-4 h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Settings
                        </a>

                    @endif

                </div>
                <div class="mt-6 pt-6">
                    <div class="px-2 space-y-1">
                        <a href="{{route('page.profile')}}" id="sideBar_profile"
                           class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-gray-100 hover:text-white hover:bg-gray-700">
                            <svg id="sideBar_profile_svg" class="svg-text-gray-400 group-hover:text-white mr-4 h-6 w-6 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Your Profile
                        </a>

                        <a href="{{route('logout')}}"
                           class="sidebar_button_bg text-gray-300 hover:text-white hover:bg-gray-700 group flex items-center px-2 py-2 text-sm leading-6 font-medium rounded-md text-gray-100 hover:text-white hover:bg-gray-700">
                            <svg class="mr-4 flex-shrink-0 h-6 w-6 svg-text-gray-400 group-hover:text-white" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Sign out
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- main menu -->
    <div class="lg:pl-64 flex flex-col flex-1">
        <main class="pb-8 pt-1">
            <div class="lg:px-3">
                @yield('nav')
                @yield('content')
            </div>
        </main>
    </div>


</div>
</body>

<script src="{{ asset('js/app.js') }}">
</script>
</html>
