@extends('layouts.master')

@section('title', Auth::user()->equipo->nombre)

@section('content')
    <div class="flex w-full max-w-screen-2xl">
        <div class="w-1/2">
            <div id="informacio">
                <h1>{{ Auth::user()->equipo->nombre }}</h1>
                <p><strong>Nom capità: </strong> {{ Auth::user()->name }} {{ Auth::user()->apellidos }} </p>
                <p>Correu electrònic: {{ Auth::user()->email }} </p>
                <p>Telèfon: {{ Auth::user()->phone }} </p>
            </div>
            <div id="instruccions">
                <h2>Instruccions:</h2>
                <p>1. Afegiu, editeu i elimineu jugadors.</p>
                <p>2. Feu el pagament a través de l’aplicació Verse a:
                    <br>  - Al número: 630 206 438
                    <br>  - Al $VerseTag: $maxfreixa
                    <br>  - o escanejant el QR:
                </p>
                <a href="#"><img src="{{asset('images/qr-web-thcb.png')}}" alt="" class="qr-beach"></a>
                <p class="mini-qr">Si estàs conectat desde el mòbil obrir l'enllaç del QR picant l'imatge</p>
            </div>
            <div id="estat-inscripcio">
                Estat de la inscripció:  
                    
                @elseif()

                @elseif()
                    
                @endif
            </div>
        </div>
        <div class="w-1/2">
            AAAAAAAA
        </div>
    </div>

@endsection
