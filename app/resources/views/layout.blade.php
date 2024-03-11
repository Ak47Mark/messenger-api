<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger API</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
    <link rel="stylesheet" href="{{asset('style.css')}}">
</head>
<body>
    <header>
        <!-- @yield('header') -->
    </header>
    <main>
        @yield('content')
    </main>
    <script src="{{asset('app.js')}}"></script>
</body>
</html>