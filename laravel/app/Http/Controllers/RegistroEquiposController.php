<?php

namespace App\Http\Controllers;

use App\Mail\AdminNouRegistre;
use App\Models\User;
use App\Mail\RegistreEquips;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RegistroEquiposController extends Controller {
    public function index() {
        return view("register-equips");
    }

    // Registrar usuario
    public function store(Request $request): RedirectResponse {

        $request->flash();

        $totalEquips = Equipo::All();

        if (count($totalEquips) >= 30) {
            return Redirect::back()->withErrors(['error' => 'Ja no hi ha places per equips nous. Estigueu pendents a Instagram per si se n\'allibera alguna o també podeu registrar-vos com a espectadors.']);
        }

        $validated_equipo = $request->validate([
            'nombre' => 'required|unique:equipos'
        ]);

        $validated_usuario = $request->validate([
            'name' => 'required|max:50',
            'apellidos' => 'required|max:100',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|max:255|confirmed'
        ]);
        // Con bcrypt hasheamos la contraseña
        $validated_usuario['password'] = bcrypt($validated_usuario['password']);

        // CREAMOS USUARIO
        User::create($validated_usuario);

        // CREAMOS EQUIPO
        $validated_equipo['id_usuario'] = DB::getPdo()->lastInsertId();
        Equipo::create($validated_equipo);

        // Enviem mail de confirmació al usuari
        Mail::to($validated_usuario['email'])->send(new RegistreEquips());
        // Enviem avis al admin
        $inscripcio = "EQUIP";
        $nom = $validated_equipo['nombre'];
        Mail::to('inscripcions@hockeycostabrava.com')->send(new AdminNouRegistre($inscripcio, $nom));

        return redirect()->route('auth.login')->with('registroCorrecto', 'Equip registrat correctament! Inicia sessió i afegeix a tots els jugadors del teu equip.');
    }
}
