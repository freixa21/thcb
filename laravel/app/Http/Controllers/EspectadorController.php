<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Espectador;
use App\Mail\PagamentEnviat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Mail\AdminNouPagamentEspectador;

class EspectadorController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        if (Auth::user()->is_admin) {
            return redirect()->intended('admin');
        }

        $tieneEquipo = Equipo::where('id_usuario', Auth::id())->first();

        if ($tieneEquipo) {
            return redirect()->intended('/');
        }

        $espectador = Auth::user()->espectador;
        return view('espectador', compact('espectador'));
    }

    public function espectadorComprovant(Request $request) {
        $request->validate([
            'comprovante_img' => 'required|image|max:10240',
        ]);

        $espectador = Espectador::find(Auth::user()->espectador->id);

        if ($request->hasFile('comprovante_img')) {
            $image = $request->file('comprovante_img');
            $filename = $espectador->name . $espectador->apellidos . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/uploads'), $filename);
        }

        $espectador->update([
            'comprovante_img' => $filename,
            'estado_inscripcion' => "1",
        ]);

        // Calculem preu espectador
        if ($espectador->created_at->lt('2023-07-15 0:00:00')) {
            if ($espectador->after)
                $preu = 40;
            else
                $preu = 25;
        } else {
            if ($espectador->after) {
                $preu = 40;
            } else {
                $preu =  30;
            }
        }

        // Enviem mail de confirmació al usuari
        Mail::to(Auth::user()->email)->send(new PagamentEnviat());
        // Enviem mail de confirmació al usuari
        Mail::to('inscripcions@hockeycostabrava.com')->send(new AdminNouPagamentEspectador($espectador, $preu));

        return redirect()->back()->with('success', 'El comprovant s\'ha enviat correctament. Ens posarem en contacte amb tu quan haguem verificat el pagament i la inscripció quedarà confirmada!');
    }

    // Actualizar Espectador
    public function actualizarEspectador(Request $request): RedirectResponse {

        $espectador = Espectador::findOrFail(Auth::user()->espectador->id);

        if (Carbon::today()->gt('2023-06-07')) {
            $request->merge([
                'talla' => $espectador->talla,
            ]);
        }

        if ($espectador->estado_inscripcion != 0) {
            $request->merge([
                'after' => $espectador->after
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

        $espectador = Espectador::findOrFail(Auth::user()->espectador->id);
        $usuari = User::findOrFail(Auth::user()->id);

        // Esborrar espectador
        $espectador->delete();
        //Esborrar usuari
        Auth::logout();
        $request->session()->invalidate();
        $usuari->delete();

        return redirect()->route('auth.login')->with('success', 'Inscripció eliminada correctament.');
    }
}
