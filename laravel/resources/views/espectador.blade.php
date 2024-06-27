@extends('layouts.master')

@section('title', Auth::user()->espectador->name)

@section('content')
    <div class="flex  mx-5 lg:mx-20 max-w-screen-2xl w-full flex-col">
        <div class="w-full max-w-screen-2xl">
            <div class="w-full">
                <div id="bloc-principal" class="flex flex-col lg:flex-row">
                    <div id="informacio" class="w-full lg:w-2/3 shadow-md  p-3 rounded-lg mb-5 lg:mb-0">
                        <h1 class="mr-2 mb-2">{{ Auth::user()->espectador->name }} {{ Auth::user()->espectador->apellidos }}
                        </h1>

                        <form autocomplete="on" action="{{ route('actualitzarEspectador') }}" method="POST" class="mb-2">
                            @csrf
                            <div class="flex flex-row flex-wrap">
                                <div class="mt-2 w-1/2 pr-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                                        Nom
                                    </label>

                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input required id="name" name="name" type="text"
                                            value="{{ $espectador->name }}" required="" autofocus=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                    </div>

                                </div>

                                <div class="mt-2 w-1/2 pr-2">
                                    <label for="apellidos" class="block text-sm font-medium text-gray-700 leading-5">
                                        Cognoms
                                    </label>

                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input required id="apellidos" name="apellidos" type="text"
                                            value="{{ $espectador->apellidos }}" required="" autofocus=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                    </div>

                                </div>




                                <div class="mt-2 w-full pr-2">
                                    <label for="talla" class="block text-sm font-medium text-gray-700 leading-5">
                                        Talla samarreta
                                    </label>

                                    <ul class="flex flex-col sm:flex-row mt-1">

                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="S" value="S" name="talla"
                                                        @if (Carbon\Carbon::now()->lt(env('DATA_CANVI_DE_PREU'))) disabled @endif type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->talla == 'S') checked @endif>
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
                                                    <input required id="M" value="M" name="talla"
                                                        @if (Carbon\Carbon::now()->lt(env('DATA_CANVI_DE_PREU'))) disabled @endif type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->talla == 'M') checked @endif>
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
                                                    <input required id="L" value="L" name="talla"
                                                        @if (Carbon\Carbon::now()->lt(env('DATA_CANVI_DE_PREU'))) disabled @endif type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->talla == 'L') checked @endif>
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
                                                    <input required id="XL" value="XL" name="talla"
                                                        @if (Carbon\Carbon::now()->lt(env('DATA_CANVI_DE_PREU'))) disabled @endif type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->talla == 'XL') checked @endif>
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
                                                    <input required id="XXL" value="XXL" name="talla"
                                                        @if (Carbon\Carbon::now()->lt(env('DATA_CANVI_DE_PREU'))) disabled @endif type="radio"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->talla == 'XXL') checked @endif>
                                                </div>
                                                <label for="XXL" class="ml-3 block w-full text-sm text-black">
                                                    XXL
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-2 w-full pr-2">
                                    <label for="sexo" class="block text-sm font-medium text-gray-700 leading-5">
                                        Sexe
                                    </label>

                                    <ul class="flex flex-col sm:flex-row mt-1">
                                        <li
                                            class="inline-flex items-center gap-x-2.5 py-3 px-4 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="sexe-home" name="sexo" type="radio"
                                                        value="H"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->sexo == 'H') checked @endif>
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
                                                    <input required id="sexe-dona" name="sexo" type="radio"
                                                        value="D"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->sexo == 'D') checked @endif>
                                                </div>
                                                <label for="sexe-dona"
                                                    class="ml-3 block w-full text-sm text-gray-600 :text-gray-500">
                                                    Dona
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-2 w-1/2 pr-2">
                                    <label for="after" class="block text-sm font-medium text-gray-700 leading-5">
                                        Entrada a l'afterparty?
                                    </label>

                                    <ul class="flex flex-col sm:flex-row mt-1">
                                        <li
                                            class="inline-flex items-center gap-x-2 py-3 px-2 text-sm font-medium bg-white border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg sm:-ml-px sm:mt-0 sm:first:rounded-tr-none sm:first:rounded-bl-lg sm:last:rounded-bl-none sm:last:rounded-tr-lg">
                                            <div class="relative flex items-start w-full">
                                                <div class="flex items-center h-5">
                                                    <input required id="afterparty-si" name="after" type="radio"
                                                        @if (Auth::user()->espectador->estado_inscripcion != 0) disabled @endif value="1"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->after == 1) checked @endif>

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
                                                    <input required id="afterparty-no" name="after" type="radio"
                                                        @if (Auth::user()->espectador->estado_inscripcion != 0) disabled @endif value="0"
                                                        class="border-gray-200 rounded-full :bg-gray-800 :border-gray-700 :checked:bg-blue-500 :checked:border-blue-500 :focus:ring-offset-gray-800"
                                                        @if ($espectador->after == 0) checked @endif>

                                                </div>
                                                <label for="afterparty-no" class="ml-3 block w-full text-sm text-black">
                                                    No
                                                </label>
                                            </div>
                                        </li>

                                </div>

                                <div class="mt-2 w-1/2 pr-2">
                                    <label for="alergenos" class="block text-sm font-medium text-gray-700 leading-5">
                                        Al·lèrgies / Intoleràncies
                                    </label>

                                    <div class="mt-1 rounded-md shadow-sm">
                                        <input id="alergenos" name="alergenos" type="text"
                                            value="{{ $espectador->alergenos }}" autofocus=""
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 ">
                                    </div>
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
                    </div>
                    <!-- ====== Modal Section Start -->
                    <div id="estat-inscripcio" class="flex flex-col shadow-md  p-3 rounded-lg w-full lg:w-1/3">

                        <div class="flex flex-col">
                            <h2 class="mr-2 mb-2">Estat de la inscripció:</h2>
                            @if (Auth::user()->espectador->estado_inscripcion == 0)
                                <div class="estat-0">Pendent de pagament. No confirmada.</div>
                                <div class="mt-2">Preu inscripció:
                                    @if ($espectador->created_at->lt(env('DATA_CANVI_DE_PREU')))
                                        @if ($espectador->after)
                                            {{ env('PREU_INICIAL_AFTER') }}€
                                        @else
                                            {{ env('PREU_INICIAL') }}€
                                        @endif
                                    @else
                                        @if ($espectador->after)
                                            {{ env('PREU_LATE_AFTER') }}€
                                        @else
                                            {{ env('PREU_LATE') }}€
                                        @endif
                                    @endif
                                </div>
                        </div>
                        <div class="flex flex-col">
                            <form action="{{ route('espectadorComprovant') }}" method="POST"
                                enctype="multipart/form-data" class="mb-0">
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
                            <section x-data="{ modalOpen: false }" id="instruccions">
                                <button @click="modalOpen = true"
                                    class="text-blue-950 underline font-medium mt-4 text-left">
                                    Com fer el pagament?
                                </button>
                                <div x-show="modalOpen" x-transition style="z-index: 1"
                                    class="fixed top-0 left-0 flex h-full min-h-screen w-full justify-center bg-black bg-opacity-90 px-4 py-5 overflow-y-auto">
                                    <div @click.outside="modalOpen = false"
                                        class="w-full max-w-[570px] rounded-[20px] bg-white py-12 px-8 text-center md:py-[60px] md:px-[70px] h-fit">
                                        <h3 class="text-dark pb-2 text-xl font-bold sm:text-2xl">
                                            Instruccions
                                        </h3>
                                        <span class="bg-primary mx-auto mb-6 inline-block h-1 w-[90px] rounded"></span>
                                        <p><strong>1.</strong> Editar la teva informació.</p>
                                        <p><strong>2.</strong> Fes el pagament a través de Bizum al número: <br>629 40 56 64
                                        </p>
                                        <p><strong>3.</strong> Adjunta una captura de pantalla del pagament i
                                            premeu “Enviar”.
                                            <br><br>Un cop verifiquem que em rebut correctament el pagament, confirmarem la teva
                                            inscripció
                                            del
                                            torneig com a espectador
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
                    @elseif(Auth::user()->espectador->estado_inscripcion == 1)
                        <div class="estat-1 mt-3 mb-2">Pagament realitzat. Validació en procés.</div>
                        <a href="{{ asset('images/uploads/' . Auth::user()->espectador->comprovante_img) }}"class="text-xs mt-2 underline"
                            target="_blank">Veure
                            comprovant adjuntat</a>
                    @elseif(Auth::user()->espectador->estado_inscripcion == 2)
                        <div class="estat-2">Pagament verificat. Inscripció confirmada!</div>
                        <a href="{{ asset('images/uploads/' . Auth::user()->espectador->comprovante_img) }}"class="text-xs mt-2 underline"
                            target="_blank">Veure
                            comprovant adjuntat</a>
                    </div>
                    @endif
                    <p class="mt-3">* Recordeu que les
                        inscripcions no són reembolsables, però es pot substituïr un espectador inscrit per un altre.
                    </p>
                    @if (Auth::user()->espectador->estado_inscripcion == 0)
                        <form action="{{ route('eliminarInscripcioEspectador') }}" method="POST" class="mb-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Estàs segur que vols eliminar la teva inscripció i equip? S\'esborrarà el teu usuari i t\'hauràs de registrar de nou.')"
                                class="text-dark block w-fit rounded-lg border-2 text-sm border-[#b00;] cursor-pointer px-4 py-2 text-center font-black text-red-600 transition hover:border-red-600 hover:bg-red-600 hover:text-white">Eliminar
                                inscripció</button>
                        </form>
                    @endif
                </div>
                <!-- ====== Modal Section End -->
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
