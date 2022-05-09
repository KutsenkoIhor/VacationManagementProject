<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('roles.store')}}">
        @csrf
        <div class="form-group">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <label for="vac" class="block text-sm font-medium text-gray-700">Vacations days</label>
            <input type="text" name="vacations"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <label for="vac" class="block text-sm font-medium text-gray-700">Personal days</label>
            <input type="text" name="personal_days" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            <label for="vac" class="block text-sm font-medium text-gray-700">Sick days</label>
            <input type="text" name="sick_days"  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
        </div>
        <fieldset class="border-t border-b border-gray-200">
            <legend class="sr-only">Permissions</legend>
            <div class="divide-y divide-gray-200">

        @foreach($permissions as $permission)
                    <div class="relative flex items-start py-4">
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
        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
    </form>
</div>
</body>
</html>
