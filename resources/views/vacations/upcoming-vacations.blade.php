@extends('templates.mainPageTemplate')

@section('content')

    <form action="/vacations/upcoming" method="GET">
        <div class="mt-2 flex flex-nowrap space-x-4 px-0.5 py-2 bg-white">
            <div class="grid grid-cols-5 gap-4">
                <div class="sm:col-span-2 inline-block relative w-72">
                    <div class="-mt-2">
                        <input type="date" name="start_date" id="start_date" value="{{$startDate->format('Y-m-d')}}" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="sm:col-span-2 inline-block relative w-72">
                    <div class="-mt-2">
                        <input type="date" name="end_date" id="end_date" value="{{$endDate->format('Y-m-d')}}" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="-mt-2">
                <button type="submit" class="rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm">
                    Apply filter
                </button>
                </div>
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
