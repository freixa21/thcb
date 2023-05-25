<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Espectador;
use Illuminate\Http\Request;
use App\Mail\AdminNouRegistre;
use App\Mail\RegistreEspectadors;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class RegistroEspectadoresController extends Controller {
    public function index() {
        return view("register-espectadors");
    }

    // Registrar usuario
    public function store(Request $request): RedirectResponse {

        $request->flash();

        $validated_usuario = $request->validate([
            'name' => 'required|max:50',
            'apellidos' => 'required|max:100',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password' => 'required|min:6|max:255|confirmed'
        ]);

        // Con bcrypt hasheamos la contraseña
        $validated_usuario['password'] = bcrypt($validated_usuario['password']);

        $validated_espectador = $request->validate([
            'name' => 'required',
            'apellidos' => 'required|max:100',
            'sexo' => 'max:100',
            'talla' => 'required',
            'alergenos' => 'max:500',
            'after' => 'required|boolean'
        ]);

        // CREAMOS USUARIO
        User::create($validated_usuario);

        // CREAMOS ESPECTADOR
        $validated_espectador['id_usuario'] = DB::getPdo()->lastInsertId();
        Espectador::create($validated_espectador);

        // Enviem mail de confirmació al usuari
        Mail::to($validated_usuario['email'])->send(new RegistreEspectadors());
        // Enviem avis al admin
        $inscripcio = "ESPECTADOR";
        $nom = $validated_espectador['name'] . ' ' . $validated_espectador['apellidos'];
        Mail::to('inscripcions@hockeycostabrava.com')->send(new AdminNouRegistre($inscripcio, $nom));

        return redirect()->route('auth.login')->with('registroCorrecto', 'Espectador registrat correctament. Recorda que s\'ha de realitzar el pagament per validar la teva inscripció!');
    }
}
