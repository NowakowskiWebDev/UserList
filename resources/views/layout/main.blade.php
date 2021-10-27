<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>App Users</title>

    <link href="/css/app.css" rel="stylesheet">

</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Header --}}
    @component('global.header')
    @endcomponent

    <main class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @component('global.footer')
    @endcomponent
    <script src="/js/app.js"></script>
</body>

</html>
