@extends('templates.mainPageTemplate')

@section('content')


{{--Modal window--}}
    <div id="pop_up_employee" class="pop_up pop_up_employee">
        <div class="pop_up_container">
            <div class="pop_up_body_body">
                <div  class="px-4 sm:px-6 lg:px-8  mb-8 ">
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <div class="p-6">
                                            <form class="space-y-8 divide-y divide-gray-200">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">Profile employee</h3>
                                                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                                    <div class="sm:col-span-2">
                                                        <label for="create_email" class="block text-sm font-medium text-gray-700"> Email</label>
                                                        <div class="mt-1">
                                                            <input id="create_email" name="email" type="email" autocomplete="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        <p class="mt-2 text-sm text-red-600 show_error" id="email-error"></p>
                                                    </div>

                                                    <br>
                                                    <br>
                                                    <div></div>
                                                    <div></div>

                                                    <div class="sm:col-span-2">
                                                        <label for="create_first_name" class="block text-sm font-medium text-gray-700"> First name </label>
                                                        <div class="mt-1">
                                                            <input type="text" name="create_first_name" id="create_first_name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        <p class="mt-2 text-sm text-red-600 show_error" id="first_name_error"></p>
                                                    </div>

                                                    <br>

                                                    <div class="sm:col-span-2">
                                                        <label for="create_last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
                                                        <div class="mt-1">
                                                            <input type="text" name="create_last_name" id="create_last_name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        <p class="mt-2 text-sm text-red-600 show_error" id="last_name_error"></p>
                                                    </div>


                                                    <div class="sm:col-span-2">
                                                        <label for="list_country_admin" class="block text-sm font-medium text-gray-700"> Country </label>
                                                        <div class="mt-1">
                                                            <select id="list_country_admin" name="country" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                                @foreach ($arrRolee['countries'] as $role)
                                                                    <option>{{$role}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <br>

                                                    <div class="sm:col-span-2">
                                                        <label for="list_city_admin" class="block text-sm font-medium text-gray-700"> City </label>
                                                        <div class="mt-1">
                                                            <select id="list_city_admin" name="city" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="sm:col-span-2">
                                                        <label for="role_list_admin" class="block text-sm font-medium text-gray-700"> Days off has available per year </label>
                                                        <div class="mt-1">
                                                            <select id="role_list_admin" name="role_list_admin" autocomplete="role-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                                @foreach ($arrRolee['arr']['roles'] as $role)
                                                                    <option>{{$role}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <br>

                                                    <div class="sm:col-span-1">
                                                        <label for="Vacation_days_list_admin" class="block text-sm font-medium text-gray-700"> Vacation days </label>
                                                        <div class="mt-1">
                                                            <input type="text" name="Vacation_days_list_admin" id="Vacation_days_list_admin" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        <p class="mt-2 text-sm text-red-600 show_error" id="vacation_days_error"></p>
                                                    </div>

                                                    <div class="sm:col-span-1">
                                                        <label for="Sick_days_list_admin" class="block text-sm font-medium text-gray-700"> Sick days </label>
                                                        <div class="mt-1">
                                                            <input type="text" name="Sick_days_list_admin" id="Sick_days_list_admin" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        <p class="mt-2 text-sm text-red-600 show_error" id="sick_days_error"></p>
                                                    </div>

                                                    <div class="sm:col-span-1">
                                                        <label for="Personal_days_list_admin" class="block text-sm font-medium text-gray-700"> Personal days </label>
                                                        <div class="mt-1">
                                                            <input type="text" name="Personal_days_list_admin" id="Personal_days_list_admin" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                        </div>
                                                        <p class="mt-2 text-sm text-red-600 show_error" id="personal_days_error"></p>
                                                    </div>

                                                    <div class="sm:col-span-6 pt-3">
                                                        <legend class="block text-sm font-medium text-gray-800">Roles</legend>
                                                        <div class="mt-4 border-t border-gray-200 divide-y divide-gray-200">
                                                        </div>
                                                    </div>

                                                    @foreach ($arrRolee['arr']['roles'] as $role)
                                                        <div class="sm:col-span-2 ">
                                                            <div id = "{{$role . "_box"}}"  class=" arr-check-box pr-2 pl-2 rounded-lg bg-white overflow-hidden shadow hover:bg-gray-50">
                                                                <div class="relative flex items-start py-4 ">
                                                                    <div class="min-w-0 flex-1 text-sm">
                                                                        <label for="{{$role . "_checkbox"}}" class="font-medium text-gray-700 select-none">{{$role}}</label>
                                                                    </div>
                                                                    <div class="ml-3 flex items-center h-5 ">
                                                                        <input id="{{$role . "_checkbox"}}"  name="my-checkBox" type="checkbox" value="{{$role}}" class=" create_checkbox focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="roles_error">Select at least one role.</p>

                                                </div>
                                                <div class="pt-5">
                                                    <div class="flex justify-end">
                                                        <button id="close_pop_up_employee" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                                        <button id="save_pop_up_employee" type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
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


{{--Main Window--}}
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">List of all employees</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button id="add_pop_up_employee" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add user</button>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Email</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">First name</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Last name</th>
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
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">lindsay.walton@example.com</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Walton</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Admin</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Ukrain</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Kiev</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">17</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">4</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">2</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Delete<span class="sr-only">, Lindsay Walton</span></a>
                                </td>
                            </tr>
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">lindsay.walton@example.com</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Lindsay</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Walton</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Admin</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Ukrain</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Kiev</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">17</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">4</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">2</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Delete<span class="sr-only">, Lindsay Walton</span></a>
                                </td>
                            </tr>

                            <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <pre>
        USER:
            System Administrator
        TASK:
            System Administrator controls how many of each type of days off an employee has available per year. E.g.:
            - Vacation days: 20
            - Personal days: 5
            - Sick days: 5

            In some cases, the number of days varies per employee, e.g. based on their highest education level.

            Because of this, we should be able to override the number of days on a per employee basis.

            There should be a table of all employees allowing the system admin to view and manage all employee data
            (HRs, employees, PMs, other admins). The table should be searchable by email and name.

            6. Employees
                1. Be able to override the number of available days of for each type on a per employee basis
                2. Add / remove employees
                3. Edit employee data

        USER:
            HR, PM
        TASK:
            1.  HR and PM can see a list of all employees and search and filter them by email, county, city
            2.  HRs and PMs should be able to open details of any employee and see a detailed history of their
            vacations and days off, as well as an overview of how many days they worked this month and previous month.
    </pre>
@endsection
