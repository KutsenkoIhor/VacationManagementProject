@extends('templates.mainPageTemplate')

@section('content')

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <p class="mt-2 text-lg text-gray-800">Vacation requests, that are waiting for your approval</p>

            <div class="mt-3 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-300">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pl-6">
                                        Employee
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-center text-xs font-medium uppercase text-gray-700">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="px-4 py-3.5 text-center text-xs font-medium uppercase text-gray-700">
                                        Start date
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        End date
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Number Of Days
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Status
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($vacations as $vacation)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-center text-gray-900 sm:pl-6">{{ $vacation->getUser()->getFirstName()  }} {{ $vacation->getUser()->getLastName() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getType() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getStartDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getEndDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacation->getNumberOfDays() }}</td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-center text-sm text-gray-600 sm:pr-6">
                                            <form method="POST">
                                                <button type="button" vacation-id="{{$vacation->getId()}}"
                                                        class="changeStatusButton inline-flex rounded-full bg-green-100 px-2 text-sm leading-5 text-green-900"
                                                        value="APPROVED">Approve
                                                </button>
                                                <button type="button" vacation-id="{{$vacation->getId()}}"
                                                        class="changeStatusButton inline-flex rounded-full bg-red-100 px-2 text-sm leading-5 text-red-900"
                                                        value="DENIED">Deny
                                                </button>
                                            </form>
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

        <script>
            $(document).ready(function () {
                $(".changeStatusButton").click(function () {
                    const data = {};
                    const vacation_id = $(this).attr("vacation-id");
                    data.status = $(this).val();
                    $.ajax({
                        url: '/api/vacations/' + vacation_id + '/createVacationApproval',
                        type: 'POST',
                        data: data,
                        success: function () {
                            alert('Successfully changed!');
                            window.location.reload();
                        },
                        error: function () {
                            alert('Error');
                        }
                    });
                });
            });
        </script>

@endsection
