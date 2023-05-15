<html lang="es-ca">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>
    <script src="https://kit.fontawesome.com/445b0dce98.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <title>@yield('title') - Inscripcions Hockey Costa Brava</title>
</head>

<body>
    <div id="master-div">
        @include('partials.header')

        @if (session()->has('success'))
            <div class="alert alert-success max-w-screen-2xl mx-5 lg:mx-20">
                {{ session()->get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger max-w-screen-2xl mx-5 lg:mx-20">
                <ul class="list-none p-0 m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="container-body" class="flex justify-center flex-col mx-5 lg:mx-20">
            @yield('content')
        </div>
    </div>
</body>

</html>
