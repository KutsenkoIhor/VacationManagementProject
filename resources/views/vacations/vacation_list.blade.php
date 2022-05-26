@extends('templates.mainPageTemplate')

@section('content')

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <p class="mt-2 text-lg text-gray-800">A list of all your vacations</p>

            <div class="mt-3 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-center text-xs font-medium uppercase text-gray-700">
                                        Start date
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-center text-xs font-medium uppercase text-gray-700">
                                        End date
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Number Of Days
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Created At
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Is_approved
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($vacations as $vacation)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-center text-gray-600 sm:pl-6">{{ $vacation->getStartDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getEndDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getType() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getNumberOfDays() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getCreatedAt() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">
                                    <span
                                        class="inline-flex rounded-full bg-indigo-100 px-2 text-xs font-semibold leading-5 text-indigo-800">{{ $vacation->isApproved() }}
                                    </span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
