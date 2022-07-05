<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
<img src="{{ asset('/image/logo.png') }}" alt="logo" />
<p>Vacation request for {{ $last_name }} {{ $first_name }} from {{ $start_date }} to {{ $end_date }} was created</p>
</body>
</html>
