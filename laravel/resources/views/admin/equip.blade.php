@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')

    <div>
        <h1>Equips</h1>
    </div>

    <div class="flex flex-row w-full">
        <div id="wrapper-general" class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3">
            @foreach ($equips as $equip)
                <div
                    class="col-admin lg:w-full bg-white rounded-md m-3 px-2 py-2 shadow-md @if ($equip->estado_inscripcion == 0) bg-red-100 @elseif($equip->estado_inscripcion == 1) bg-blue-100  @elseif($equip->estado_inscripcion == 2) bg-green-100 @endif">
                    <h2>{{ $equip->nombre }}</h2>
                    <table>
                        <tr>
                            <td>Estat:</td>
                            <td class=" text-right">
                                @if ($equip->estado_inscripcion == 0)
                                    <span class="text-red-950">No pagada</span>
                                @elseif($equip->estado_inscripcion == 1)
                                    <span class="text-blue-950">Pagada</span> | <a
                                        href="{{ asset('images/uploads/' . $equip->comprovante_img) }}" target="_blank"><i
                                            class="fa-solid fa-receipt" style="color: #23599c;"></i></a> | <a
                                        class="px-1 bg-blue-950 text-white rounded-md"
                                        href="{{ route('admin.validarInscripcio', $equip->id) }}"
                                        onclick="return confirm('Estàs segur que vols confirmar el pagament?')">Validar</a>
                                @elseif($equip->estado_inscripcion == 2)
                                    <span class="text-green-950">Confirmada <a
                                            href="{{ asset('images/uploads/' . $equip->comprovante_img) }}"
                                            target="_blank"><i class="fa-solid fa-receipt"
                                                style="color: #288636;"></i></a></span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Data insc:</td>
                            <td class="text-right">{{ $equip->created_at->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Capità:</td>
                            <td class="text-right"> {{ $equip->user->name }} {{ $equip->user->apellidos }}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td class="text-right"> {{ $equip->user->email }}</td>
                        </tr>
                        <tr>
                            <td>Telèfon:</td>
                            <td class="text-right"> {{ $equip->user->phone }}</td>
                        </tr>
                        <tr>
                            <td>Integrants:</td>
                            <td class="text-right"> {{ count($equip->jugadores) }}</td>
                        </tr>

                        <tr>
                            <td>Afters:</td>
                            <td class="text-right">
                                @php
                                    $afterJugadors = 0;
                                    foreach ($equip->jugadores as $jugador) {
                                        if ($jugador->after) {
                                            $afterJugadors++;
                                        }
                                    }
                                @endphp
                                {{ $afterJugadors }}
                            </td>
                        </tr>
                        <tr>
                            <td>Import:</td>
                            <td class="text-right">
                                @php  $total = 0 @endphp
                                @foreach ($equip->jugadores as $jugador)
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
                                {{ $total }}€
                            </td>
                        </tr>

                    </table>
                </div>
            @endforeach
        </div>
        <div class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3 mt-5">
        </div>
    </div>


@endsection
