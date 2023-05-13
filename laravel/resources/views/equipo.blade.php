@extends('layouts.master')

@section('title', Auth::user()->equipo->nombre)

@section('content')
    <div class="w-full max-w-screen-2xl">
        <div class="w-full">
            <div id="bloc-principal" class="flex">
                <div id="informacio" class="w-1/2">
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
                <!-- ====== Modal Section Start -->
                <section x-data="{ modalOpen: false }" id="instruccions" class="w-1/2">
                    <div class="container mx-auto">
                        <button @click="modalOpen = true"
                            class="bg-blue-950 text-white rounded-full py-3 px-6 text-base font-medium">
                            Obrir instruccions
                        </button>
                    </div>
                    <div x-show="modalOpen" x-transition
                        class="fixed top-0 left-0 flex h-full min-h-screen w-full items-center justify-center bg-black bg-opacity-90 px-4 py-5">
                        <div @click.outside="modalOpen = false"
                            class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px]">
                            <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl">
                                Instruccions
                            </h3>
                            <span class="bg-primary mx-auto mb-6 inline-block h-1 w-[90px] rounded"></span>
                            <p><strong>1.</strong> Afegiu, editeu i elimineu jugadors.</p>
                            <p><strong>2.</strong> Un cop afegits tots els jugadors, feu el pagament a través de l’aplicació
                                Verse a:
                                <br> - Al número: 630 206 438
                                <br> - Al $VerseTag: $maxfreixa
                                <br> - o escanejant el QR:
                            </p>
                            <a href="#" target="_blank"><img src="{{ asset('images/qr-web-thcb.png') }}"
                                    alt="" class="qr-beach"></a>
                            <p class="mini-qr">Si estàs conectat desde el mòbil obrir l'enllaç del QR picant l'imatge</p>
                            <p><strong>3.</strong> Adjunteu una captura de pantalla del pagament i marqueu l’opció
                                “Confirmar pagament”.
                                Un cop verifiquem que em rebut correctament el pagament, confirmarem la vostra inscripció
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
            <div id="estat-inscripcio" class="flex flex-col">

                <div class="items-center mt-3">
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
                <div class="estat-1 mt-3">Pagament realitzat. Esperant confirmació dels organitzadors.</div>
                <a href="{{ asset('images/uploads/' . Auth::user()->equipo->comprovante_img) }}"class="text-xs mt-2 underline"
                    target="_blank">Veure
                    comprovant adjuntat</a>
            @elseif(Auth::user()->equipo->estado_inscripcion == 2)
                <div class="estat-2">Pagament verificat. Inscripcio confirmada!</div>
            </div>
            @endif
        </div>



    </div>
    </div>
    <div class="w-full mt-4">
        <h2 class="mb-2">Jugadors</h2>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="z-index: -1">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">Jugador</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Sexe</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Al·lèrgies</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Afterparty</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Data inscripció</th>
                        <th scope="col" class="px-6 py-3 amagar-mobil">Preu inscripció</th>
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
                                {{ $jugador->name }} {{ $jugador->apellidos }}
                            </th>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->sexo }}</td>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->alergenos }}</td>
                            <td class="px-6 py-4 amagar-mobil">
                                @if ($jugador->after == 1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td class="px-6 py-4 amagar-mobil">{{ $jugador->created_at }}</td>
                            <td class="px-6 py-4 amagar-mobil">
                                @if ($jugador->created_at->lt('2023-06-23 0:00:00'))
                                    @if ($jugador->after)
                                        35
                                    @else
                                        25
                                    @endif
                                @else
                                    @if ($jugador->after)
                                        40
                                    @else
                                        25
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="#" class="font-medium text-text-fuchsia-500    hover:underline">Editar</a>
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
