@extends('templates.mainPageTemplate')

@section('nav')
{{--    {{dd(strripos(url()->current(), 'cities'))}}--}}
    <div>
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select a tab</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                <option @if(strripos(url()->current(), 'countries')) selected @endif>Countries</option>

                <option @if(strripos(url()->current(), 'cities')) selected @endif>Cities</option>

                <option @if(strripos(url()->current(), 'roles')) selected @endif>Roles and Permissions</option>

                <option @if(strripos(url()->current(), 'domains')) selected @endif>Domains</option>
            </select>
        </div>
        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="-mb-px flex" aria-label="Tabs">
                    <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                    <a href="{{route('countries.index')}}" class="@if(strripos(url()->current(), 'countries'))border-indigo-500 text-indigo-600 @else text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif  w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm"> Countries </a>

                    <a href="{{route('cities.index')}}" class="@if(strripos(url()->current(), 'cities')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif  w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm"> Cities </a>

                    @role('System Admin')
                    <a href="{{route('roles.index')}}" class="@if(strripos(url()->current(), 'roles')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm" aria-current="page"> Roles and Permissions </a>

                    <a href="{{route('domains.index')}}" class="@if(strripos(url()->current(), 'domains')) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif w-1/4 py-4 px-1 text-center border-b-2 font-medium text-sm"> Domains </a>
                    @endrole

                </nav>
            </div>
        </div>
    </div>
{{--    <pre>--}}
{{--        USER:--}}
{{--            System Administrator--}}
{{--        TASK:--}}
{{--            Entities that the system admin manages are:--}}
{{--            1. List of Countries where we have offices in--}}
{{--            3. General system settings--}}
{{--                1. Types of days off (Vacation, sick days, personal days)--}}
{{--                2. How many of each type is available as a default--}}
{{--            7. Allowed domains for login (e.g. admins sets that only `@quantox.com` and `@quantoxtechnology.com`--}}
{{--            emails can sign in with google. If anyone with a different email address tries to sign in,--}}
{{--            they get an error.--}}
{{--    </pre>--}}
@endsection
