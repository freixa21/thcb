<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Jugador;
use App\Mail\PagamentEnviat;
use Illuminate\Http\Request;
use App\Mail\AdminNouPagamentEquip;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

        $equipo = Equipo::find(Auth::user()->equipo->id);

        if ($request->hasFile('comprovante_img')) {
            $image = $request->file('comprovante_img');
            $filename = $equipo->nombre . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads'), $filename);
        }

        $equipo->update([
            'comprovante_img' => $filename,
            'estado_inscripcion' => "1",
        ]);

        $preu = 0;

        foreach ($equipo->jugadores as $jugador) {
            // Calculem preu espectador
            if ($jugador->created_at->lt(env('DATA_CANVI_DE_PREU'))) {
                if ($jugador->after)
                    $preu+= env('PREU_INICIAL_AFTER');
                else
                    $preu+= env('PREU_INICIAL');
            } else {
                if ($jugador->after) {
                    $preu+= env('PREU_LATE_AFTER');
                } else {
                    $preu+=  env('PREU_LATE');
                }
            }
        }

        // Enviem mail de confirmació al usuari
        Mail::to(Auth::user()->email)->send(new PagamentEnviat());
        // Enviem mail de confirmació al usuari
        Mail::to('inscripcions@hockeycostabrava.com')->send(new AdminNouPagamentEquip($equipo->nombre, $preu));


        return redirect()->back()->with('success', 'El comprovant s\'ha enviat correctament. Ens posarem en contacte amb tu quan haguem verificat el pagament i la inscripció del teu equip quedarà confirmada!');
    }

    // Actualizar Jugador
    public function actualizarJugador(Request $request): RedirectResponse {

        if (Auth::user()->is_admin) {
            return redirect()->intended('admin');
        }


        $jugador = Jugador::findOrFail($request->id);
        $equipo = $jugador->equipo;

        if (!$equipo || $equipo->id_usuario !== Auth::user()->id) {
            // El equipo no existe o el usuario no es propietario del equipo.
            return Redirect::back()->withErrors(['error' => 'Error en actualizar el jugador.']);
        }

        if (Carbon::today()->gt(env('DATA_LIMIT_COMANDA_SAMARRETES'))) {
            $request->merge([
                'talla' => $jugador->talla,
            ]);
        }

        if ($equipo->estado_inscripcion != 0) {
            $request->merge([
                'after' => $jugador->after
            ]);
        }

        $validated_jugador = $request->validate([
            'name' => 'required',
            'apellidos' => 'required|max:100',
            'email' => 'required',
            'sexo' => 'max:100',
            'talla' => 'required',
            'alergenos' => 'max:500',
            'after' => 'required|boolean'
        ]);

        $jugador->nombre = $validated_jugador['name'];
        $jugador->apellidos = $validated_jugador['apellidos'];
        $jugador->email = $validated_jugador['email'];
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
            'email' => 'required',
            'sexo' => 'max:100',
            'talla' => 'required',
            'alergenos' => 'max:500',
            'after' => 'required|boolean'
        ]);

        $jugador->equipo_id = $equipo;
        $jugador->nombre = $validated_jugador['name'];
        $jugador->apellidos = $validated_jugador['apellidos'];
        $jugador->email = $validated_jugador['email'];
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

        return redirect()->route('auth.login')->with('success', 'Inscripció eliminada correctament.');
    }
}
