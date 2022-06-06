@extends('templates.mainPageTemplate')

@section('nav')
    @include('pages.settingsPage')
@endsection

@section('content')
<body>
<div>
    <form method="post" action="{{route('countries.add')}}">
        @csrf
    <div class="form-group">
        <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
        @error('title')
        <div class="mt-2 text-sm text-red-700">{{ $message }}</div>
        @enderror
        <input type="text" name="title" id="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
    </div>
        <div class="flex justify-end mt-2">
            <a href="{{route('countries.index')}}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cancel</a>
            <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
        </div>
    </form>
</div>
@endsection