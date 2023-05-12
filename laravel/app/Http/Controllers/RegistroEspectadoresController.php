<?php

namespace App\Http\Controllers;

use App\Models\Espectador;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // Preparamos el mensaje i enviamos los parametros
        //$nombreRegistrado = $validated['nombre'];
        //$correoRegistrado = $validated['email'];
        //Mail::to($correoRegistrado)->send(new RegistroEmail($nombreRegistrado));
        // Una vez creado correctamente el usuario devolvemos con mensaje correcto
        return redirect()->route('login')->with('registroCorrecto', 'Espectador registrat correctament. Recorda que s\'ha de realitzar el pagament per validar la teva inscripció!');
    }
}
