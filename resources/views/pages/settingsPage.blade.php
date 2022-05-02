@extends('templates.mainPageTemplate')

@section('content')
    <pre>
        USER:
            System Administrator
        TASK:
            Entities that the system admin manages are:
            1. List of Countries where we have offices in
            3. General system settings
                1. Types of days off (Vacation, sick days, personal days)
                2. How many of each type is available as a default
            7. Allowed domains for login (e.g. admins sets that only `@quantox.com` and `@quantoxtechnology.com`
            emails can sign in with google. If anyone with a different email address tries to sign in,
            they get an error.
    </pre>
@endsection
