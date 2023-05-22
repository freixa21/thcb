@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <div class="flex flex-col w-full">
        <div id="wrapper-general" class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3">
            <div class="col-admin lg:w-full bg-white rounded-md m-3 px-2 py-2 shadow-md">
                <h2>General</h2>
                <table>
                    <tr>
                        <td>Inscrits totals:</td>
                        <td class="text-right"> {{ $totalInscrits }}</td>
                    </tr>
                    <tr>
                        <td>Inscrits confirmats:</td>
                        <td class="text-right"> {{ $totalIngressosConfirmats }}</td>
                    </tr>
                    <tr>
                        <td>Afters totals:</td>
                        <td class="text-right"> {{ $totalAfters }}</td>
                    </tr>
                    <tr>
                        <td>Homes:</td>
                        <td class="text-right"> {{ $totalHomes }}</td>
                    </tr>
                    <tr>
                        <td>Dones:</td>
                        <td class="text-right"> {{ $totalDones }}</td>
                    </tr>
                    <tr>
                        <td>Ingressos previstos</td>
                        <td class="text-right"> {{ $totalIngressosPrevistos }}€</td>
                    </tr>
                    <tr>
                        <td>Ingressos confirmats:</td>
                        <td class="text-right"> {{ $totalIngressosConfirmats }}€</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-white rounded-md m-3 px-2 py-2 shadow-md">
                <h2>Equips</h2>
                <table>
                    <tr>
                        <td>Equips inscrits: </td>
                        <td class="text-right"> {{ $totalEquips }}</td>
                    </tr>
                    <tr>
                        <td>Equips confirmats:</td>
                        <td class="text-right"> {{ $equipsConfirmats }}</td>
                    </tr>
                    <tr>
                        <td>Jugadors inscrits:</td>
                        <td class="text-right"> {{ $totalJugadors }}</td>
                    </tr>
                    <tr>
                        <td>Jugadors confirmats:</td>
                        <td class="text-right"> {{ $jugadorsConfirmats }}</td>
                    </tr>
                    <tr>
                        <td>Afters:</td>
                        <td class="text-right"> {{ $afterJugadors }}</td>
                    </tr>
                    <tr>
                        <td>Ingressos previstos:</td>
                        <td class="text-right"> {{ $ingressosPrevistosJugadors }}€</td>
                    </tr>
                    <tr>
                        <td>Ingressos confirmats:</td>
                        <td class="text-right"> {{ $ingressosConfirmatsJugadors }}€</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-white rounded-md m-3 px-2 py-2 shadow-md">
                <h2>Espectadors</h3>
                    <table>
                        <tr>
                            <td>Espectadors inscrits: </td>
                            <td class="text-right"> {{ $espectadorsInscrits }}</td>
                        </tr>
                        <tr>
                            <td>Espectadors confirmats:</td>
                            <td class="text-right"> {{ $espectadorsConfirmats }}</td>
                        </tr>
                        <tr>
                            <td>Afters:</td>
                            <td class="text-right"> {{ $afterEspectadors }}</td>
                        </tr>
                        <tr>
                            <td>Ingressos previstos:</td>
                            <td class="text-right"> {{ $ingressosPrevistosEspectadors }}€</td>
                        </tr>
                        <tr>
                            <td>Ingressos confirmats:</td>
                            <td class="text-right"> {{ $ingressosConfirmatsEspectadors }}€</td>
                        </tr>
                    </table>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3 mt-5">
            <div class="col-admin lg:w-full bg-white rounded-md m-3 px-2 py-2 shadow-md">
                <h2>Samarretes</h2>
                <table>
                    <tr>
                        <td>S: </td>
                        <td class="text-right"> {{ $totalS }}</td>
                    </tr>
                    <tr>
                        <td>M:</td>
                        <td class="text-right"> {{ $totalM }}</td>
                    </tr>
                    <tr>
                        <td>L:</td>
                        <td class="text-right"> {{ $totalL }}</td>
                    </tr>
                    <tr>
                        <td>XL:</td>
                        <td class="text-right"> {{ $totalXL }}</td>
                    </tr>
                    <tr>
                        <td>XXL:</td>
                        <td class="text-right"> {{ $totalXXL }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-white rounded-md m-3 px-2 py-2 shadow-md">
                <h2>Al·lèrgies</h2>
                <table>
                    <tr class="text-left">
                        <th>Nom</th>
                        <th class="text-right">Al·lèrgies</th>
                    </tr>
                    @foreach ($alergias as $item)
                        <tr>
                            <td> {{ $item['nombre'] }} {{ $item['apellidos'] }}</td>
                            <td class="text-right"> {{ $item['alergia'] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
