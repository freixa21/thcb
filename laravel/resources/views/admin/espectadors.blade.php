@extends('layouts.master')

@section('title', "Espectadors")

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
                        <th scope="col" class="px-2 py-3 amagar-mobil">Al·lèrgies</th>
                        <th scope="col" class="px-2 py-3 amagar-mobil">Data inscripció</th>
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
                                {{ $espectador->nombre }} {{ $espectador->apellidos }}
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
                            <td class="px-2 py-3 amagar-mobil truncate" style="max-width: 100px">
                                {{ $espectador->alergenos }}
                            </td>
                            <td class="px-2 py-3 amagar-mobil">{{ $espectador->created_at->format('d-m-Y') }}</td>
                            <td class="px-2 py-3">
                                @if ($espectador->created_at->lt('2023-06-23 0:00:00'))
                                    @if ($espectador->after)
                                        35€
                                    @else
                                        25€
                                    @endif
                                @else
                                    @if ($espectador->after)
                                        40€
                                    @else
                                        25€
                                    @endif
                                @endif
                            </td>
                            <td class="py-4 max-w-0">
                                <a href="{{ route('admin.singleEspectador', $espectador->id)}}">Editar</a>
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
