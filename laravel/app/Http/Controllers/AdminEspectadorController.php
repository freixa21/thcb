<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Espectador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminEspectadorController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $user = Auth::user()->is_admin;

        if ($user == 1) {

            $espectadors = Espectador::All();

            return view('admin.espectadors', [
                'espectadors' => $espectadors
            ]);
        }
        return redirect()->intended('/');
    }

    public function single(Request $request) {

        $user = Auth::user()->is_admin;

        if ($user == 1) {

            $idEspectador = $request->id;
            $espectador = Espectador::findOrFail($idEspectador);
            $usuariEspectador = User::findOrFail($espectador->id_usuario);

            return view('admin.singleEspectador', [
                'espectador' => $espectador,
                'usuariEspectador' => $usuariEspectador
            ]);
        }
        return redirect()->intended('/');
    }

    public function espectadorComprovant(Request $request) {

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

        $espectador = Espectador::find(Auth::user()->espectador->id);

        $espectador->update([
            'comprovante_img' => $filename,
            'estado_inscripcion' => "1",
        ]);

        return redirect()->back()->with('success', 'El comprovant s\'ha enviat correctament. Ens posarem en conctacte amb tu quan haguem verificat el pagament i la inscripció del teu equip quedarà confirmada!');
    }

    // Actualizar Espectador
    public function actualizarEspectador(Request $request): RedirectResponse {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $request->flash();
        $espectador = Espectador::findOrFail($request->id);

        $validated_jugador = $request->validate([
            'name' => 'required',
            'apellidos' => 'required|max:100',
            'sexo' => 'max:100',
            'talla' => 'required',
            'alergenos' => 'max:500',
            'after' => 'required|boolean'
        ]);

        $espectador->name = $validated_jugador['name'];
        $espectador->apellidos = $validated_jugador['apellidos'];
        $espectador->sexo = $validated_jugador['sexo'];
        $espectador->alergenos = $validated_jugador['alergenos'];
        $espectador->talla = $validated_jugador['talla'];
        $espectador->after = $validated_jugador['after'];


        $espectador->save();

        return redirect()->back()->with('success', 'Dades actualitzades correctament');
    }

    // Eliminar espectador + usuari
    public function eliminarInscripcioEspectador(Request $request): RedirectResponse {

        $user = Auth::user()->is_admin;

        if ($user != 1) {
            return redirect()->intended('/');
        }

        $espectador = Espectador::findOrFail($request->id);
        $usuari = User::findOrFail($request->id_usuario);

        // Esborrar espectador
        $espectador->delete();
        //Esborrar usuari
        $usuari->delete();
        
        return redirect()->route('auth.login')->with('success', 'Inscripció eliminada correctament.');
    }
}
