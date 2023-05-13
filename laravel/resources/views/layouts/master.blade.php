<html lang="es-ca">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <title>@yield('title') - Inscripcions Hockey Costa Brava</title>
</head>

<body>

    @include('partials.header')
    <div id="container-body" class="flex justify-center mx-20">
        @yield('content')
    </div>

</body>

</html>
