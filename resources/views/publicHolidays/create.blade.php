@extends('templates.mainPageTemplate')

@section('content')
    <div>
        <form method="post" action="{{route('holidays.store')}}">
            @csrf
            <div class="form-group">
                <label for="title" class="block text-sm font-medium text-gray-700">Holiday</label>
                @error('title')
                <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
                @enderror
                <input type="text" name="title" id="title" value="{{old('title')}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
            <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
            @error('country_id')
            <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
            @enderror
            <fieldset class="border-t border-b border-gray-200">
                <legend class="sr-only">Countries</legend>
                <div class="divide-y divide-gray-200">

                    @foreach($countries as $country)
                        <div class="relative flex items-start py-4 w-36">
                            <div class="min-w-0 flex-1 text-sm">
                                <label for="exampleCheck{{$country->id}}" class="font-medium text-gray-700">{{$country->title}}</label>
                            </div>
                            <div class="ml-3 flex items-center h-5">
                                <input  aria-describedby="comments-description" type="checkbox" value="{{$country->id}}" id="exampleCheck{{$country->id}}" name="countries[]" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                            </div>
                        </div>
                    @endforeach

                </div>
            </fieldset>

            <div class="sm:col-span-2">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                @error('date')
                <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
                @enderror
                <div class="mt-1">
                    <input id="date" name="date" type="date" class="text-gray-400 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-36 sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="flex justify-end mt-2">
                <a href="{{route('holidays.index')}}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
        </form>
    </div>
@endsection
