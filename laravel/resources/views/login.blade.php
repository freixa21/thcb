@extends('partials.head')

@section('title', 'Login')


    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="text-3xl font-extrabold text-center text-gray-900 leading-9">
                Iniciar sessió
            </h1>
        </div>

        @if (session('registroCorrecto'))
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
                <div class="px-4 py-4 bg-green-200 shadow sm:rounded-lg sm:px-5 text-green-900">
                    {{ session('registroCorrecto') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="flex justify-center w-full">
                <div class="alert alert-danger">
                    <ul class="list-none p-0 m-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="flex justify-center w-full">
                <div class="alert alert-success max-w-screen-2xl mx-5 lg:mx-20">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif

        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-md px-4">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                <form action="{{ route('auth.login') }}" method="post">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                            Correu electrònic
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" name="email" type="email" required="" autofocus=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                            Contrasenya
                        </label>

                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="password" type="password" name="password" required=""
                                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                        </div>

                    </div>

                    <div class="flex items-center justify-between mt-4">

                        <div class="text-sm leading-5">
                            <a href="{{ route('password.request') }}"
                                class="font-medium text-blue-600 hover:text-blue-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                                Has oblidat la contrasenya?
                            </a>
                        </div>
                    </div>

                    <div class="mt-4">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit"
                                class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-900 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none transition duration-150 ease-in-out">
                                Iniciar sessió
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">

            <h3 class="text-center mb-2">No estás registrat?</h3>

            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10 flex flex-row">
                <div class="w-1/2 text-center">
                    <a href="/registre-equips"
                        class="font-medium text-sm  block p-2 w-full rounded-md bg-blue-900 text-white hover:bg-blue-700 mr-2 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Registrar equip &nbsp;<i class="fa-solid fa-people-group" style="color: #ffffff;"></i>
                    </a>
                </div>
                <div class="w-1/2 text-center">

                    <a href="/registre-espectadors"
                    class="font-medium text-sm  block p-2 w-full rounded-md bg-blue-900 text-white hover:bg-blue-700 ml-2 focus:outline-none focus:underline transition ease-in-out duration-150">
                        Registrar espectador &nbsp;<i class="fa-solid fa-person" style="color: #ffffff;"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
