<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminEquiposController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $user = Auth::user()->is_admin;

        if ($user == 1) {

            $jugadors = Jugador::All();
            $equips = Equipo::with('jugadores', 'user')->get();

            return view('admin.equip', [
                'equips' => $equips
            ]);
        }
        return redirect()->intended('/');
    }

    public function validarInscripcio(Request $request) {

        $idEquip = $request->id;
        $equip = Equipo::findOrFail($idEquip);

        $equip->update([
            'estado_inscripcion' => 2,
            'pago_confirmaddo' => 1,
        ]);

        return redirect()->back()->with('success', 'S\'ha validat el pagament');
    }
}
