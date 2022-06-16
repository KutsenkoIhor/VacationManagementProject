<button id="button-openModalCreateVacationRequest"
        type="button"
        class="button-vacationRequest-open flex justify-end px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
    Create Vacation Request
</button>

<div id="create_vacation_request_modal" class="pop_up pop_up_employee">
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
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">Create vacation
                                                request</h3>
                                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                                <div class="sm:col-span-2">
                                                    <label for="create_start_date"
                                                           class="block text-sm font-medium text-gray-700">Start
                                                        date</label>
                                                    <div class="mt-1">
                                                        <input id="create_start_date" type="date"
                                                               class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>

                                                <div class="sm:col-span-2">
                                                    <label for="create_end_date"
                                                           class="block text-sm font-medium text-gray-700">End
                                                        date</label>
                                                    <div class="mt-1">
                                                        <input id="create_end_date" type="date"
                                                               class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="sm:col-span-2">
                                                <label for="create_type"
                                                       class="block text-sm font-medium text-gray-700">Type</label>
                                                <select id="create_type"
                                                        class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    <option>VACATIONS</option>
                                                    <option>SICK_DAYS</option>
                                                    <option>PERSONAL_DAYS</option>
                                                </select>
                                            </div>

                                            <div class="pt-5">
                                                <div class="flex justify-end">
                                                    <button
                                                        id="close-modal-window-create-vacation-request"
                                                        type="button"
                                                        class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                        Cancel
                                                    </button>
                                                    <button
                                                        id="button-createVacationRequest" type="button"
                                                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                                        Create
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
