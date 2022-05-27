@extends('templates.mainPageTemplate')

@section('nav')
    @include('pages.settingsPage')
@endsection

@section('content')
<div>
    <form method="post" action="{{route('roles.store')}}">
        @csrf
        <div class="form-group">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            @error('name')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <input type="text" name="name" id="name" value="{{old('name')}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <label for="vac" class="block text-sm font-medium text-gray-700">Vacations days</label>
            @error('vacations')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <input type="number" name="vacations" value="{{old('vacations')}}" min="1" max="365" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <label for="vac" class="block text-sm font-medium text-gray-700">Personal days</label>
            @error('personal_days')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <input type="number" name="personal_days" value="{{old('personal_days')}}" min="1" max="365" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <label for="vac" class="block text-sm font-medium text-gray-700">Sick days</label>
            @error('sick_days')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <input type="number" name="sick_days" value="{{old('sick_days')}}" min="1" max="365" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
        </div>
        <label for="permissions[]" class="block text-sm font-medium text-gray-700">Permissions:</label>
        @error('permissions')
        <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
        @enderror
        <fieldset class="border-t border-b border-gray-200">
            <legend class="sr-only">Permissions</legend>
            <div class="divide-y divide-gray-200">

        @foreach($permissions as $permission)
                    <div class="relative flex items-start py-4 w-36">
                        <div class="min-w-0 flex-1 text-sm">
                            <label for="exampleCheck{{$permission->id}}" class="font-medium text-gray-700">{{$permission->name}}</label>
                        </div>
                        <div class="ml-3 flex items-center h-5">
                            <input  aria-describedby="comments-description" type="checkbox" value="{{$permission->id}}" id="exampleCheck{{$permission->id}}" name="permissions[]" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                    </div>
        @endforeach

            </div>
        </fieldset>
        <div class="flex justify-end mt-2">
            <a href="{{route('roles.index')}}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
        </div>
    </form>
</div>
@endsection
