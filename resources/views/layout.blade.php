<!DOCTYPE html>
<html lang="en">
<head>
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
