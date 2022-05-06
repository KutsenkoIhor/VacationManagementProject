@extends('templates.mainPageTemplate')

@section('custom_styles')
    <link rel="stylesheet" href="{{asset('https://unpkg.com/flowbite@1.4.2/dist/flowbite.min.css')}}"/>
@endsection

@section('content')

    <form action="/vacations/upcoming" method="GET">
        <div class="mt-2 flex space-x-4 px-3 py-2 bg-white">
            <div class="grid grid-cols-5 gap-4">

                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                           value="{{$startDate}}"
                           name="start_date" id="start_date"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Start date">
                </div>

                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                           value="{{$endDate}}"
                           name="end_date" id="end_date"
                           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="End date">
                </div>
                <button type="submit"
                        class="items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-800 bg-indigo-100 hover:bg-indigo-200 focus:outline focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 text-center">
                    Apply filter
                </button>
            </div>
        </div>
    </form>

    <div class="mt-5 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="table-auto border-collapse min-w-full divide-y divide-gray-300 ">

                        <thead class="bg-gray-50">
                        <tr class="divide-x">
                            <th scope="col" class="px-0 py-0 text-center text-sm font-semibold text-gray-900 h-32">
                                Employee
                            </th>
                            @foreach($columns as $column)
                                <th scope="col"
                                    class="px-0 py-0 text-center text-sm font-semibold w-10 h-32 text-gray-900 h-32 text-xs">
                                    <div class="whitespace-nowrap -rotate-90">{{ $column }}</div>
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 bg-white">
                        @foreach($userDates as $userId => $dates)
                            <tr class="divide-x divide-y text-center">
                                <td class="whitespace-nowrap p-4 text-sm text-black-500 divide-x divide-y">{{ $users[$userId]->getFirstName()  }} {{ $users[$userId]->getLastName() }}</td>

                                @foreach($columns as $column)
                                    @if (array_key_exists($column, $dates))
                                        <td class="whitespace-nowrap p-4 text-sm text-black-500 {{$typeMappingStyles[$dates[$column]]}} border-gray-300 ">{{ $typeMapping[$dates[$column]] }}</td>
                                    @else
                                        <td class="whitespace-nowrap p-4 text-sm text-black-500"></td>
                                    @endif
                                @endforeach

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
            </div>
            </div>
        </div>
    </div>

@endsection
