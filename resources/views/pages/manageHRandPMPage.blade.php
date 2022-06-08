@extends('templates.mainPageTemplate')

@section('content')

    {{--bloc button manga PM and HR--}}
    <div class="px-4 sm:px-6 lg:px-8 mt-3 grid grid-cols-1 gap-4 items-start lg:grid-cols-2 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">
            <section aria-labelledby="profile-overview-title">
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="border-t border-gray-200 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">

                        <div id="button-Manage-PM" class="bg-bloc-gray-200 hover:bg-gray-50 px-6 py-5 text-sm font-medium text-center">
                            <span class="text-gray-600">Manage PM</span>
                        </div>

                        <div id="button-Manage-HR" class="bg-bloc-gray-200 hover:bg-gray-50 px-6 py-5 text-sm font-medium text-center">
                            <span class="text-gray-600">Manage HR</span>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

    {{--bloc manag PM--}}
    <div id="bloc-manage-PM" class="show_block px-4 sm:px-6 lg:px-8 mt-3 grid grid-cols-1 gap-4 items-start lg:grid-cols-2 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">
            <section aria-labelledby="profile-overview-title">
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="border-t border-gray-200 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">

                        <div>
                            <div class="relative">
                                <!-- Heroicon name: solid/search -->
                                <svg class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                                <input type="text" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options">
                            </div>




                            <div class="px-4 sm:px-6 lg:px-8">
                                <div class="mt-8 flex flex-col">
                                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <table class="min-w-full divide-y divide-gray-300">

                                            <tr>
                                                <td class=" py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0">
                                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="font-medium text-gray-900">Lindsay Walton</div>
                                                            <div class="text-gray-500">lindsay.walton@example.com</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex -space-x-1 relative z-0 overflow-hidden">
                                                        <img class="relative z-30 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        <img class="relative z-20 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        <span class="pl-4 text-xs leading-6 text-gray-600">+8</span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <div class="grid-cols-1 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">
{{--                                                    <div>--}}
{{--                                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">--}}
                                                            <div class="flex items-center">
                                                                <div class="h-10 w-10 flex-shrink-0">
                                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                                </div>
                                                                <div class="ml-4">
                                                                    <div class="font-medium text-gray-900">Lindsay Walton</div>
                                                                    <div class="text-gray-500">lindsay.walton@example.com</div>
                                                                </div>
                                                            </div>
{{--                                                        </td>--}}
{{--                                                    </div>--}}
{{--                                                    <div>--}}
{{--                                                        <td>--}}
                                                            <div class="flex -space-x-1 relative z-0 overflow-hidden">
                                                                <img class="relative z-30 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                                <img class="relative z-20 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                                <img class="relative z-10 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" alt="">
                                                                <img class="relative z-0  inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                                <span class="pl-4 text-xs leading-6 text-gray-600">+5</span>
                                                            </div>
{{--                                                        </td>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </tr>

                                            <tr>
                                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                                    <div class="flex items-center">
                                                        <div class="h-10 w-10 flex-shrink-0">
                                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="font-medium text-gray-900">Lindsay Walton</div>
                                                            <div class="text-gray-500">lindsay.walton@example.com</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex -space-x-1 relative z-0 overflow-hidden">
                                                        <img class="relative z-30 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        <img class="relative z-20 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        <img class="relative z-10 inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" alt="">
                                                        <img class="relative z-0  inline-block h-6 w-6 rounded-full ring-2 ring-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                                                        <span class="pl-4 text-xs leading-6 text-gray-600">+5</span>
                                                    </div>
                                                </td>
                                            </tr>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            result
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

    {{--bloc manag HR--}}
    <div id="bloc-manage-HR" class="show_block px-4 sm:px-6 lg:px-8 mt-3 grid grid-cols-1 gap-4 items-start lg:grid-cols-2 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">
            <section aria-labelledby="profile-overview-title">
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <div class="border-t border-gray-200 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-2 sm:divide-y-0 sm:divide-x">

                        <div>
                            search Manage HR
                        </div>

                        <div>
                            result
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>


    {{--    <pre>--}}
{{--        USER:--}}
{{--            System Administrator--}}
{{--        TASK:--}}
{{--            Entities that the system admin manages are:--}}
{{--            4. Assign HRs to a country / city (so every vacation request from people from that country / city will be visible to them)--}}
{{--            5. Assign PMs to employees (so every vacation request from people on their projects is visible to them to approve)--}}
{{--                1. An employee can have multiple PMs--}}
{{--    </pre>--}}
@endsection
