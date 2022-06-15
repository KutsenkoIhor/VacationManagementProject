@extends('templates.mainPageTemplate')

@section('content')

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <p class="mt-2 text-lg text-gray-800">Employees vacation requests.</p>

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
                                        Is_approved
                                    </th>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Status
                                    </th>
                                    @hasrole('HR')
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Edit
                                    </th>
                                    @endhasrole

                                    @hasanyrole('HR')
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-4 text-center text-xs font-medium uppercase text-gray-700 sm:pr-6">
                                        Cancel
                                    </th>
                                    @endhasanyrole
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach($vacationRequests as $vacationRequest)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-center text-gray-900 sm:pl-6">{{ $vacationRequest->getUser()->getFirstName()  }} {{ $vacationRequest->getUser()->getLastName() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ str_replace("_", " ", ucfirst(strtolower($vacationRequest->getType()))) }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacationRequest->getStartDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacationRequest->getEndDate()->format('Y-m-d') }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">{{ $vacationRequest->getNumberOfDays() }}</td>
                                        <td class="whitespace-nowrap p-4 text-sm text-center text-gray-600">
                                            <span
                                                class="inline-flex rounded-full bg-indigo-100 px-2 text-xs font-semibold leading-5 text-indigo-800">{{ $vacationRequest->isApproved() }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-center text-sm text-gray-600 sm:pr-6">
                                            <form method="POST">
                                                <button id="changeStatusButton" type="button" vacation-request-id="{{$vacationRequest->getId()}}"
                                                        class="changeStatusButton inline-flex rounded-full bg-green-100 px-2 text-sm leading-5 text-green-900"
                                                        value="1">Approve
                                                </button>
                                                <button id="changeStatusButton" type="button" vacation-request-id="{{$vacationRequest->getId()}}"
                                                        class="changeStatusButton inline-flex rounded-full bg-red-100 px-2 text-sm leading-5 text-red-900"
                                                        value="0">Deny
                                                </button>
                                            </form>
                                        </td>
                                        @hasrole('HR')
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-center text-sm text-gray-600 sm:pr-6">
                                            <form method="POST">
                                                <button id="button-editVacationRequest-{{$vacationRequest->getId()}}"
                                                        type="button" value="{{$vacationRequest->getId()}}"
                                                        class="button-vacationRequest-edit inline-flex rounded-full bg-indigo-100 px-2 text-sm leading-5 text-indigo-800">
                                                    Edit
                                                </button>
                                            </form>
                                        </td>
                                        @endhasrole
                                        @hasanyrole('HR')
                                        <td class="whitespace-nowrap py-4 pl-4 pr-4 text-center text-sm text-gray-600 sm:pr-6">
                                            <form method="POST">
                                                <button type="button"
                                                        vacation-request-id="{{$vacationRequest->getId()}}"
                                                        class="cancelButton inline-flex rounded-full bg-red-100 px-2 text-sm leading-5 text-red-900">
                                                    Cancel
                                                </button>
                                            </form>
                                        </td>
                                        @endhasanyrole
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="edit_vacation_request_modal" class="pop_up pop_up_employee">
            <div class="pop_up_container">
                <div class="pop_up_body_body">
                    <div class="px-4 sm:px-6 lg:px-8  mb-8 ">
                        <div class="mt-8 flex flex-col">
                            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <div class="p-6">
                                                <form class="space-y-8 divide-y divide-gray-200">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Edit vacation request</h3>
                                                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                                        <input type="hidden" id="vacation_request_id">

                                                        <div class="col-start-1 col-end-7">
                                                            <label id="user_email" for="user_email" class="block text-sm font-medium text-gray-700">Email</label>
                                                            <div class="mt-1">
                                                                <input id="user_email" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            </div>
                                                        </div>

                                                        <div class="sm:col-span-2">
                                                            <label for="edit_start_date" class="block text-sm font-medium text-gray-700">Start date</label>
                                                            <div class="mt-1">
                                                                <input id="edit_start_date" type="date" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            </div>
                                                        </div>

                                                        <div class="sm:col-span-2">
                                                            <label for="edit_end_date" class="block text-sm font-medium text-gray-700">End date</label>
                                                            <div class="mt-1">
                                                            <input id="edit_end_date" type="date" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="sm:col-span-2">
                                                        <label for="edit_type" class="block text-sm font-medium text-gray-700">Type</label>
                                                        <select id="edit_type" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            <option>VACATIONS</option>
                                                            <option>SICK_DAYS</option>
                                                            <option>PERSONAL_DAYS</option>
                                                        </select>
                                                    </div>

                                                    <div class="pt-5">
                                                        <div class="flex justify-end">
                                                            <button
                                                                id="close-modal-window-edit-vacation-request" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel
                                                            </button>
                                                            <button
                                                                id="button-updateVacationRequest" type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Update
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </table>
                                    </div>
                                </div>
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
        <script>

            $(document).ready(function () {
                $(".changeStatusButton").click(function () {
                    const data = {};
                    const vacation_request_id = $(this).attr("vacation-request-id");
                    data.is_approved = $(this).val();
                    $.ajax({
                        url: '/api/vacationRequests/' + vacation_request_id + '/createVacationRequestApproval',
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
