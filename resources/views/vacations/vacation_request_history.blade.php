@extends('templates.mainPageTemplate')

@section('content')
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <div class="flex justify-between">
                <p class="text-lg text-gray-800">A list of all your vacation requests.</p>
                <a class="flex justify-end px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Create vacation request</a>
            </div>
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

                                    @hasrole('Employee')
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Cancel
                                    </th>
                                    @endhasrole
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($vacationRequests as $vacationRequest)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-center text-gray-600 sm:pl-6">{{ $vacationRequest->getStartDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacationRequest->getEndDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ str_replace("_", " ", ucfirst(strtolower($vacationRequest->getType()))) }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacationRequest->getNumberOfDays() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacationRequest->getCreatedAt() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">
                                            <span
                                                class="inline-flex rounded-full bg-indigo-100 px-2 text-xs font-semibold leading-5 text-indigo-800">{{ $vacationRequest->isApproved() }}
                                            </span>
                                        </td>

                                        @hasrole('Employee')
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-center text-sm text-gray-600 sm:pr-6">
                                            <form method="POST">
                                                <button type="button" vacation-request-id="{{$vacationRequest->getId()}}"
                                                        class="cancelButton inline-flex rounded-full bg-red-100 px-2 text-sm leading-5 text-red-900">Cancel
                                                </button>
                                            </form>
                                        </td>
                                        @endhasrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(".cancelButton").click(function () {
                const cancelConfirm = confirm("Are you sure?");
                if (cancelConfirm) {
                    const data = {};
                    const vacation_request_id = $(this).attr("vacation-request-id");
                    $.ajax({
                        url: '/api/vacationRequests/' + vacation_request_id + '/cancelVacationRequest',
                        type: 'POST',
                        data: data,
                        success: function () {
                            alert('Successfully cancelled!');
                            window.location.reload();
                        },
                        error: function () {
                            alert('Error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
