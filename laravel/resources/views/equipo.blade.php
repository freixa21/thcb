@extends('layouts.master')

@section('title', Auth::user()->equipo->nombre)

@section('content')
    <div class="flex w-full max-w-screen-2xl">
        <div class="w-1/2">
            <div id="informacio">
                <h1>{{ Auth::user()->equipo->nombre }}</h1>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p><strong>Nom capità: </strong> {{ Auth::user()->name }} {{ Auth::user()->apellidos }} </p>
                <p><strong>Correu electrònic:</strong> {{ Auth::user()->email }} </p>
                <p><strong>Telèfon:</strong> {{ Auth::user()->phone }} </p>
            </div>
            <div id="instruccions">
                <h3>Instruccions:</h2>
                    <p>1. Afegiu, editeu i elimineu jugadors.</p>
                    <p>2. Un cop afegits tots els jugadors, feu el pagament a través de l’aplicació Verse a:
                        <br> - Al número: 630 206 438
                        <br> - Al $VerseTag: $maxfreixa
                        <br> - o escanejant el QR:
                    </p>
                    <a href="#" target="_blank"><img src="{{ asset('images/qr-web-thcb.png') }}" alt=""
                            class="qr-beach"></a>
                    <p class="mini-qr">Si estàs conectat desde el mòbil obrir l'enllaç del QR picant l'imatge</p>
                    <p>3. Adjunteu una captura de pantalla del pagament i marqueu l’opció “Confirmar pagament”.
                        Un cop verifiquem que em rebut correctament el pagament, confirmarem la vostra inscripció del
                        torneig
                        per correu electrònic.</p>
            </div>
            <div id="estat-inscripcio" class="flex flex-col">

                <div class="items-center mt-3">
                    <h3 class="mr-2">Estat de la inscripció:</h3>
                    @if (Auth::user()->equipo->estado_inscripcion == 0)
                        <span class="estat-0">Pendent de pagament</span>
                </div>
                <div class="flex">
                    <form action="{{ route('uploadComprovant') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="comprovante_img" class="block mt-3">Adjuntar comprovant/captura de
                                pantalla:</label>
                            <input type="file" name="comprovante_img" id="comprovante_img"
                                class="form-input rounded-md shadow-sm mt-1 block w-full">
                            @error('comprovante_img')
                                <p class="text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-8">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Marcar com a pagada
                            </button>
                        </div>
                    </form>
                </div>
            @elseif(Auth::user()->equipo->estado_inscripcion == 1)
                <span class="estat-1 mt-3">Pagament realitzat. Esperant confirmació dels organitzadors.</span><br>
                <a href="{{ asset('images/uploads/' . Auth::user()->equipo->comprovante_img) }}"class="text-sm underline" target="_blank">Veure
                    comprovant adjuntat</a>
            
        @elseif(Auth::user()->equipo->estado_inscripcion == 2)
            <span class="estat-2">Pagament verificat. Inscripcio confirmada!</span>
        </div>
        @endif
    </div>



    </div>
    </div>
    <div class="w-1/2">
        
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
    <tr>
    <th scope="col" class="px-6 py-3">
    Product name
    </th>
    <th scope="col" class="px-6 py-3">Color</th>
    <th scope="col" class="px-6 py-3">Category</th>
    <th scope="col" class="px-6 py-3">Price</th>
    <th scope="col" class="px-6 py-3">
    <span class="sr-only">Edit</span>
    </th>
    </tr>
    </thead>
    <tbody>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
    Apple MacBook Pro 17"
    </th>
    <td class="px-6 py-4">Sliver</td>
    <td class="px-6 py-4">Laptop</td>
    <td class="px-6 py-4">$2999</td>
    <td class="px-6 py-4 text-right">
    <a href="#" class="font-medium text-text-fuchsia-500 dark:text-fuchsia-400-600 dark:text-text-fuchsia-500 dark:text-fuchsia-400-500 hover:underline">Edit</a>
    </td>
    </tr>
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
    Microsoft Surface Pro
    </th>
    <td class="px-6 py-4">White</td>
    <td class="px-6 py-4">Laptop PC</td>
    <td class="px-6 py-4">$1999</td>
    <td class="px-6 py-4 text-right">
    <a href="#" class="font-medium text-text-fuchsia-500 dark:text-fuchsia-400-600 dark:text-text-fuchsia-500 dark:text-fuchsia-400-500 hover:underline">Edit</a>
    </td>
    </tr>
    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
    Magic Mouse 2
    </th>
    <td class="px-6 py-4">Black</td>
    <td class="px-6 py-4">Accessories</td>
    <td class="px-6 py-4">$99</td>
    <td class="px-6 py-4 text-right">
    <a href="#" class="font-medium text-text-fuchsia-500 dark:text-fuchsia-400-600 dark:text-text-fuchsia-500 dark:text-fuchsia-400-500 hover:underline">Edit</a>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    
    </div>
    </div>

@endsection
