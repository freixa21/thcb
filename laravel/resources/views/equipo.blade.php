@extends('layouts.master')

@section('title', Auth::user()->equipo->nombre)

@section('content')
    <div class="w-full max-w-screen-2xl">
        <div class="w-full">
            <div id="bloc-principal" class="flex">
                <div id="informacio" class="w-1/2 shadow-md  p-3 rounded-lg">
                    <h1 class="mr-2 mb-2">{{ Auth::user()->equipo->nombre }}</h1>

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
                <!-- ====== Modal Section Start -->
                    <div id="estat-inscripcio" class="flex flex-col shadow-md  p-3 rounded-lg w-1/2">

                        <div class="items-center">
                            <h2 class="mr-2 mb-2">Estat de la inscripció:</h2>
                            @if (Auth::user()->equipo->estado_inscripcion == 0)
                                <div class="estat-0">Pendent de pagament</div>
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
                        <div class="estat-1 mt-3 mb-2">Pagament realitzat. Validació en procés.</div>
                        <a href="{{ asset('images/uploads/' . Auth::user()->equipo->comprovante_img) }}"class="text-xs mt-2 underline"
                            target="_blank">Veure
                            comprovant adjuntat</a>
                    @elseif(Auth::user()->equipo->estado_inscripcion == 2)
                        <div class="estat-2">Pagament verificat. Inscripcio confirmada!</div>
                    </div>
                    @endif
                    <section x-data="{ modalOpen: false }" id="instruccions" class="w-1/2">
                        <div class="container mx-auto">
                            <button @click="modalOpen = true"
                                class="bg-blue-950 text-white rounded-md px-1 py-1 mt-4 text-base font-medium">
                                Com fer el pagament?
                            </button>
                        </div>
                        <div x-show="modalOpen" x-transition style="z-index: 1"
                            class="fixed top-0 left-0 flex h-full min-h-screen w-full justify-center bg-black bg-opacity-90 px-4 py-5 overflow-y-auto" >
                            <div @click.outside="modalOpen = false"
                                class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px] h-fit">
                                <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl">
                                    Instruccions
                                </h3>
                                <span class="bg-primary mx-auto mb-6 inline-block h-1 w-[90px] rounded"></span>
                                <p><strong>1.</strong> Afegiu, editeu i elimineu jugadors.</p>
                                <p><strong>2.</strong> Un cop afegits tots els jugadors, feu el pagament a través de
                                    l’aplicació
                                    Verse a:
                                    <br> - Al número: 630 206 438
                                    <br> - Al $VerseTag: $maxfreixa
                                    <br> - o escanejant el QR:
                                </p>
                                <a href="#" target="_blank"><img src="{{ asset('images/qr-web-thcb.png') }}"
                                        alt="" class="qr-beach"></a>
                                <p class="mini-qr">Si estàs conectat desde el mòbil obrir l'enllaç del QR picant l'imatge
                                </p>
                                <p><strong>3.</strong> Adjunteu una captura de pantalla del pagament i marqueu l’opció
                                    “Confirmar pagament”.
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
            <!-- ====== Modal Section End -->

        </div>



    </div>
    </div>
    <div class="w-full mt-4">
        <h2 class="mb-2">Jugadors</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">Jugador</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Sexe</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Talla</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Afterparty</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Al·lèrgies</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Data inscripció</th>
                        <th scope="col" class="px-6 py-3">Preu inscripció</th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Editar</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jugadores as $jugador)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900  whitespace-nowrap">
                                {{ $jugador->nombre }} {{ $jugador->apellidos }}
                            </th>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->sexo }}</td>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->talla }}</td>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->alergenos }}</td>
                            <td class="px-6 py-4 amagar-mobil">
                                @if ($jugador->after == 1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->created_at }}</td>
                            <td class="px-6 py-4">
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
                                        25€
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <section x-data="{ modalOpen: false }" id="instruccions" class="w-1/2">
                                    <div class="container mx-auto">
                                        <button @click="modalOpen = true" class="">
                                            Veure/Editar
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

                                            <form autocomplete="on" action="" method="POST">
                                                @csrf

                                                <input type="hidden" name="id" value="{{ $jugador->id }}">

                                                <div class="mt-2">
                                                    <label for="name"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Nom
                                                    </label>

                                                    <div class="mt-1 rounded-md shadow-sm">
                                                        <input required id="name" name="name" type="text"
                                                            value="{{ $jugador->nombre }}" required="" autofocus=""
                                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                                    </div>

                                                </div>

                                                <div class="mt-2">
                                                    <label for="apellidos"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Cognoms
                                                    </label>

                                                    <div class="mt-1 rounded-md shadow-sm">
                                                        <input required id="apellidos" name="apellidos" type="text"
                                                            value="{{ $jugador->apellidos }}" required=""
                                                            autofocus=""
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
                                                                    <input required id="sexe-home" name="sexo"
                                                                        type="radio" value="H"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->sexo == 'H') checked @endif>
                                                                </div>
                                                                <label for="sexe-home"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    Home
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg :bg-gray-800 :border-gray-700 :text-white">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="sexe-dona" name="sexo"
                                                                        type="radio" value="D"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->sexo == 'D') checked @endif>
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
                                                    <label for="talla"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Talla samarreta
                                                    </label>

                                                    <ul class="flex flex-col sm:flex-row mt-1">
                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="XS" value="XS"
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'XS') checked @endif>
                                                                </div>
                                                                <label for="XS"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    XS
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="S" value="S"
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'S') checked @endif>
                                                                </div>
                                                                <label for="S"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    S
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="M" value="M"
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'M') checked @endif>
                                                                </div>
                                                                <label for="M"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    M
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="L" value="L"
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'L') checked @endif>
                                                                </div>
                                                                <label for="L"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    L
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="XL" value="XL"
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'XL') checked @endif>
                                                                </div>
                                                                <label for="XL"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    XL
                                                                </label>
                                                            </div>
                                                        </li>

                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="XXL" value="XXL"
                                                                        name="talla" type="radio"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->talla == 'XXL') checked @endif>
                                                                </div>
                                                                <label for="XXL"
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
                                                        Vols comprar entrada a l'afterparty?
                                                    </label>

                                                    <ul class="flex flex-col sm:flex-row mt-1">
                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="afterparty-si" name="after"
                                                                        type="radio" value="1"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->after == 1) checked @endif>

                                                                </div>
                                                                <label for="afterparty-si"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    Sí
                                                                </label>
                                                            </div>
                                                        </li>
                                                        <li
                                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                                            <div class="relative flex items-start w-full">
                                                                <div class="flex items-center h-5">
                                                                    <input required id="afterparty-no" name="after"
                                                                        type="radio" value="0"
                                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                                        @if ($jugador->after == 0) checked @endif>

                                                                </div>
                                                                <label for="afterparty-no"
                                                                    class="ml-3 block w-full text-sm text-black">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </li>

                                                </div>

                                                <div class="mt-2">
                                                    <label for="alergenos"
                                                        class="block text-sm font-medium text-gray-700 leading-5">
                                                        Al·lèrgies / Intoleràncies
                                                    </label>

                                                    <div class="mt-1 rounded-md shadow-sm">
                                                        <input required id="alergenos" name="alergenos" type="text"
                                                            value="{{ $jugador->alergenos }}" required=""
                                                            autofocus=""
                                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                                    </div>
                                                </div>

                                                <div class="mt-6">
                                                    <span class="block w-full rounded-md shadow-sm">
                                                        <button type="submit"
                                                            class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-900 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                                            Actualitzar informació
                                                        </button>
                                                    </span>
                                                </div>
                                            </form>

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
                                    <!-- FINAL MODAL EDITAR JUGADOR -->
                                </section>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- CALCULADORA INSCRIPCIO SEGONS LA DATA DE INSCRIPCIÓ DE CADA PARTICIPANT -->
            <div>Total a pagar: @php  $total = 0 @endphp
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
                            @php  $total += 25  @endphp
                        @endif
                    @endif
                @endforeach
            </div>
            {{ $total }}
        </div>

    </div>
    </div>

@endsection
