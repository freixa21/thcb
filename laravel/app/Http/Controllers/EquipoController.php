<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;

class EquipoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $jugadores = Jugador::all();

        return view('equipo', compact('jugadores'));
    }
}
