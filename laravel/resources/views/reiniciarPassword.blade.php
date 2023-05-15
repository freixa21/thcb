<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold text-center text-gray-900 leading-9">
                Reiniciar contrasenya
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                o torna a <a href="/"
                    class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    <strong>iniciar sessió</strong>
                </a>
            </p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form action="" method="post">
                    @csrf
                    <div class="mt-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                            Contrasenya
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password" type="password" name="password" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                            Confirmar contrasenya
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>
                    </div>
                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit"
                                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-900 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                Reiniciar contrasenya
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
