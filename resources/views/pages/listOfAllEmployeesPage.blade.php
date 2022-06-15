@extends('templates.mainPageTemplate')

@section('content')


{{--Modal window Add User--}}
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
                                                <h3 class="text-lg leading-6 font-medium text-gray-900">Create a new user</h3>
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
                                                                @foreach ($arrData['countries'] as $role)
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
                                                                @foreach ($arrData['arr']['roles'] as $role)
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

                                                    @foreach ($arrData['arr']['roles'] as $role)
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

{{--Modal window Edit User--}}
    <div id="pop_up_edit_user" class="pop_up pop_up_employee">
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
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">Update user profile</h3>
                                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                                <div class="sm:col-span-2">
                                                    <label for="edit_email" class="block text-sm font-medium text-gray-700"> Email</label>
                                                    <div class="mt-1">
                                                        <input id="edit_email" name="email" type="email" readonly autocomplete="email" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="email-edit_error"></p>
                                                </div>

                                                <br>
                                                <br>
                                                <div></div>
                                                <div></div>

                                                <div class="sm:col-span-2">
                                                    <label for="edit_first_name" class="block text-sm font-medium text-gray-700"> First name </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="create_first_name" id="edit_first_name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="first_name_edit_error"></p>
                                                </div>

                                                <br>

                                                <div class="sm:col-span-2">
                                                    <label for="edit_last_name" class="block text-sm font-medium text-gray-700"> Last name </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="edit_last_name" id="edit_last_name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="last_name_edit_error"></p>
                                                </div>


                                                <div class="sm:col-span-2">
                                                    <label for="list_country_admin_edit" class="block text-sm font-medium text-gray-700"> Country </label>
                                                    <div class="mt-1">
                                                        <select id="list_country_admin_edit" name="country" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            @foreach ($arrData['countries'] as $role)
                                                                <option>{{$role}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <br>

                                                <div class="sm:col-span-2">
                                                    <label for="list_city_admin_edit" class="block text-sm font-medium text-gray-700"> City </label>
                                                    <div class="mt-1">
                                                        <select id="list_city_admin_edit" name="city" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <label for="edit_role_list_admin_edit" class="block text-sm font-medium text-gray-700"> Days off has available per year </label>
                                                    <div class="mt-1">
                                                        <select id="edit_role_list_admin_edit" name="edit_role_list_admin" autocomplete="role-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                            @foreach ($arrData['arr']['roles'] as $role)
                                                                <option>{{$role}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="sm:col-span-1">
                                                    <label for="Vacation_days_list_admin_edit" class="block text-sm font-medium text-gray-700"> Vacation days </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="Vacation_days_list_admin" id="Vacation_days_list_admin_edit" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="vacation_days_edit_error"></p>
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="Sick_days_list_admin_edit" class="block text-sm font-medium text-gray-700"> Sick days </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="Sick_days_list_admin" id="Sick_days_list_admin_edit" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="sick_days_edit_error"></p>
                                                </div>

                                                <div class="sm:col-span-1">
                                                    <label for="Personal_days_list_admin_edit" class="block text-sm font-medium text-gray-700"> Personal days </label>
                                                    <div class="mt-1">
                                                        <input type="text" name="Personal_days_list_admin" id="Personal_days_list_admin_edit" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                    </div>
                                                    <p class="mt-2 text-sm text-red-600 show_error" id="personal_days_edit_error"></p>
                                                </div>

                                                <div class="sm:col-span-6 pt-3">
                                                    <legend class="block text-sm font-medium text-gray-800">Roles</legend>
                                                    <div class="mt-4 border-t border-gray-200 divide-y divide-gray-200">
                                                    </div>
                                                </div>

                                                @foreach ($arrData['arr']['roles'] as $role)
                                                    <div class="sm:col-span-2 ">
                                                        <div id = "{{$role . "_box_edit"}}"  class=" arr-check-box pr-2 pl-2 rounded-lg bg-white overflow-hidden shadow hover:bg-gray-50">
                                                            <div class="relative flex items-start py-4 ">
                                                                <div class="min-w-0 flex-1 text-sm">
                                                                    <label for="{{$role . "_checkbox_edit"}}" class="font-medium text-gray-700 select-none">{{$role}}</label>
                                                                </div>
                                                                <div class="ml-3 flex items-center h-5 ">
                                                                    <input id="{{$role . "_checkbox_edit"}}"  name="my-checkBox" type="checkbox" value="{{$role}}" class=" create_checkbox_edit_user focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <p class="mt-2 text-sm text-red-600 show_error" id="roles_edit_error">Select at least one role.</p>

                                            </div>
                                            <div class="pt-5">
                                                <div class="flex justify-end">
                                                    <button id="close-modal-window-edit-user" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                                    <button id="update_pop_up_employee" type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
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

{{--Modal window Viewing a user's vacation history--}}
<div id="pop_up_viewing_user's_vacation_history" class="pop_up pop_up_employee">
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
                                            <h3 class="text-lg leading-6 font-medium text-gray-900">Viewing a user's vacation history</h3>
                                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                                                {{--                                                <div class="sm:col-span-2">--}}
                                                {{--                                                    <label for="edit_email" class="block text-sm font-medium text-gray-700"> Email</label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <input id="edit_email" name="email" type="email" readonly autocomplete="email" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <p class="mt-2 text-sm text-red-600 show_error" id="email-edit_error"></p>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <br>--}}
                                                {{--                                                <br>--}}
                                                {{--                                                <div></div>--}}
                                                {{--                                                <div></div>--}}

                                                {{--                                                <div class="sm:col-span-2">--}}
                                                {{--                                                    <label for="edit_first_name" class="block text-sm font-medium text-gray-700"> First name </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <input type="text" name="create_first_name" id="edit_first_name" autocomplete="given-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <p class="mt-2 text-sm text-red-600 show_error" id="first_name_edit_error"></p>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <br>--}}

                                                {{--                                                <div class="sm:col-span-2">--}}
                                                {{--                                                    <label for="edit_last_name" class="block text-sm font-medium text-gray-700"> Last name </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <input type="text" name="edit_last_name" id="edit_last_name" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <p class="mt-2 text-sm text-red-600 show_error" id="last_name_edit_error"></p>--}}
                                                {{--                                                </div>--}}


                                                {{--                                                <div class="sm:col-span-2">--}}
                                                {{--                                                    <label for="list_country_admin_edit" class="block text-sm font-medium text-gray-700"> Country </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <select id="list_country_admin_edit" name="country" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                            @foreach ($arrData['countries'] as $role)--}}
                                                {{--                                                                <option>{{$role}}</option>--}}
                                                {{--                                                            @endforeach--}}
                                                {{--                                                        </select>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <br>--}}

                                                {{--                                                <div class="sm:col-span-2">--}}
                                                {{--                                                    <label for="list_city_admin_edit" class="block text-sm font-medium text-gray-700"> City </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <select id="list_city_admin_edit" name="city" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                            <option></option>--}}
                                                {{--                                                        </select>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <div class="sm:col-span-2">--}}
                                                {{--                                                    <label for="edit_role_list_admin_edit" class="block text-sm font-medium text-gray-700"> Days off has available per year </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <select id="edit_role_list_admin_edit" name="edit_role_list_admin" autocomplete="role-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                            @foreach ($arrData['arr']['roles'] as $role)--}}
                                                {{--                                                                <option>{{$role}}</option>--}}
                                                {{--                                                            @endforeach--}}
                                                {{--                                                        </select>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}
                                                {{--                                                <br>--}}

                                                {{--                                                <div class="sm:col-span-1">--}}
                                                {{--                                                    <label for="Vacation_days_list_admin_edit" class="block text-sm font-medium text-gray-700"> Vacation days </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <input type="text" name="Vacation_days_list_admin" id="Vacation_days_list_admin_edit" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <p class="mt-2 text-sm text-red-600 show_error" id="vacation_days_edit_error"></p>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="sm:col-span-1">--}}
                                                {{--                                                    <label for="Sick_days_list_admin_edit" class="block text-sm font-medium text-gray-700"> Sick days </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <input type="text" name="Sick_days_list_admin" id="Sick_days_list_admin_edit" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <p class="mt-2 text-sm text-red-600 show_error" id="sick_days_edit_error"></p>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="sm:col-span-1">--}}
                                                {{--                                                    <label for="Personal_days_list_admin_edit" class="block text-sm font-medium text-gray-700"> Personal days </label>--}}
                                                {{--                                                    <div class="mt-1">--}}
                                                {{--                                                        <input type="text" name="Personal_days_list_admin" id="Personal_days_list_admin_edit" autocomplete="family-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <p class="mt-2 text-sm text-red-600 show_error" id="personal_days_edit_error"></p>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="sm:col-span-6 pt-3">--}}
                                                {{--                                                    <legend class="block text-sm font-medium text-gray-800">Roles</legend>--}}
                                                {{--                                                    <div class="mt-4 border-t border-gray-200 divide-y divide-gray-200">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                @foreach ($arrData['arr']['roles'] as $role)--}}
                                                {{--                                                    <div class="sm:col-span-2 ">--}}
                                                {{--                                                        <div id = "{{$role . "_box_edit"}}"  class=" arr-check-box pr-2 pl-2 rounded-lg bg-white overflow-hidden shadow hover:bg-gray-50">--}}
                                                {{--                                                            <div class="relative flex items-start py-4 ">--}}
                                                {{--                                                                <div class="min-w-0 flex-1 text-sm">--}}
                                                {{--                                                                    <label for="{{$role . "_checkbox_edit"}}" class="font-medium text-gray-700 select-none">{{$role}}</label>--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                                <div class="ml-3 flex items-center h-5 ">--}}
                                                {{--                                                                    <input id="{{$role . "_checkbox_edit"}}"  name="my-checkBox" type="checkbox" value="{{$role}}" class=" create_checkbox_edit_user focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300 rounded">--}}
                                                {{--                                                                </div>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </div>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                @endforeach--}}
                                                {{--                                                <p class="mt-2 text-sm text-red-600 show_error" id="roles_edit_error">Select at least one role.</p>--}}

                                            </div>
                                            <div class="pt-5">
                                                <div class="flex justify-end">
                                                    <button id="close-modal-window-history-vacation-user" type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</button>
                                                    {{--                                                    <button id="update_pop_up_employee" type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>--}}
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

{{--Elasticsearch--}}
    <div class="box-elasticsearchUser pt-10 px-4 sm:px-6 lg:px-8 pr-250px" id="box-elasticsearchListUser">
        <div class="pl-50proc">
            <div class="absoluteCenter mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">
                <div class="relative">
                    <svg class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                    <label>
{{--                        <form method="" action="" onsubmit="return sendInputElasticsearch()">--}}
{{--                            <input id="elasticsearchListUser" type="text" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options">--}}
{{--                        </form>--}}
                        <input id="elasticsearchListUser" type="text" class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800
                        holder-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." role="combobox" aria-expanded="false" aria-controls="options">
                    </label>
                </div>
                <ul class="elasticsearchOptionsListUser show_block max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800" id="elasticsearchOptionsList" role="listbox">
                    <li class="cursor-default select-none px-4 py-2" id="option-1" role="option" tabindex="-1">Leslie Alexander</li>
                    <li class="cursor-default select-none px-4 py-2" id="option-2" role="option" tabindex="-1">Michael Foster</li>
                    <li class="cursor-default select-none px-4 py-2" id="option-3" role="option" tabindex="-1">Dries Vincent</li>
                    <li class="cursor-default select-none px-4 py-2" id="option-4" role="option" tabindex="-1">Lindsay Walton</li>
                    <li class="cursor-default select-none px-4 py-2" id="option-5" role="option" tabindex="-1">Courtney Henry</li>
                </ul>
                <p class="show_block p-4 text-sm text-gray-500" id="elasticsearchNotFound">No people found.</p>
            </div>
        </div>
    </div>

{{--Sort--}}
    <div class="pt-40 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-row">
        <div class="basis-1/4 mr-10">
            <label for="list_roles_sort" class="block text-sm font-medium text-gray-700"> Role </label>
            <div class="mt-1">
                <select id="list_roles_sort" name="city" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option>All</option>
                    @foreach ($arrData['arr']['roles'] as $role)
                        <option>{{$role}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="basis-1/4 mr-10">
            <label for="list_countries_sort" class="block text-sm font-medium text-gray-700"> Country </label>
            <div class="mt-1">
                <select id="list_countries_sort" name="city" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option>All</option>
                    @foreach ($arrData['countries'] as $country)
                        <option>{{$country}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="basis-1/4 mr-10">
            <label for="list_cities_sort" class="block text-sm font-medium text-gray-700"> City </label>
            <div class="mt-1">
                <select id="list_cities_sort" name="city" autocomplete="country-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option>All</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{--Table--}}
    <div class="pt-20 px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">List of all employees</h1>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <button id="add_pop_up_employee" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add user</button>
            </div>
        </div>
        <div id="1234567">

        </div>
    </div>

{{--Paginate--}}
    <div class="pt-2">
        <nav class="mx-7 px-4 flex items-center justify-between sm:px-0">
            <div class="-mt-px w-0 flex-1 flex">
                <a href="#" id="first-page-table-user" class=" pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    First
                </a>
            </div>
            <div class="hidden md:-mt-px md:flex">
                <a href="#" id="previous-page-table-user" class=" pt-4 pr-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Previous
                </a>
                <p id="text-number-page" class="text-gray-700 hover:border-gray-300 pt-4 px-4 inline-flex items-center text-sm font-medium">1 / 22</p>
                <a href="#" id="next-page-table-user" class=" pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Next
                    <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>

            </div>
            <div class="-mt-px w-0 flex-1 flex justify-end">
                <a href="#" id="last-page-table-user" class=" pt-4 pl-1 inline-flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                    Last
                    <svg class="ml-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </nav>
    </div>



{{--    <pre>--}}
{{--        USER:--}}
{{--            System Administrator--}}
{{--        TASK:--}}
{{--            System Administrator controls how many of each type of days off an employee has available per year. E.g.:--}}
{{--            - Vacation days: 20--}}
{{--            - Personal days: 5--}}
{{--            - Sick days: 5--}}

{{--            In some cases, the number of days varies per employee, e.g. based on their highest education level.--}}

{{--            Because of this, we should be able to override the number of days on a per employee basis.--}}

{{--            There should be a table of all employees allowing the system admin to view and manage all employee data--}}
{{--            (HRs, employees, PMs, other admins). The table should be searchable by email and name.--}}

{{--            6. Employees--}}
{{--                1. Be able to override the number of available days of for each type on a per employee basis--}}
{{--                2. Add / remove employees--}}
{{--                3. Edit employee data--}}

{{--        USER:--}}
{{--            HR, PM--}}
{{--        TASK:--}}
{{--            1.  HR and PM can see a list of all employees and search and filter them by email, county, city--}}
{{--            2.  HRs and PMs should be able to open details of any employee and see a detailed history of their--}}
{{--            vacations and days off, as well as an overview of how many days they worked this month and previous month.--}}
{{--    </pre>--}}
@endsection
