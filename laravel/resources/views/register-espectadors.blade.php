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
                Registre espectador
            </h2>
            <p class="mt-2 text-sm text-center text-gray-600 leading-5 max-w">
                o
                <a href="/"
                    class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                    iniciar sessió
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

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form autocomplete="off" action="{{ route('registrar.espectador') }}" method="POST">
                    @csrf

                    <div class="mt-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                            Nom espectador
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="name" name="name" type="text" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="apellidos" class="block text-sm font-medium text-gray-700 leading-5">
                            Cognom espectador
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="apellidos" name="apellidos" type="text" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                            Correu electrònic
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" name="email" type="email" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 leading-5">
                            Telèfon
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="phone" name="phone" type="tel" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="sexo" class="block text-sm font-medium text-gray-700 leading-5">
                            Sexe
                        </label>

                        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="sexo-hombre" type="radio" value="" name="sexo"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="sexo-hombre"
                                class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Home
                                radio</label>
                        </div>
                        <div class="flex items-center pl-4 border border-gray-200 rounded dark:border-gray-700">
                            <input checked id="sexo-hombre" type="radio" value="" name="sexo"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="sexo-hombre"
                                class="w-full py-4 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Dona
                                state</label>
                        </div </div>



                        <div class="mt-2">
                            <label for="talla" class="block text-sm font-medium text-gray-700 leading-5">
                                Talla samarreta
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="talla" name="talla" type="radio" required="" autofocus=""
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                            </div>
                        </div>

                        <div class="mt-2">
                            <label for="afterparty" class="block text-sm font-medium text-gray-700 leading-5">
                                Vols comprar entrada a l'afterparty?
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="afterparty" name="afterparty" type="radio" required="" autofocus=""
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                            </div>
                        </div>

                        <div class="mt-2">
                            <label for="alergenos" class="block text-sm font-medium text-gray-700 leading-5">
                                Al·lèrgies / Intoleràncies
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="alergenos" name="alergenos" type="text" required="" autofocus=""
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                            </div>
                        </div>

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
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-gray-700 leading-5">
                                Confirmar contrasenya
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    required="" autofocus=""
                                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                            </div>
                        </div>


                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <input id="remember" type="checkbox"
                                    class="form-checkbox w-4 h-4 text-blue-600 transition duration-150 ease-in-out">
                                <label for="remember" class="block ml-2 text-sm text-gray-900 leading-5">
                                    He llegit i accepto la política de privacitat
                                </label>
                            </div>

                            <div class="text-sm leading-5">
                                <a href="#"
                                    class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                    Has oblidat la contraseña?
                                </a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit"
                                    class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-900 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    Registrar-me com espectador
                                </button>
                            </span>
                        </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
