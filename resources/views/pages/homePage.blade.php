@extends('templates.mainPageTemplate')

@section('content')
    <pre>
    USER:
        Employee, HR, PM, System Administrator
    TASK:
        4. PMs and HRs should be able to see which days are public holidays.
        5. HR, PM should see a list of all vacation requests assigned to them to approve or deny.

        1. When an employee logs in, they should see how many days off they have left.
        2. Employee should be able to see any pending requests they have
</pre>
    <h1 class="sr-only">Profile</h1>
    <div class="grid grid-cols-1 gap-4 items-start lg:grid-cols-2 lg:gap-8">
        <div class="grid grid-cols-1 gap-4 lg:col-span-2">
            <section aria-labelledby="profile-overview-title">
                <div class="rounded-lg bg-white overflow-hidden shadow">
                    <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
                    <div class="bg-white p-6">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="sm:flex sm:space-x-5">
                                <div class="flex-shrink-0">
                                    <img class="mx-auto h-20 w-20 rounded-full"
                                         src="{{$userParameters->getGoogleAvatar()}}" alt="">
                                </div>
                                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                                    <p class="text-sm font-medium text-gray-600">Welcome back,</p>
                                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{$userParameters->getFirstName() . " " . $userParameters->getLastName()}} </p>
                                    <p class="text-sm font-medium text-gray-600">{{$userParameters->getEmail()}}</p>
                                </div>
                            </div>
                            @include('vacations.creation_modal_window')
                        </div>
                    </div>
                    <div
                        class="border-t border-gray-200 bg-gray-50 grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-y-0 sm:divide-x">
                        @foreach($vacationDaysLeft as $type => $vacationDayLeft)
                            <div class="px-6 py-5 text-sm font-medium text-center">
                            <span
                                class="text-gray-900">{{ $vacationDayLeft }} {{ (str_replace("_", " ", ucfirst(strtolower($type)))) }} left
                            </span>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
