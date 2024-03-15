<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="https://tailwindui.com/img/logos/mark.svg?color=white" type="image/svg+xml">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    @vite(['resources/js/app.js'])
</head>
<body class="bg-gray-800">
    <div id="app">
        @yield('content')
    </div>
</body>
</html>
