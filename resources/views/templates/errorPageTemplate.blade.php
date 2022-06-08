<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('custom_styles')
    <title>Vacation Management</title>
    <link rel="shortcut icon" href="{{"/image/vacation.svg"}}" type="image/svg">
</head>
<body>

@yield('content')

</body>
<script src="{{ asset('js/app.js') }}">
</script>
<script src="{{asset('https://unpkg.com/flowbite@1.4.2/dist/datepicker.js')}}"></script>
</html>
