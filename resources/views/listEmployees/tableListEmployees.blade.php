<div class="mt-8 flex flex-col">
    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table id="tableUsers" class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Email</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Country</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">City</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Vacation days</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sick days</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Personal days</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Edit</span>
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Delete</span>
                        </th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Delete</span>
                        </th>
                    </tr>
                    </thead>

                    @foreach ($arrData["user parameters"] as $userInformation)
                        <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{$userInformation['email']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['name']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['roles']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['country']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['city']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['vacation days left']}}/{{$userInformation['vacation days per year']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['personal days left']}}/{{$userInformation['personal days per year']}}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{$userInformation['sick days left']}}/{{$userInformation['sick days per year']}}</td>

                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"></td>

                            <td class="relative whitespace-nowrap py-4 pl-3 text-right text-sm font-medium ">
                                        <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                          <button type="button" id="button-historyVacations-{{$userInformation['userId']}}" value="{{$userInformation['userId']}}" class="button-historyVacations-user mr-4  relative inline-flex items-center px-4 py-2 rounded-l-md rounded-r-md border text-gray-700 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">History Vacations</button>
                                          <button type="button" id="button-edit-{{$userInformation['userId']}}" value="{{$userInformation['userId']}}" class="button-edit-user -ml-px relative inline-flex items-center px-4 py-2 rounded-l-md border text-gray-700 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">Edit</button>
                                          <button type="button" id="button-delete-{{$userInformation['userId']}}" value="{{$userInformation['userId']}}" class="button-delete-user -ml-px relative inline-flex items-center px-4 py-2 rounded-r-md -mr-4 border text-gray-700 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">Delete</button>
                                        </span>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach

                </table>

                <table id="tableUserss" class="min-w-full divide-y divide-gray-300">
                </table>
            </div>
        </div>
    </div>
</div>
