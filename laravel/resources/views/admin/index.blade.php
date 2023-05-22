@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <div class="flex flex-col w-full">
        <div id="wrapper-general" class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3">
            <div class="col-admin w-full bg-blue-400">
                <h2>General</h2>
                <table>
                    <tr>
                        <td>Inscrits totals:</td>
                        <td> {{ $totalInscrits }}</td>
                    </tr>
                    <tr>
                        <td>Inscrits confirmats:</td>
                        <td> {{ $totalIngressosConfirmats }}</td>
                    </tr>
                    <tr>
                        <td>Afters totals:</td>
                        <td> {{ $totalAfters }}</td>
                    </tr>
                    <tr>
                        <td>Homes:</td>
                        <td>{{ $totalHomes }}</td>
                    </tr>
                    <tr>
                        <td>Dones:</td>
                        <td>{{ $totalDones }}</td>
                    </tr>
                    <tr>
                        <td>Ingressos previstos</td>
                        <td>{{ $totalIngressosPrevistos }}</td>
                    </tr>
                    <tr>
                        <td>Ingressos confirmats:</td>
                        <td>{{ $totalIngressosConfirmats }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Equips</h2>
                <table>
                    <tr>
                        <td>Equips inscrits: </td>
                        <td>{{ $totalEquips }}</td>
                    </tr>
                    <tr>
                        <td>Equips confirmats:</td>
                        <td>{{ $equipsConfirmats }}</td>
                    </tr>
                    <tr>
                        <td>Jugadors inscrits:</td>
                        <td>{{ $totalJugadors }}</td>
                    </tr>
                    <tr>
                        <td>Jugadors confirmats:</td>
                        <td>{{ $jugadorsConfirmats }}</td>
                    </tr>
                    <tr>
                        <td>Afters:</td>
                        <td>{{ $afterJugadors }}</td>
                    </tr>
                    <tr>
                        <td>Ingressos previstos:</td>
                        <td>{{ $ingressosPrevistosJugadors }}</td>
                    </tr>
                    <tr>
                        <td>Ingressos confirmats:</td>
                        <td>{{ $ingressosConfirmatsJugadors }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Espectadors</h3>
                    <table>
                        <tr>
                            <td>Espectadors inscrits: </td>
                            <td>{{ $espectadorsInscrits }}</td>
                        </tr>
                        <tr>
                            <td>Espectadors confirmats:</td>
                            <td>{{ $espectadorsConfirmats }}</td>
                        </tr>
                        <tr>
                            <td>Afters:</td>
                            <td>{{ $afterEspectadors }}</td>
                        </tr>
                        <tr>
                            <td>Ingressos previstos:</td>
                            <td>{{ $ingressosPrevistosEspectadors }}</td>
                        </tr>
                        <tr>
                            <td>Ingressos confirmats:</td>
                            <td>{{ $ingressosConfirmatsEspectadors }}</td>
                        </tr>
                    </table>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3 mt-5">
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Samarretes</h2>
                <table>
                    <tr>
                        <td>S: </td>
                        <td>{{ $totalS }}</td>
                    </tr>
                    <tr>
                        <td>M:</td>
                        <td>{{ $totalM }}</td>
                    </tr>
                    <tr>
                        <td>L:</td>
                        <td>{{ $totalL }}</td>
                    </tr>
                    <tr>
                        <td>XL:</td>
                        <td>{{ $totalXL }}</td>
                    </tr>
                    <tr>
                        <td>XXL:</td>
                        <td>{{ $totalXXL }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Al·lèrgies</h2>
                <table>
                    <tr class="text-left">
                        <th>Nom</th>
                        <th>Al·lèrgies</th>
                    </tr>
                    @foreach ($alergias as $item)
                        <tr>
                            <td>{{ $item['nombre'] }} {{ $item['apellidos'] }}</td>
                            <td>{{ $item['alergia'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
