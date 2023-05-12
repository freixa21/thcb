<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;

class EquipoController extends Controller {
    public function index() {
        $jugadores = Jugador::all();

        return view('equipo', compact('jugadores'));
    }
}
