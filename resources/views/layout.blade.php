<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <h1>@yield('header')</h1>
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
