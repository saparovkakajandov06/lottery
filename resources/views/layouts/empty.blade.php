<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{asset('jquery/jquery.min.js')}}" ></script>

    <title>Application</title>

</head>
<body >
<div>
    @yield('content')
</div>
</body>
</html>
