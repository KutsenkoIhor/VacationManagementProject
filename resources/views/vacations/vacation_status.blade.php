@extends('templates.mainPageTemplate')

@section('content')

    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Vacation Status</h1>
                <p class="mt-2 text-sm text-gray-700">A list of all vacation requests for PMs to approve or deny.</p>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                    User
                                </th>
                                <th scope="col"
                                    class="py-3 pl-4 pr-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-6">
                                    Start date
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    End date
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Type
                                </th>
                                <th scope="col"
                                    class="px-3 py-3 text-left text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Status
                                </th>
                                <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-6">
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($vacations as $vacation)
                                <tr>
                                    <td class="whitespace-nowrap p-4 text-sm text-black-500 divide-x divide-y">{{ $vacation->getUser()->getFirstName()  }} {{ $vacation->getUser()->getLastName() }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $vacation->getStartDate()->format('Y-m-d') }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $vacation->getEndDate()->format('Y-m-d') }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $vacation->getType() }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <form method="POST">
                                            <button type="button" vacation-id="{{$vacation->getId()}}"
                                                    class="changeStatusButton inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800"
                                                    value="APPROVED">APPROVE
                                            </button>
                                            <button type="button" vacation-id="{{$vacation->getId()}}"
                                                    class="changeStatusButton inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800"
                                                    value="DENIED">DENY
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
                    url: 'http://127.0.0.1:80/api/vacations/' + vacation_id + '/changeStatus',
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
