@extends('templates.mainPageTemplate')

@section('content')

    {{--bloc manag PM--}}
    <div id="bloc-manage-PM" class="show_block">

        {{--search--}}
        <div class="relative pt-10">
            <div class="box-elasticsearchUser" id="box-elasticsearchListUser">
                <div class="absolute absolute-center w-72 sm:w-1/2 xl:w-1/2 transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                    <div class="relative">
                        <svg class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        <label>
                            <input id="elasticsearchListUser" type="text" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options">
                        </label>
                    </div>
                    <ul class="elasticsearchOptionsListUser show_block max-h-32 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800" id="elasticsearchOptionsList" role="listbox">
{{--                        <li class="cursor-default select-none px-4 py-2" id="option-1" role="option" tabindex="-1">Leslie Alexander</li>--}}
{{--                        <li class="cursor-default select-none px-4 py-2" id="option-2" role="option" tabindex="-1">Michael Foster</li>--}}
{{--                        <li class="cursor-default select-none px-4 py-2" id="option-3" role="option" tabindex="-1">Dries Vincent</li>--}}
                    </ul>
                    <p class="show_block p-4 text-sm text-gray-500" id="elasticsearchNotFound">No people found.</p>
                </div>
            </div>
        </div>

        <div class="pt-4 px-4 mt-3 px-8 mt-40 md:mt-24">
            <div class="px-4 sm:px-6 lg:px-8">

                {{--description--}}
                <div class="pt-10 flex">
                    <div class="flex-none">
                        <h1 class="text-xl font-semibold text-gray-900">List of all PM</h1>
                    </div>
                    <div class="grow">
                    </div>
                    <div class="flex-none">
                        <button id="button-clear-search" type="button" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">clear search<span class="sr-only">, Hobby</span></button>
                    </div>
                </div>

                {{--table--}}
                <div id="table-PM" class="mt-8 grid grid-cols-1 gap-4 xl:grid-cols-2">
                </div>

                {{--pagination--}}
                <div class="pt-2">
                    <nav class="mx-7 px-4 flex items-center justify-between sm:px-0">
                        <div class=" -mt-px w-0 flex-1 flex">
                            <a href="" id="first-page-table-user" class="hidden sm:block pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                First
                            </a>
                        </div>
                        <div class="-mt-px flex">
                            <a href="" id="previous-page-table-user" class=" pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Previous
                            </a>
                            <p id="text-number-page" class="text-gray-700 hover:border-gray-300 pt-4 px-4 inline-flex items-center text-sm font-medium">1 / 22</p>
                            <a href="" id="next-page-table-user" class=" pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Next
                                <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>

                        </div>
                        <div class="-mt-px w-0 flex-1 flex justify-end ">
                            <a href="" id="last-page-table-user" class="hidden sm:block pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                                Last
                                <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </nav>
                </div>

            </div>
        </div>
    </div>



    {{--bloc team PM--}}
    <div id="bloc-team-PM" class="show_block px-8 mx-8">

        {{--PM--}}
        <div id="bloc-pm-information" class="mt-14 flex-none text-center">
{{--            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="mx-auto h-16 w-16 rounded-full">--}}
{{--            <h2 class="mt-3 font-semibold text-gray-900">Tom Cook</h2>--}}
{{--            <p class="text-sm leading-6 text-gray-500">Director, Product Development</p>--}}
        </div>

        {{--description--}}
        <div class="pt-10 flex">
            <div class="flex-none">
                <h1 class="hidden sm:block text-xl font-semibold text-gray-900">Team</h1>
            </div>
            <div class="grow">
            </div>
            <div class="flex-initial ">
                <div>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <div class="relative flex items-stretch flex-grow focus-within:z-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <label for="email"></label>
                            <label for="email-employee-in-team"></label>
                            <input type="email" name="email" id="email-employee-in-team" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full rounded-none rounded-l-md pl-10 sm:text-sm border-gray-300" placeholder="you@example.com">
                        </div>
                        <button id="add-employee-in-team" type="button" class="-ml-px relative inline-flex items-center space-x-2 px-4 py-2 border border-gray-300 text-sm font-medium rounded-r-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                            <span>Add user</span>
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-red-600 show_error" id="add-employee-in-team-email-error">eroor</p>
                </div>
            </div>
        </div>

        {{--table--}}
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                                <th scope="col" class="hidden sm:block px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Country</th>
                                <th scope="col" class="md:hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>

                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody id="bloc-team-information" class="divide-y divide-gray-200 bg-white">

{{--                                    <tr>--}}
{{--                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">--}}
{{--                                            <div class="flex items-center">--}}
{{--                                                <div class="hidden sm:block h-10 w-10 flex-shrink-0">--}}
{{--                                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">--}}
{{--                                                </div>--}}
{{--                                                <div class="ml-4">--}}
{{--                                                    <div class="font-medium text-gray-900">Lindsay Walton</div>--}}
{{--                                                    <div class="text-gray-500">lindsay.walton@example.com</div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td class="hidden sm:block whitespace-nowrap px-3 py-7 text-sm text-gray-500">country</td>--}}

{{--                                        <td class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium">--}}
{{--                                            <button type="button" id="button-select-PM" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Delete<span class="sr-only">, Hobby</span></button>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

