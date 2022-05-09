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
    <form method="post" action="{{route('cities.add')}}">
        @csrf
        <div class="form-group">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" name="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
        </div>
        <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
        <select name="country_id" id="country" class="form-control custom-select">
            <option value="">Select Country</option>
            @foreach($countries as $country)
                <option value="{{$country->id }}">{{ $country->title }}</option>
            @endforeach
        </select>
        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
    </form>
</div>
</body>
</html>
