<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class RegistroEquiposController extends Controller {
    public function index() {
        return view("register-equips");
    }

    // Registrar usuario
    public function store(Request $request): RedirectResponse {

        $request->flash();

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

        



        // Preparamos el mensaje i enviamos los parametros
        //$nombreRegistrado = $validated['nombre'];
        //$correoRegistrado = $validated['email'];
        //Mail::to($correoRegistrado)->send(new RegistroEmail($nombreRegistrado));
        // Una vez creado correctamente el usuario devolvemos con mensaje correcto
        return redirect()->route('login')->with('registroCorrecto', 'Equip registrat correctament! Inicia sessió i afegeix a tots els jugadors del teu equip.');
    }
}
