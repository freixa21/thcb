<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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

    public function single(Request $request) {

        $user = Auth::user()->is_admin;

        if ($user == 1) {

            $idEquip = $request->id;
            $equipo = Equipo::findOrFail($idEquip);
            $usuariEquip = User::findOrFail($equipo->id_usuario);
            $jugadores = $equipo->jugadores;

            return view('admin.singleEquip', [
                'jugadores' => $jugadores,
                'equipo' => $equipo,
                'usuarioEquip' => $usuariEquip
            ]);
        }
        return redirect()->intended('/');
    }

    public function validarInscripcio(Request $request) {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $idEquip = $request->id;
        $equip = Equipo::findOrFail($idEquip);

        $equip->update([
            'estado_inscripcion' => 2,
            'pago_confirmaddo' => 1,
        ]);

        return redirect()->back()->with('success', 'S\'ha validat el pagament');
    }

    // ========================================== EDITAR SINGLE EQUIP =====================================

    public function uploadComprovant(Request $request) {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $request->validate([
            'comprovante_img' => 'required|image|max:10240',
        ]);

        if ($request->hasFile('comprovante_img')) {
            $image = $request->file('comprovante_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads'), $filename);
        }

        $equipo = Equipo::find($request->id);

        $equipo->update([
            'comprovante_img' => $filename,
            'estado_inscripcion' => "1",
        ]);


        return redirect()->back()->with('success', 'El comprovant s\'ha enviat correctament. Ens posarem en conctacte amb tu quan haguem verificat el pagament i la inscripció del teu equip quedarà confirmada!');
    }

    // Actualizar Jugador
    public function actualizarJugador(Request $request): RedirectResponse {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $request->flash();
        $jugador = Jugador::findOrFail($request->id);

        $validated_jugador = $request->validate([
            'name' => 'required',
            'apellidos' => 'required|max:100',
            'sexo' => 'max:100',
            'talla' => 'required',
            'alergenos' => 'max:500',
            'after' => 'required|boolean'
        ]);

        $jugador->nombre = $validated_jugador['name'];
        $jugador->apellidos = $validated_jugador['apellidos'];
        $jugador->sexo = $validated_jugador['sexo'];
        $jugador->alergenos = $validated_jugador['alergenos'];
        $jugador->talla = $validated_jugador['talla'];
        $jugador->after = $validated_jugador['after'];

        $jugador->save();

        return redirect()->back()->with('success', 'Jugador actualitzat correctament');
    }


    // Afegir Jugador
    public function afegirJugador(Request $request): RedirectResponse {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $request->flash();

        $jugador = new Jugador;
        $equipo = $request->id;

        $validated_jugador = $request->validate([
            'name' => 'required',
            'apellidos' => 'required|max:100',
            'sexo' => 'max:100',
            'talla' => 'required',
            'alergenos' => 'max:500',
            'after' => 'required|boolean'
        ]);

        $jugador->equipo_id = $equipo;
        $jugador->nombre = $validated_jugador['name'];
        $jugador->apellidos = $validated_jugador['apellidos'];
        $jugador->sexo = $validated_jugador['sexo'];
        $jugador->talla = $validated_jugador['talla'];
        $jugador->alergenos = $validated_jugador['alergenos'];
        $jugador->after = $validated_jugador['after'];

        $jugador->save();

        return redirect()->back()->with('success', 'Jugador afegit correctament');
    }

    // Eliminar Jugador
    public function eliminarJugador($id): RedirectResponse {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $jugador = Jugador::findOrFail($id);
        $jugador->delete();

        return redirect()->back()->with('success', 'Jugador eliminat correctament');
    }

    // Eliminar equip + usuari
    public function eliminarInscripcioEquip(Request $request): RedirectResponse {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $equip = Equipo::findOrFail($request->id);
        $jugadors = $equip->jugadores;
        $usuari = User::findOrFail($equip->id_usuario);

        // Esborrar jugadors
        foreach ($jugadors as $jugador) {
            $jugador->delete();
        }
        // Esborrar equip
        $equip->delete();
        //Esborrar usuari
        $usuari->delete();

        return redirect()->route('admin.equips')->with('success', 'Inscripció eliminada correctament.');
    }
}
