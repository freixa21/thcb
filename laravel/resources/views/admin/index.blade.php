@extends('layouts.master')

@section('title', Auth::user()->name)

@section('content')
    <div class="flex flex-col w-full">
        <div id="wrapper-general" class="flex flex-col lg:flex-row w-full lg:pl-24 lg:pr-24 pl-3 pr-3">
            <div class="col-admin w-full bg-blue-400">
                <h2>General</h2>
                <table>
                    <tr>
                        <td>Inscrits totals: </td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Inscrits confirmats:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Afters totals:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Homes:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Dones:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Ingressos previstos</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Ingressos confirmats:</td>
                        <td>X</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Equips</h2>
                <table>
                    <tr>
                        <td>Equips inscrits: </td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Equips confirmats:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Jugadors inscrits:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Jugadors confirmats:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Afters:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Ingressos previstos:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>Ingressos confirmats:</td>
                        <td>X</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Espectadors</h3>
                    <table>
                        <tr>
                            <td>Espectadors inscrits: </td>
                            <td>X</td>
                        </tr>
                        <tr>
                            <td>Espectadors confirmats:</td>
                            <td>X</td>
                        </tr>
                        <tr>
                            <td>Afters:</td>
                            <td>X</td>
                        </tr>
                        <tr>
                            <td>Ingressos previstos:</td>
                            <td>X</td>
                        </tr>
                        <tr>
                            <td>Ingressos confirmats:</td>
                            <td>X</td>
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
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>M:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>L:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>XL:</td>
                        <td>X</td>
                    </tr>
                    <tr>
                        <td>XXL:</td>
                        <td>X</td>
                    </tr>
                </table>
            </div>
            <div class="col-admin lg:w-full bg-blue-400">
                <h2>Al·lèrgies</h2>
                <table>
                    <tr>
                        <th>Nom</th>
                        <th>Al·lèrgies</th>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td>Al·lèrgies</td>
                    </tr>
                    <tr>
                        <td>Nom</td>
                        <td>Al·lèrgies</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
