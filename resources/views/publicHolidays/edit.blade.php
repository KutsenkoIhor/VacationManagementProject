@extends('templates.mainPageTemplate')

@section('content')
    <div>
        <form method="post" action="{{route('holidays.update', $holiday->id)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title" class="block text-sm font-medium text-gray-700">Holiday</label>
                @error('title')
                <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
                @enderror
                <input type="text" name="title" value="{{$holiday->title}}" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
            <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
            @error('country_id')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <select name="country_id" id="country" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md w-36">
                <option value="">Select Country</option>

                @foreach($countries as $country)
                    <option value="{{$country->id }}" {{$country->id == $holiday->country_id ? "selected" : ""}}>{{ $country->title }}</option>
                @endforeach

            </select>

            @error('date')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <div class="sm:col-span-2">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <div class="mt-1">
                    <input id="date" name="date" type="date" value="{{$holiday->holiday_date}}" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-36 sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="flex justify-end mt-2">
                <a href="{{route('holidays.index')}}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
        </form>
    </div>
@endsection
