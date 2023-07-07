@extends('layouts.master')

@section('title', 'Espectadors')

@section('content')

    <div class="w-full mt-6 max-w-screen-2xl">
        <div class="flex flex-row align-middle">
            <h2 class="mb-2 leading-none">Espectadors</h2>
        </div>
        <div class="relative overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                    <tr>
                        <th scope="col" class="px-2 py-3 text-center">
                            #
                        </th>
                        <th scope="col" class="px-2 py-3">Espectador</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Sexe</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Talla</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Afterparty</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Data inscripció</th>
                        <th scope="col" class="px-2 py-3">Rebut</th>
                        <th scope="col" class="px-2 py-3">€</th>
                        <th scope="col" class="px-2 py-3">
                            <span class="sr-only"></span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($espectadors as $espectador)
                        <tr class="bg-white border-b  hover:bg-gray-50 ">
                            <td class="px-2 py-3 text-center">{{ $loop->index + 1 }}</td>
                            <th scope="row" class="px-2 py-3 font-medium text-gray-900  whitespace-nowrap truncate"
                                style="max-width: 100px">
                                {{ $espectador->name }} {{ $espectador->apellidos }}
                            </th>
                            <td class="px-2 py-3 amagar-mobil">{{ $espectador->sexo }}</td>
                            <td class="px-2 py-3 amagar-mobil">{{ $espectador->talla }}</td>
                            <td class="px-2 py-3 amagar-mobil">
                                @if ($espectador->after == 1)
                                    Sí
                                @else
                                    No
                                @endif
                            </td>
                            <td class="px-2 py-3 amagar-mobil">{{ $espectador->created_at->format('d-m-Y') }}</td>
                            <td class="px-2 py-3">
                                @if ($espectador->estado_inscripcion == 0)
                                    <span class="text-red-950">No pagada</span>
                                @elseif($espectador->estado_inscripcion == 1)
                                    <a href="{{ asset('images/uploads/' . $espectador->comprovante_img) }}"
                                        target="_blank"><i class="fa-solid fa-receipt" style="color: #23599c;"></i></a> |
                                    <span class="text-blue-950">Pagada</span> | <a
                                        class="px-1 bg-blue-950 text-white rounded-md"
                                        href="{{ route('admin.validarInscripcioEspectador', $espectador->id) }}"
                                        onclick="return confirm('Estàs segur que vols confirmar el pagament?')">Validar</a>
                                @elseif($espectador->estado_inscripcion == 2)
                                    <span class="text-green-950">Confirmada <a
                                            href="{{ asset('images/uploads/' . $espectador->comprovante_img) }}"
                                            target="_blank"><i class="fa-solid fa-receipt"
                                                style="color: #288636;"></i></a></span>
                                @endif
                            </td>
                            <td class="px-2 py-3">
                                @if ($espectador->created_at->lt('2023-07-15 0:00:00'))
                                    @if ($espectador->after)
                                        35€
                                    @else
                                        25€
                                    @endif
                                @else
                                    @if ($espectador->after)
                                        40€
                                    @else
                                        30€
                                    @endif
                                @endif
                            </td>
                            <td class="py-4">
                                <a href="{{ route('admin.singleEspectador', $espectador->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
    </div>
    </div>
@endsection
