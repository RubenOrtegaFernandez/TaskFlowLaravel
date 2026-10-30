
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TaskFlow')</title>
    

    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;700&family=Martian+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @vite(['resources/js/popups.js', 'resources/js/registre.js', 'resources/js/esborrany.js'])
</head>
<body>
    @include('partials.icons')

     <main class="page @yield('page-class')" @yield('page-attrs')>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>