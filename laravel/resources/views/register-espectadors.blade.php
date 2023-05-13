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

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form autocomplete="on" action="{{ route('registrar.espectador') }}" method="POST">
                    @csrf

                    <div class="mt-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                            Nom espectador
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="name" name="name" type="text" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="apellidos" class="block text-sm font-medium text-gray-700 leading-5">
                            Cognom espectador
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="apellidos" name="apellidos" type="text" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                            Correu electrònic
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="email" name="email" type="email" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 leading-5">
                            Telèfon
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="phone" name="phone" type="tel" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-2">
                        <label for="talla" class="block text-sm font-medium text-gray-700 leading-5">
                            Sexe
                        </label>

                        <ul class="flex flex-col sm:flex-row mt-1">
                            <li
                                class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="sexe-home" name="sexo" type="radio" value="H"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="sexe-home" class="ml-3 block w-full text-sm text-black">
                                        Home
                                    </label>
                                </div>
                            </li>
                            <li
                                class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg :bg-gray-800 :border-gray-700 :text-white">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="sexe-dona" name="sexo" type="radio" value="D"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                    </div>
                                    <label for="sexe-dona"
                                        class="ml-3 block w-full text-sm text-gray-600 :text-gray-500">
                                        Dona
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>



                    <div class="mt-2">
                        <label for="talla" class="block text-sm font-medium text-gray-700 leading-5">
                            Talla samarreta
                        </label>

                        <ul class="flex flex-col sm:flex-row mt-1">
                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="XS" value="XS" name="talla" type="radio"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="XS" class="ml-3 block w-full text-sm text-black">
                                        XS
                                    </label>
                                </div>
                            </li>

                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="S" value="S" name="talla" type="radio"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="S" class="ml-3 block w-full text-sm text-black">
                                        S
                                    </label>
                                </div>
                            </li>

                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="M" value="M" name="talla" type="radio"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="M" class="ml-3 block w-full text-sm text-black">
                                        M
                                    </label>
                                </div>
                            </li>

                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="L" value="L" name="talla" type="radio"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="L" class="ml-3 block w-full text-sm text-black">
                                        L
                                    </label>
                                </div>
                            </li>

                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="XL" value="XL" name="talla" type="radio"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="XL" class="ml-3 block w-full text-sm text-black">
                                        XL
                                    </label>
                                </div>
                            </li>

                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="XXL" value="XXL" name="talla" type="radio"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="XXL" class="ml-3 block w-full text-sm text-black">
                                        XXL
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-2">
                        <label for="after" class="block text-sm font-medium text-gray-700 leading-5">
                            Vols comprar entrada a l'afterparty?
                        </label>

                        <ul class="flex flex-col sm:flex-row mt-1">
                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="afterparty-si" name="after" type="radio" value="1"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="afterparty-si" class="ml-3 block w-full text-sm text-black">
                                        Sí
                                    </label>
                                </div>
                            </li>
                            <li
                                class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                <div class="relative flex items-start w-full">
                                    <div class="flex items-center h-5">
                                        <input required id="afterparty-no" name="after" type="radio" value="0"
                                            class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                            >
                                    </div>
                                    <label for="afterparty-no" class="ml-3 block w-full text-sm text-black">
                                        No
                                    </label>
                                </div>
                            </li>

                    </div>

                    <div class="mt-2">
                        <label for="alergenos" class="block text-sm font-medium text-gray-700 leading-5">
                            Al·lèrgies / Intoleràncies
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="alergenos" name="alergenos" type="text" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                            Contrasenya
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="password" type="password" name="password" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                            Confirmar contrasenya
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input required id="password_confirmation" name="password_confirmation" type="password" required=""
                                autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>
                    </div>


                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input required id="remember" type="checkbox"
                                class="form-checkbox w-4 h-4 text-blue-600 transition duration-150 ease-in-out">
                            <label for="remember" class="block ml-2 text-sm text-gray-900 leading-5">
                                He llegit i accepto la política de privacitat
                            </label>
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