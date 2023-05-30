<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller {
    /**
     * Handle an authentication attempt.
     */

    public function index() {

        return view("login");
    }


    public function authenticate(Request $request): RedirectResponse {

        $request->flash();

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $tieneEquipo = Equipo::where('id_usuario', Auth::id())->first();

            if ($tieneEquipo) {
                return redirect()->intended('equip');
            } else {
                return redirect()->intended('espectador');
            }
        }

        return redirect()->back()->with('errorCredencials', 'Les credencials proporcionades no són correctes.');
    }


    public function logout(Request $request): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
