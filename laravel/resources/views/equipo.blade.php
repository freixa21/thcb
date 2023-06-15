@extends('layouts.master')

@section('title', Auth::user()->equipo->nombre)

@section('content')

    @php  $total = 0 @endphp
    @foreach ($jugadores as $jugador)
        @if ($jugador->created_at->lt('2023-06-23 0:00:00'))
            @if ($jugador->after)
                @php $total += 35 @endphp
            @else
                @php  $total += 25 @endphp
            @endif
        @else
            @if ($jugador->after)
                @php  $total += 40  @endphp
            @else
                @php  $total += 30  @endphp
            @endif
        @endif
    @endforeach

    <div class="flex  mx-5 lg:mx-20 max-w-screen-2xl w-full flex-col">
        <div class="w-full max-w-screen-2xl">
            <div class="w-full">
                <div id="bloc-principal" class="flex flex-col lg:flex-row">
                    <div id="informacio" class="w-full lg:w-1/2 shadow-md  p-3 rounded-lg mb-5 lg:mb-0">
                        <h1 class="mr-2 mb-2">{{ Auth::user()->equipo->nombre }}</h1>
                        <p><strong>Nom capità: </strong> {{ Auth::user()->name }} {{ Auth::user()->apellidos }} </p>
                        <p><strong>Correu electrònic:</strong> {{ Auth::user()->email }} </p>
                        <p><strong>Telèfon:</strong> {{ Auth::user()->phone }} </p>
                        @if (Auth::user()->equipo->estado_inscripcion == 0)
                            <p>* Cal inscriure tots els jugadors abans de fer el pagament. Després del pagament, només es
                                podràn inscriure nous jugadors enviant un correu a l'organització. Recordeu que les
                                inscripcions no són reembolsables, però es pot substituïr un jugador inscrit per un altre.
                            </p>
                        @endif
                    </div>
                    <!-- ====== Modal Section Start -->
                    <div id="estat-inscripcio" class="flex flex-col shadow-md  p-3 rounded-lg w-full lg:w-1/2">

                        <div class="flex flex-col">
                            <h2 class="mr-2 mb-2">Estat de la inscripció:</h2>
                            @if (Auth::user()->equipo->estado_inscripcion == 0)
                                <div class="estat-0">Pendent de pagament. No confirmada.</div>
                                <p class="mt-2">Has d'afegir un mínim de 5 jugadors per poder fer el pagament.</p>
                        </div>
                        <div class="flex flex-col">
                            <p class="mt-2">Total inscripció:
                                <strong>{{ $total }}€</strong>
                            </p>
                            @if (count($jugadores) > 4)
                                <form action="{{ route('uploadComprovant') }}" method="POST" enctype="multipart/form-data"
                                    class="mb-0">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="comprovante_img" class="block mt-3">Adjuntar comprovant/captura de
                                            pantalla:</label>
                                        <input type="file" name="comprovante_img" id="comprovante_img"
                                            class="form-input rounded-md shadow-sm mt-1 block w-full" required>
                                        @error('comprovante_img')
                                            <p class="text-red-500 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit"
                                            class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-2 px-2 rounded">
                                            Enviar
                                        </button>
                                    </div>
                                </form>
                            @endif
                            <section x-data="{ modalOpen: false }" id="instruccions">
                                <button @click="modalOpen = true"
                                    class="text-blue-950 underline font-medium mt-4 text-left">
                                    Com fer el pagament?
                                </button>
                                @if (Auth::user()->equipo->estado_inscripcion == 0)
                                    <form action="{{ route('eliminarInscripcioEquip') }}" method="POST" class="mt-8 mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Estàs segur que vols eliminar la teva inscripció? S\'esborrarà el teu usuari i t\'hauràs de registrar de nou.')"
                                            class="text-dark block w-fit rounded-lg border-2 text-sm border-[#b00;] cursor-pointer px-4 py-2 text-center font-black text-red-600 transition hover:border-red-600 hover:bg-red-600 hover:text-white">Eliminar
                                            inscripció</button>
                                    </form>
                                @endif
                                <div x-show="modalOpen" x-transition style="z-index: 1"
                                    class="fixed top-0 left-0 flex h-full min-h-screen w-full justify-center bg-black bg-opacity-90 px-4 py-5 overflow-y-auto">
                                    <div @click.outside="modalOpen = false"
                                        class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px] h-fit">
                                        <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl">
                                            Instruccions
                                        </h3>
                                        <span class="bg-primary mx-auto mb-6 inline-block h-1 w-[90px] rounded"></span>
                                        <p><strong>1.</strong> Afegiu mínim 5 jugadors.</p>
                                        <p><strong>2.</strong> Un cop afegits, un integrant de l'equip ha de fer <strong>un
                                                sol pagament de totes les inscripcions</strong> a través de
                                            Bizum o Verse amb les següents opcions:
                                            <br> - Bizum o Verse al número: 629 40 56 64
                                            <br> - Verse al $VerseTag: $alexfreixa
                                            <br> - Verse escanejant el QR:
                                        </p>
                                        <a href="https://verse.me/$alexfreixa" target="_blank"><img
                                                src="{{ asset('images/qr-web-thcb.png') }}" alt=""
                                                class="qr-beach"></a>
                                        <p class="mini-qr">Si estàs conectat desde el mòbil pots obrir l'enllaç del QR picant
                                            l'imatge
                                        </p>
                                        <p><strong>3.</strong> Adjunteu una captura de pantalla del pagament i premeu
                                            “Enviar”.
                                            Un cop verifiquem que em rebut correctament el pagament, confirmarem la vostra
                                            inscripció
                                            del
                                            torneig
                                            per correu electrònic.</p>
                                        <div class="-mx-3 flex flex-wrap">
                                            <div class="w-full px-3">
                                                <button @click="modalOpen = false"
                                                    class="text-dark block w-full rounded-lg border border-[#E9EDF9] p-3 text-center text-base font-medium bg-blue-950 text-white transition hover:border-blue-900 hover:bg-blue-900 hover:text-white">
                                                    Tancar finestra
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    @elseif(Auth::user()->equipo->estado_inscripcion == 1)
                        <div class="estat-1 mt-3 mb-2">Pagament realitzat. Validació en procés.</div>
                        <a href="{{ asset('images/uploads/' . Auth::user()->equipo->comprovante_img) }}"class="text-xs mt-2 underline"
                            target="_blank">Veure
                            comprovant adjuntat</a>
                        <p class="mt-4 text-sm">* Si es volen afegir més jugadors un cop fet el pagament, cal enviar un mail
                            a inscripcions@hockeycostabrava.com.</p>
                    @elseif(Auth::user()->equipo->estado_inscripcion == 2)
                        <div class="estat-2">Pagament verificat. Inscripció confirmada!</div>
                        <a href="{{ asset('images/uploads/' . Auth::user()->equipo->comprovante_img) }}"class="text-xs mt-2 underline"
                            target="_blank">Veure
                            comprovant adjuntat</a>
                        <p class="mt-4 text-sm">* Si es volen afegir més jugadors un cop fet el pagament, cal enviar un mail
                            a inscripcions@hockeycostabrava.com.</p>
                    </div>
                    @endif

                </div>
                <!-- ====== Modal Section End -->
            </div>




        </div>
    </div>
    <div class="w-full mt-6 max-w-screen-2xl">
        <div class="flex flex-row align-middle">
            <h2 class="mb-2 leading-none">Jugadors</h2>
            @if (Auth::user()->equipo->estado_inscripcion == 0)
                <section x-data="{ modalOpen: false }" id="instruccions">
                    <div class="container mx-auto">
                        <a @click="modalOpen = true" class="afegir-jugador-btn">
                            <i class="fa-solid fa-user-plus"></i> Afegir jugador
                        </a>
                    </div>
                    <!-- MODAL AFEGIR JUGADOR -->
                    <div x-show="modalOpen" x-transition style="z-index: 1"
                        class="fixed top-0 left-0 flex h-full min-h-screen w-full justify-center bg-black bg-opacity-90 px-4 pt-5 pb-32 overflow-y-auto">
                        <div @click.outside="modalOpen = false"
                            class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 md:py-[60px] md:px-[70px] h-fit">
                            <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl text-center">
                                Afegir nou jugador
                            </h3>

                            <form autocomplete="on" action="{{ route('afegirJugador') }}" method="POST" class="mb-2">
                                @csrf

                                <div class="mt-2">
                                    <label for="name-afegir" class="block text-sm font-medium text-gray-700 leading-5">
                                        Nom
                                    </label>

                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input required id="name-afegir" name="name" type="text" required=""
                                            autofocus
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                    </div>

                                </div>

                                <div class="mt-2">
                                    <label for="apellidos-afegir" class="block text-sm font-medium text-gray-700 leading-5">
                                        Cognoms
                                    </label>

                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input required id="apellidos-afegir" name="apellidos" type="text"
                                            required=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                    </div>

                                </div>

                                <div class="mt-2">
                                    <label for="sexo" class="block text-sm font-medium text-gray-700 leading-5">
                                        Sexe
                                    </label>

                                    <ul class="flex flex-col sm:flex-row mt-1">
                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="sexe-home-afegir" name="sexo" type="radio"
                                                        value="H"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="sexe-home-afegir"
                                                    class="ml-3 block w-full text-sm text-black">
                                                    Home
                                                </label>
                                            </div>
                                        </li>
                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg :bg-gray-800 :border-gray-700 :text-white">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="sexe-dona-afegir" name="sexo" type="radio"
                                                        value="D"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="sexe-dona-afegir"
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
                                                    <input required id="S-afegir" value="S" name="talla"
                                                        type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="S-afegir" class="ml-3 block w-full text-sm text-black">
                                                    S
                                                </label>
                                            </div>
                                        </li>

                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="M-afegir" value="M" name="talla"
                                                        type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="M-afegir" class="ml-3 block w-full text-sm text-black">
                                                    M
                                                </label>
                                            </div>
                                        </li>

                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="L-afegir" value="L" name="talla"
                                                        type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="L-afegir" class="ml-3 block w-full text-sm text-black">
                                                    L
                                                </label>
                                            </div>
                                        </li>

                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="XL-afegir" value="XL" name="talla"
                                                        type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="XL-afegir" class="ml-3 block w-full text-sm text-black">
                                                    XL
                                                </label>
                                            </div>
                                        </li>

                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="XXL-afegir" value="XXL" name="talla"
                                                        type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">
                                                </div>
                                                <label for="XXL-afegir" class="ml-3 block w-full text-sm text-black">
                                                    XXL
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-2">
                                    <label for="after" class="block text-sm font-medium text-gray-700 leading-5">
                                        Entrada a l'afterparty?
                                    </label>

                                    <ul class="flex flex-col sm:flex-row mt-1">
                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="afterparty-si-afegir" name="after"
                                                        type="radio" value="1"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">

                                                </div>
                                                <label for="afterparty-si-afegir"
                                                    class="ml-3 block w-full text-sm text-black">
                                                    Sí
                                                </label>
                                            </div>
                                        </li>
                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="afterparty-no-afegir" name="after"
                                                        type="radio" value="0"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800">

                                                </div>
                                                <label for="afterparty-no-afegir"
                                                    class="ml-3 block w-full text-sm text-black">
                                                    No
                                                </label>
                                            </div>
                                        </li>

                                </div>

                                <div class="mt-2">
                                    <label for="alergenos-afegir"
                                        class="block text-sm font-medium text-gray-700 leading-5">
                                        Al·lèrgies / Intoleràncies
                                    </label>

                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input id="alergenos-afegir" name="alergenos" type="text" value=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <span class="block w-full rounded-md shadow-sm">
                                        <button type="submit"
                                            class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-900 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                            Afegir jugador
                                        </button>
                                    </span>
                                </div>
                            </form>

                            <div class="-mx-3 flex flex-wrap">
                                <div class="w-full px-3">
                                    <button @click="modalOpen = false"
                                        class="text-dark block w-full rounded-lg border-2 text-sm border-[#9b4132;] px-4 py-2 text-center font-black text-blue-950 transition hover:border-blue-900 hover:bg-blue-900 hover:text-white">
                                        Tancar finestra
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FINAL MODAL AFEGIR JUGADOR -->
                </section>
            @endif
        </div>
        <div class="relative overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-2 py-3 text-center">
                            #
                        </th>
                        <th scope="col" class="px-2 py-3">Jugador</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Sexe</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Talla</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Afterparty</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Al·lèrgies</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Data inscripció</th>
                        <th scope="col" class="px-2 py-3">€</th>
                        <th scope="col" class="px-2 py-3">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jugadores as $jugador)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="px-2 py-3 text-center">{{ $loop->index + 1 }}</td>
                            <th scope="row" class="px-2 py-3 font-medium text-gray-900  whitespace-nowrap truncate"
                                style="max-width: 100px">
                                {{ $jugador->nombre }} {{ $jugador->apellidos }}
                            </th>
                            <td class="px-2 py-3 amagar-mobil">{{ $jugador->sexo }}</td>
                            <td class="px-2 py-3 amagar-mobil">{{ $jugador->talla }}</td>
                            <td class="px-2 py-3 amagar-mobil">
                                @if ($jugador->after == 1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td class="px-2 py-3 amagar-mobil truncate" style="max-width: 100px">
                                {{ $jugador->alergenos }}
                            </td>
                            <td class="px-2 py-3 amagar-mobil">{{ $jugador->created_at->format('d-m-Y') }}</td>
                            <td class="px-2 py-3">
                                @if ($jugador->created_at->lt('2023-06-23 0:00:00'))
                                    @if ($jugador->after)
                                        35€
                                    @else
                                        25€
                                    @endif
                                @else
                                    @if ($jugador->after)
                                        40€
                                    @else
                                        30€
                                    @endif
                                @endif
                            </td>

                            <td class="py-4 max-w-0">
                                <section x-data="{ modalOpen: false }" id="instruccions">
                                    <div class="container mx-auto">
                                        <button @click="modalOpen = true" class="">
                                            <i class="fa-solid fa-user-pen" style="color: #172554;"></i>
                                        </button>
                                    </div>
                                    <!-- MODAL EDITAR JUGADOR -->
                                    <div x-show="modalOpen" x-transition style="z-index: 1"
                                        class="fixed top-0 left-0 flex h-full min-h-screen w-full justify-center bg-black bg-opacity-90 px-4 pt-5 pb-32 overflow-y-auto">
                                        <div @click.outside="modalOpen = false"
                                            class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 md:py-[60px] md:px-[70px] h-fit">
                                            <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl text-center">
                                                {{ $jugador->nombre }} {{ $jugador->apellidos }}
                                            </h3>

                                            <form autocomplete="on" action="{{ route('actualitzarJugador') }}"
                                                method="POST" class="mb-2">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $jugador->id }}">

                                                <div class="mt-2">
                                                    <label for="name-{{ $loop->index }}"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Nom
                                                    </label>

                                                    <div class="mt-1 rounded-md shadow-sm">
                                                        <input required id="name-{{ $loop->index }}" name="name"
                                                            type="text" value="{{ $jugador->nombre }}" required=""
                                                            autofocus
                                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                                    </div>

                                                </div>

                                                <div class="mt-2">
                                                    <label for="apellidos-{{ $loop->index }}"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Cognoms
                                                    </label>

                                                    <div class="mt-1 rounded-md shadow-sm">
                                                        <input required id="apellidos-{{ $loop->index }}"
                                                            name="apellidos" type="text"
                                                            value="{{ $jugador->apellidos }}" required=""
                                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                                    </div>

                                                </div>

                                                <div class="mt-2">
                                                    <label for="sexo"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Sexe
                                                    </label>

                                                    <ul class="flex flex-col sm:flex-row mt-1">
                                                        <li
                                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="sexe-home-{{ $loop->index }}"
                                                                        name="sexo" type="radio" value="H"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->sexo == 'H') checked @endif>
                                                                </div>
                                                                <label for="sexe-home-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    Home
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg :bg-gray-800 :border-gray-700 :text-white">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="sexe-dona-{{ $loop->index }}"
                                                                        name="sexo" type="radio" value="D"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->sexo == 'D') checked @endif>
                                                                </div>
                                                                <label for="sexe-dona-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-gray-600 :text-gray-500">
                                                                    Dona
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>



                                                <div class="mt-2">
                                                    <label for="talla"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Talla samarreta
                                                    </label>

                                                    <ul class="flex flex-col sm:flex-row mt-1">
                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="S-{{ $loop->index }}"
                                                                        value="S"
                                                                        @if (Carbon\Carbon::now()->gt('2023-07-06 0:00:00')) disabled @endif
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'S') checked @endif>
                                                                </div>
                                                                <label for="S-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    S
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="M-{{ $loop->index }}"
                                                                        value="M"
                                                                        @if (Carbon\Carbon::now()->gt('2023-07-06 0:00:00')) disabled @endif
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'M') checked @endif>
                                                                </div>
                                                                <label for="M-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    M
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="L-{{ $loop->index }}"
                                                                        value="L"
                                                                        @if (Carbon\Carbon::now()->gt('2023-07-06 0:00:00')) disabled @endif
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'L') checked @endif>
                                                                </div>
                                                                <label for="L-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    L
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="XL-{{ $loop->index }}"
                                                                        value="XL"
                                                                        @if (Carbon\Carbon::now()->gt('2023-07-06 0:00:00')) disabled @endif
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'XL') checked @endif>
                                                                </div>
                                                                <label for="XL-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    XL
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="XXL-{{ $loop->index }}"
                                                                        value="XXL"
                                                                        @if (Carbon\Carbon::now()->gt('2023-07-06 0:00:00')) disabled @endif
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'XXL') checked @endif>
                                                                </div>
                                                                <label for="XXL-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    XXL
                                                                </label>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="mt-2">
                                                    <label for="after"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Entrada a l'afterparty?
                                                    </label>

                                                    <ul class="flex flex-col sm:flex-row mt-1">
                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="afterparty-si-{{ $loop->index }}"
                                                                        name="after"
                                                                        @if (Auth::user()->equipo->estado_inscripcion != 0) disabled @endif
                                                                        type="radio" value="1"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->after == 1) checked @endif>

                                                                </div>
                                                                <label for="afterparty-si-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    Sí
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="afterparty-no-{{ $loop->index }}"
                                                                        name="after"
                                                                        @if (Auth::user()->equipo->estado_inscripcion != 0) disabled @endif
                                                                        type="radio" value="0"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->after == 0) checked @endif>

                                                                </div>
                                                                <label for="afterparty-no-{{ $loop->index }}"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </li>

                                                </div>

                                                <div class="mt-2">
                                                    <label for="alergenos-{{ $loop->index }}"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Al·lèrgies / Intoleràncies
                                                    </label>

                                                    <div class="mt-1 rounded-md shadow-sm">
                                                        <input id="alergenos-{{ $loop->index }}" name="alergenos"
                                                            type="text" value="{{ $jugador->alergenos }}"
                                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                                    </div>
                                                </div>

                                                <div class="mt-6">
                                                    <span class="block w-full rounded-md shadow-sm">
                                                        <button type="submit"
                                                            class="flex justify-center w-full px-4 py-2 text-sm text-white font-black bg-green-500 border border-transparent rounded-md hover:bg-green-800 transition duration-150 ease-in-out">
                                                            Guardar canvis
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>
                                            @if (Auth::user()->equipo->estado_inscripcion == 0)
                                                <div class="-mx-3 flex flex-wrap mb-2">
                                                    <div class="w-full px-3">
                                                        <form action="{{ route('eliminarJugador', $jugador->id) }}"
                                                            method="POST" class="mb-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                onclick="return confirm('Estàs segur de que vols eliminar aquest jugador?')"
                                                                class="text-dark block w-full rounded-lg border-2 text-sm border-[#b00;] cursor-pointer px-4 py-2 text-center font-black text-red-600 transition hover:border-red-600 hover:bg-red-600 hover:text-white">Eliminar
                                                                jugador</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="-mx-3 flex flex-wrap">
                                                <div class="w-full px-3">
                                                    <button @click="modalOpen = false"
                                                        class="text-dark block w-full rounded-lg border-2 text-sm border-[#9b4132;] px-4 py-2 text-center font-black text-blue-950 transition hover:border-blue-900 hover:bg-blue-900 hover:text-white">
                                                        Tancar finestra
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FINAL MODAL EDITAR JUGADOR -->
                                </section>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- CALCULADORA INSCRIPCIO SEGONS LA DATA DE INSCRIPCIÓ DE CADA PARTICIPANT -->
            <div class="text-right pr-10 p-2 bg-white">Total inscripció equip:
                <strong>{{ $total }}€</strong>
            </div>
            <!-- Calculadora inscripcio END -->
        </div>


    </div>
    </div>
    </div>
@endsection
