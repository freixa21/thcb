<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class EquipoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $tieneEquipo = Equipo::where('id_usuario', Auth::id())->first();

        if (!$tieneEquipo) {
            return redirect()->intended('/');
        }

        $jugadores = Auth::user()->equipo->jugadores;

        return view('equipo', compact('jugadores'));
    }

    public function uploadComprovant(Request $request) {
        $request->validate([
            'comprovante_img' => 'required|image|max:10240',
        ]);


        if ($request->hasFile('comprovante_img')) {
            $image = $request->file('comprovante_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads'), $filename);
        }

        $equipo = Equipo::find(Auth::user()->equipo->id);

        $equipo->update([
            'comprovante_img' => $filename,
            'estado_inscripcion' => "1",
        ]);


        return redirect()->back()->with('success', 'El comprovant s\'ha enviat correctament. Ens posarem en conctacte amb tu quan haguem verificat el pagament i la inscripció del teu equip quedarà confirmada!');
    }

    // Actualizar Jugador
    public function actualizarJugador(Request $request): RedirectResponse {

        $request->flash();
        $jugador = Jugador::findOrFail($request->id);
        $equipo = $jugador->equipo;

        if (!$equipo || $equipo->id_usuario !== Auth::user()->id) {
            // El equipo no existe o el usuario no es propietario del equipo.
            return Redirect::back()->withErrors(['error' => 'Error en actualizar el jugador.']);
        }

        if ($equipo->estado_inscripcion != 0) {
            $request->merge([
                'talla' => $jugador->talla,
                'after' => $jugador->after
            ]);
        }

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

        $request->flash();

        $jugador = new Jugador;
        $equipo = Auth::user()->equipo->id;

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

        $jugador = Jugador::findOrFail($id);
        $equipo = $jugador->equipo;

        if (!$equipo || $equipo->id_usuario !== Auth::user()->id) {
            // El equipo no existe o el usuario no es propietario del equipo.
            return Redirect::back()->withErrors(['error' => 'Error en borrar el jugador.']);
        }

        $jugador->delete();

        return redirect()->back()->with('success', 'Jugador eliminat correctament');
    }

        // Eliminar equip + usuari
        public function eliminarInscripcioEquip(Request $request): RedirectResponse {
            
            $jugadors = Auth::user()->equipo->jugadores;
            $equip = Equipo::findOrFail(Auth::user()->equipo->id);
            $usuari = User::findOrFail(Auth::user()->id);

            // Esborrar jugadors
            foreach ($jugadors as $jugador) {
                $jugador->delete();
            }
            // Esborrar equip
            $equip->delete();
            //Esborrar usuari
            Auth::logout();
            $request->session()->invalidate();
            $usuari->delete();
            
            return redirect()->route('auth.login')->with('success', 'Equip eliminat correctament.');
        }
}
