@include('partials.head')

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

        <div id="container-body" class="mb-4 flex justify-center align-middle">
            @yield('content')
        </div>
    </div>
</body>

</html>
